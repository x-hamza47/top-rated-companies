@props(['blocks' => []])

@php
    use Illuminate\Support\Str;

    /**
     * HOW THIS COMPONENT WORKS
     * ─────────────────────────
     * EditorJS saves content as a JSON object like:
     * {
     *   "time": 1234567890,
     *   "version": "2.31.6",
     *   "blocks": [
     *     { "id": "abc", "type": "paragraph", "data": { "text": "Hello" } },
     *     { "id": "def", "type": "header",    "data": { "text": "Title", "level": 2 } },
     *     ...
     *   ]
     * }
     *
     * The controller decodes this JSON and passes $contentJson['blocks']
     * to this component as the $blocks prop.
     *
     * We loop every block and use @switch($block['type']) to decide
     * which HTML to render. Each case reads from $block['data'] which
     * is different per block type — documented in each case below.
     */

    // Maps EditorJS heading level numbers → HTML tags
    // Level 1 is skipped (reserved for page <h1> in the hero)
    $headingTag = [2 => 'h2', 3 => 'h3', 4 => 'h4'];

    // Rotating accent gradients for image captions
    // Each image gets the next color in this list
    $imageAccents = [
        'from-violet-700 to-indigo-700',
        'from-rose-700 to-pink-700',
        'from-amber-700 to-orange-700',
        'from-emerald-700 to-teal-700',
        'from-sky-700 to-blue-700',
    ];
    $imageIndex = 0;
@endphp

<div class="ejs-content">
    @foreach ($blocks as $block)
        @switch($block['type'])
            {{-- ════════════════════════════════════════════════════════
                 PARAGRAPH
                 ════════════════════════════════════════════════════════
                 $block['data']['text'] — HTML string

                 EditorJS stores bold as <b>, italic as <i>, links as <a>,
                 and inline code as <code> directly in this string.
                 We MUST use {!! !!} (unescaped output) so those tags render.
                 Never use {{ }} here or you will see raw HTML in the page.
            ══════════════════════════════════════════════════════════ --}}
            @case('paragraph')
                <p class="ejs-p">{!! $block['data']['text'] !!}</p>
            @break

            {{-- ════════════════════════════════════════════════════════
                 HEADER
                 ════════════════════════════════════════════════════════
                 $block['data']['level'] — integer: 2, 3, or 4
                 $block['data']['text']  — heading text (may contain inline HTML)

                 SEO RULE: The post <h1> is always the post title rendered
                 in the hero section of the page. So inside article content
                 we start at <h2>. EditorJS level 2 → <h2>, 3 → <h3>, 4 → <h4>.
                 This gives search engines a clean heading hierarchy.

                 Str::slug() converts "My Heading Text" → "my-heading-text"
                 which becomes the id="" used by TOC links: href="#my-heading-text"

                 TO CUSTOMISE:
                 - Change font sizes in .ejs-heading--2/3/4 in the CSS below
                 - Change the left border color / style per heading level
                 - The # anchor link only appears on hover via CSS opacity trick
            ══════════════════════════════════════════════════════════ --}}
            @case('header')
                @php
                    $lvl = $block['data']['level'] ?? 2;
                    $tag = $headingTag[$lvl] ?? 'h2';
                    $text = $block['data']['text'];
                    $anchor = Str::slug(strip_tags($text));
                @endphp
                <{{ $tag }} id="{{ $anchor }}" class="ejs-heading ejs-heading--{{ $lvl }}">
                    {{ $text }}
                    <a href="#{{ $anchor }}" class="ejs-heading-anchor" aria-label="Link to section">#</a>
                    </{{ $tag }}>
                @break

                {{-- ════════════════════════════════════════════════════════
                 IMAGE
                 ════════════════════════════════════════════════════════
                 $block['data']['file']['url']         — full image URL
                 $block['data']['caption']             — caption HTML string (may be empty)
                 $block['data']['withBorder']          — bool: show border around image
                 $block['data']['withBackground']      — bool: show grey bg with padding
                 $block['data']['stretched']           — bool: stretch to full container width

                 HOW THE ACCENT COLORS WORK:
                 $imageAccents is an array of Tailwind gradient classes.
                 $imageIndex starts at 0 and increments each time we hit
                 an image block. The modulo (%) wraps back to 0 after 5.
                 So images get colors: violet, rose, amber, emerald, sky, violet, ...

                 TO CUSTOMISE CAPTION:
                 .ejs-image-caption__text — change font-size, font-weight, color
                 .ejs-image-caption__bar  — the colored left bar, change width or remove it
                 The caption background is .ejs-image-caption — currently #f8faff

                 TO CUSTOMISE MODIFIERS:
                 .ejs-image--border  — adds border to image wrapper
                 .ejs-image--bg      — adds grey background with padding
                 .ejs-image--stretched — makes image full width (it already is by default)
            ══════════════════════════════════════════════════════════ --}}
                @case('image')
                    @php
                        $url = $block['data']['file']['url'] ?? '';
                        $caption = trim(strip_tags($block['data']['caption'] ?? ''));
                        $withBorder = $block['data']['withBorder'] ?? false;
                        $withBg = $block['data']['withBackground'] ?? false;
                        $stretched = $block['data']['stretched'] ?? false;
                        $alt = strip_tags($caption) ?: 'Post image';
                        $accent = $imageAccents[$imageIndex % count($imageAccents)];

                        // Gradient backgrounds — one per slot, cycles every 5 images
                        $imageBgs = [
                            'linear-gradient(135deg, #bfdbfe 0%, #3b82f6 100%)',
                            'linear-gradient(135deg, #fbcfe8 0%, #ec4899 100%)',
                            'linear-gradient(135deg, #fde68a 0%, #f59e0b 100%)',
                            'linear-gradient(135deg, #a7f3d0 0%, #10b981 100%)',
                            'linear-gradient(135deg, #ddd6fe 0%, #8b5cf6 100%)',
                        ];
                        $bgStyle = $imageBgs[$imageIndex % count($imageBgs)];
                        $imageIndex++;

                        $figClass = collect([
                            'ejs-image',
                            $withBorder ? 'ejs-image--border' : '',
                            $withBg ? 'ejs-image--bg' : '',
                            $stretched ? 'ejs-image--stretched' : '',
                        ])
                            ->filter()
                            ->join(' ');
                    @endphp
                    <figure class="mb-5">
                        <div class="ejs-image__wrap p-10 rounded-2xl" style="background: {{ $bgStyle }}">
                            <img src="{{ $url }}" alt="{{ $alt }}" loading="lazy" decoding="async"
                                class="ejs-image__img ">
                        </div>
                        @if ($caption)
                            <figcaption class="ejs-image-caption">
                                <span class="ejs-image-caption__bar bg-linear-to-b {{ $accent }}"></span>
                                <span class="ejs-image-caption__text">{!! $caption !!}</span>
                            </figcaption>
                        @endif
                    </figure>
                @break

                {{-- ════════════════════════════════════════════════════════
                 LIST — ordered & unordered
                 ════════════════════════════════════════════════════════
                 $block['data']['style'] — "ordered" | "unordered"
                 $block['data']['items'] — array of items

                 IMPORTANT — Two item formats exist depending on EditorJS version:
                 Old (v2 simple list):   $item = "plain string"
                 New (v2 nested list):   $item = { "content": "text", "items": [], "meta": {} }

                 We check is_array($item) to handle both.
                 If it's an array, we read $item['content'].
                 If it's a string, we use it directly.

                 TO CUSTOMISE:
                 Unordered bullet → .ejs-list__dot (currently a colored square)
                 Ordered number   → .ejs-list__num (currently a colored badge)
                 Change background/color of .ejs-list__num to restyle numbers
            ══════════════════════════════════════════════════════════ --}}
                @case('list')
                    @php
                        $style = $block['data']['style'] ?? 'unordered';
                        $items = $block['data']['items'] ?? [];
                    @endphp
                    @if ($style === 'ordered')
                        <ol class="ejs-list ejs-list--ordered">
                            @foreach ($items as $i => $item)
                                <li>
                                    <span class="ejs-list__num">{{ $i + 1 }}</span>
                                    <span>{!! is_array($item) ? $item['content'] ?? '' : $item !!}</span>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <ul class="ejs-list ejs-list--unordered">
                            @foreach ($items as $item)
                                <li>
                                    <span class="ejs-list__dot"></span>
                                    <span>{!! is_array($item) ? $item['content'] ?? '' : $item !!}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @break

                {{-- ════════════════════════════════════════════════════════
                 CHECKLIST
                 ════════════════════════════════════════════════════════
                 $block['data']['items'] — array of objects:
                   {
                     "content": "item text",
                     "meta": { "checked": true|false },
                     "items": []
                   }

                 WHY WE USE A CUSTOM SVG CHECKBOX:
                 This is read-only display — not a real form.
                 A real <input type="checkbox"> would be interactive.
                 Instead we render a styled <span> that looks like a checkbox.
                 When checked, CSS fills it with the brand color and shows
                 an SVG checkmark. When unchecked, it's just an empty border.

                 The .is-checked class on <li> drives both the box fill
                 AND the strikethrough on the label text via CSS.

                 TO CUSTOMISE:
                 Box size      → width/height on .ejs-checklist__box
                 Check color   → background on .ejs-checklist__item.is-checked .ejs-checklist__box
                 Label style   → .ejs-checklist__label
                 Strikethrough → .ejs-checklist__item.is-checked .ejs-checklist__label
            ══════════════════════════════════════════════════════════ --}}
                @case('checklist')
                    <ul class="ejs-checklist">
                        @foreach ($block['data']['items'] as $item)
                            @php
                                $checked = $item['meta']['checked'] ?? false;
                                $content = $item['content'] ?? '';
                            @endphp
                            <li class="ejs-checklist__item {{ $checked ? 'is-checked' : '' }}">
                                <span class="ejs-checklist__box" aria-hidden="true">
                                    @if ($checked)
                                        <svg viewBox="0 0 12 10" fill="none">
                                            <path d="M1 5l3.5 3.5L11 1" stroke="currentColor" stroke-width="2.2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @endif
                                </span>
                                <span class="ejs-checklist__label">{!! $content !!}</span>
                            </li>
                        @endforeach
                    </ul>
                @break

                {{-- ════════════════════════════════════════════════════════
                 QUOTE
                 ════════════════════════════════════════════════════════
                 $block['data']['text']      — quote body HTML
                 $block['data']['caption']   — attribution / source name
                 $block['data']['alignment'] — "left" | "center"

                 The large decorative " mark is a CSS ::before pseudo-element
                 on .ejs-quote — no extra HTML element is needed for it.
                 It uses Georgia font for a classic typographic feel.

                 .ejs-quote--center variant removes the left border and
                 adds a top border instead, centers all text.

                 TO CUSTOMISE:
                 Quote body text size → .ejs-quote__text font-size
                 Background color     → .ejs-quote background
                 Left border          → border-left on .ejs-quote
                 Decorative quote     → .ejs-quote::before content/opacity/size
            ══════════════════════════════════════════════════════════ --}}
                @case('quote')
                    @php
                        $text = $block['data']['text'] ?? '';
                        $caption = $block['data']['caption'] ?? '';
                        $alignment = $block['data']['alignment'] ?? 'left';
                    @endphp
                    <blockquote class="ejs-quote ejs-quote--{{ $alignment }}">
                        <p class="ejs-quote__text">{!! $text !!}</p>
                        @if ($caption)
                            <footer class="ejs-quote__footer">
                                <span class="ejs-quote__dash">—</span>
                                <cite class="ejs-quote__cite">{!! $caption !!}</cite>
                            </footer>
                        @endif
                    </blockquote>
                @break

                {{-- ════════════════════════════════════════════════════════
     CTA BLOCK
     ════════════════════════════════════════════════════════
     $block['data']['title']       — main heading text
     $block['data']['subtitle']    — optional supporting text
     $block['data']['buttonText']  — primary button label
     $block['data']['buttonUrl']   — primary button URL
     $block['data']['button2Text'] — optional second button label
     $block['data']['button2Url']  — optional second button URL
     $block['data']['style']       — "primary" | "gradient" | "minimal"
 
     Styles:
       primary  → dark bg (stone-900) matching the site's ready-section
       gradient → brand color gradient bg
       minimal  → white bg with border, brand-colored heading
══════════════════════════════════════════════════════════ --}}
                @case('cta')
                    @php
                        $ctaTitle = $block['data']['title'] ?? '';
                        $ctaSub = $block['data']['subtitle'] ?? '';
                        $btn1Text = $block['data']['buttonText'] ?? '';
                        $btn1Url = $block['data']['buttonUrl'] ?? '#';
                        $btn2Text = $block['data']['button2Text'] ?? '';
                        $btn2Url = $block['data']['button2Url'] ?? '#';
                        $ctaStyle = $block['data']['style'] ?? 'primary';
                    @endphp

                    @if ($ctaStyle === 'primary')
                        {{-- ── Dark / "ready-section" style ── --}}
                        <div class="ejs-cta ejs-cta--primary">
                            <div class="ejs-cta__inner">
                                @if ($ctaTitle)
                                    <h2 class="ejs-cta__title">{!! $ctaTitle !!}</h2>
                                @endif
                                @if ($ctaSub)
                                    <p class="ejs-cta__sub">{!! $ctaSub !!}</p>
                                @endif
                                <div class="ejs-cta__buttons">
                                    @if ($btn1Text)
                                        <a href="{{ $btn1Url }}" class="ejs-cta__btn ejs-cta__btn--solid">
                                            {{ $btn1Text }}
                                        </a>
                                    @endif
                                    @if ($btn2Text)
                                        <a href="{{ $btn2Url }}" class="ejs-cta__btn ejs-cta__btn--outline">
                                            {{ $btn2Text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif($ctaStyle === 'gradient')
                        {{-- ── Brand gradient style ── --}}
                        <div class="ejs-cta ejs-cta--gradient">
                            <div class="ejs-cta__inner">
                                @if ($ctaTitle)
                                    <h2 class="ejs-cta__title">{!! $ctaTitle !!}</h2>
                                @endif
                                @if ($ctaSub)
                                    <p class="ejs-cta__sub">{!! $ctaSub !!}</p>
                                @endif
                                <div class="ejs-cta__buttons">
                                    @if ($btn1Text)
                                        <a href="{{ $btn1Url }}" class="ejs-cta__btn ejs-cta__btn--white">
                                            {{ $btn1Text }}
                                        </a>
                                    @endif
                                    @if ($btn2Text)
                                        <a href="{{ $btn2Url }}" class="ejs-cta__btn ejs-cta__btn--outline-white">
                                            {{ $btn2Text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- ── Minimal / border style ── --}}
                        <div class="ejs-cta ejs-cta--minimal">
                            <div class="ejs-cta__inner">
                                @if ($ctaTitle)
                                    <h2 class="ejs-cta__title ejs-cta__title--dark">{!! $ctaTitle !!}</h2>
                                @endif
                                @if ($ctaSub)
                                    <p class="ejs-cta__sub ejs-cta__sub--dark">{!! $ctaSub !!}</p>
                                @endif
                                <div class="ejs-cta__buttons">
                                    @if ($btn1Text)
                                        <a href="{{ $btn1Url }}" class="ejs-cta__btn ejs-cta__btn--brand">
                                            {{ $btn1Text }}
                                        </a>
                                    @endif
                                    @if ($btn2Text)
                                        <a href="{{ $btn2Url }}" class="ejs-cta__btn ejs-cta__btn--outline-brand">
                                            {{ $btn2Text }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @break

                {{-- ════════════════════════════════════════════════════════
                 CODE
                 ════════════════════════════════════════════════════════
                 $block['data']['code'] — raw code string (plain text)

                 IMPORTANT: We use {{ }} (escaped) NOT {!! !!} here.
                 Code must NEVER render as HTML — < and > should show
                 as literal characters, not tags.

                 The macOS-style traffic light dots (red/yellow/green spans)
                 are purely decorative — hardcoded hex colors.

                 HOW THE COPY BUTTON WORKS:
                 onclick="ejsCopyCode(this)" passes the button element.
                 The JS function finds the nearest .ejs-code-wrap parent,
                 then reads .innerText from the <code> inside it.
                 .innerText gives decoded plain text (no HTML entities).
                 navigator.clipboard.writeText() writes it to clipboard.
                 The button label temporarily changes to "Copied!" then back.

                 TO CUSTOMISE:
                 Dark background → .ejs-pre background color
                 Code font       → .ejs-code font-family
                 Add syntax highlighting → use a library like Prism.js or
                 Highlight.js and call it after page load on .ejs-code elements
            ══════════════════════════════════════════════════════════ --}}
                @case('code')
                    <div class="ejs-code-wrap">
                        <div class="ejs-code-header">
                            <div class="ejs-code-dots">
                                <span style="background:#ff5f57"></span>
                                <span style="background:#febc2e"></span>
                                <span style="background:#28c840"></span>
                            </div>
                            <button type="button" class="ejs-copy-btn" onclick="ejsCopyCode(this)">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" />
                                    <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" />
                                </svg>
                                <span>Copy</span>
                            </button>
                        </div>
                        <pre class="ejs-pre"><code class="ejs-code">{{ $block['data']['code'] ?? '' }}</code></pre>
                    </div>
                @break

                {{-- ════════════════════════════════════════════════════════
                 DELIMITER
                 ════════════════════════════════════════════════════════
                 No data — purely a visual section break.
                 Three <span> elements styled as dots in CSS.
                 The middle dot is slightly larger (transform: scale(1.3)).

                 TO CUSTOMISE:
                 Dot color  → background on .ejs-delimiter span
                 Dot size   → width/height on .ejs-delimiter span
                 Style      → could be a full <hr> line instead
            ══════════════════════════════════════════════════════════ --}}
                @case('delimiter')
                    <div class="ejs-delimiter" role="separator" aria-hidden="true">
                        <span></span><span></span><span></span>
                    </div>
                @break

                {{-- ════════════════════════════════════════════════════════
                 TABLE
                 ════════════════════════════════════════════════════════
                 $block['data']['content']      — 2D PHP array of cell strings
                                                  e.g. [["H1","H2"],["R1C1","R1C2"]]
                 $block['data']['withHeadings'] — bool

                 IF withHeadings is true:
                   $rows[0] → rendered as <thead> <th> cells
                   $rows[1..n] → rendered as <tbody> <td> cells
                   array_slice($rows, 1) skips the first row for tbody

                 IF withHeadings is false:
                   All rows → <tbody> <td> cells

                 Alternating row background → nth-child(even) in CSS
                 Hover highlight → tbody tr:hover td in CSS

                 TO CUSTOMISE:
                 Header row bg  → .ejs-table thead tr background
                 Header text    → .ejs-table th color/font
                 Row striping   → .ejs-table tbody tr:nth-child(even) td
            ══════════════════════════════════════════════════════════ --}}
                @case('table')
                    @php
                        $rows = $block['data']['content'] ?? [];
                        $withHeading = $block['data']['withHeadings'] ?? false;
                    @endphp
                    <div class="ejs-table-wrap">
                        <table class="ejs-table">
                            @if ($withHeading && count($rows))
                                <thead>
                                    <tr>
                                        @foreach ($rows[0] as $cell)
                                            <th>{!! $cell !!}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (array_slice($rows, 1) as $row)
                                        <tr>
                                            @foreach ($row as $cell)
                                                <td>{!! $cell !!}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    @foreach ($rows as $row)
                                        <tr>
                                            @foreach ($row as $cell)
                                                <td>{!! $cell !!}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                @break

                {{-- ════════════════════════════════════════════════════════
                 WARNING
                 ════════════════════════════════════════════════════════
                 $block['data']['title']   — bold label text (optional)
                 $block['data']['message'] — body message text

                 Uses {{ }} (escaped) for both — these are plain text fields
                 in EditorJS, no inline HTML formatting expected.

                 TO CUSTOMISE: change border/background colors for
                 different severity levels (info=blue, danger=red, etc.)
            ══════════════════════════════════════════════════════════ --}}
                @case('warning')
                    @php
                        $title = $block['data']['title'] ?? '';
                        $message = html_entity_decode($block['data']['message'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $lower = strtolower($title);

                        if (str_contains($lower, 'pro tip') || str_contains($lower, 'tip')) {
                            $icon = '💡';
                            $bg = '#f0fdf4';
                            $border = '#22c55e';
                            $tc = '#14532d';
                            $mc = '#166534';
                        } elseif (str_contains($lower, 'key insight') || str_contains($lower, 'key')) {
                            $icon = '🔑';
                            $bg = '#faf5ff';
                            $border = '#a855f7';
                            $tc = '#3b0764';
                            $mc = '#7e22ce';
                        } elseif (str_contains($lower, 'important') || str_contains($lower, 'note')) {
                            $icon = 'ℹ️';
                            $bg = '#eff6ff';
                            $border = '#3b82f6';
                            $tc = '#1e3a5f';
                            $mc = '#1d4ed8';
                        } elseif (str_contains($lower, 'danger') || str_contains($lower, 'caution')) {
                            $icon = '🚨';
                            $bg = '#fef2f2';
                            $border = '#ef4444';
                            $tc = '#7f1d1d';
                            $mc = '#b91c1c';
                        } elseif (str_contains($lower, 'callout') || str_contains($lower, 'simply put')) {
                            $icon = '💬';
                            $bg = 'color-mix(in srgb, var(--color-primary) 8%, transparent)';
                            $border = 'var(--color-primary)';
                            $tc = 'var(--color-primary)';
                            $mc = 'var(--color-primary)';
                        } else {
                            $icon = '⚠️';
                            $bg = '#fffbeb';
                            $border = '#f59e0b';
                            $tc = '#92400e';
                            $mc = '#78350f';
                        }
                    @endphp
                    <div class="ejs-warning" style="background:{{ $bg }}; border-color:{{ $border }}">
                        <div class="ejs-warning__icon">{{ $icon }}</div>
                        <div class="ejs-warning__body">
                            @if ($title)
                                <strong class="ejs-warning__title"
                                    style="color:{{ $tc }}">{{ $title }}</strong>
                            @endif
                            <p style="color:{{ $mc }}">{!! $message !!}</p>
                        </div>
                    </div>
                @break

                @case('raw')
                    {!! $block['data']['html'] ?? '' !!}
                @break

                @case('companies')
                    <div class="ejs-companies">
                        @foreach ($block['data']['items'] ?? [] as $i => $company)
                            <div class="ejs-company-card">

                                {{-- Header: rank + rating --}}
                                <div class="ejs-company-card__header">
                                    <span class="ejs-company-card__rank">#{{ $i + 1 }}</span>
                                    <p class="ejs-company-card__name">{{ $company['name'] ?? '' }}</p>
                                    @if (!empty($company['rating']))
                                        <span class="ejs-company-card__rating">
                                            <svg viewBox="0 0 24 24" fill="currentColor" width="12" height="12">
                                                <path
                                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                            </svg>
                                            {{ $company['rating'] }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Body --}}
                                <div class="ejs-company-card__body">

                                    <ul class="ejs-company-card__meta">
                                        @if (!empty($company['employees']))
                                            <li>
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.75" width="14" height="14" aria-hidden="true">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                                    <circle cx="9" cy="7" r="4" />
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                                </svg>
                                                <span class="ejs-company-card__label">Employees</span>
                                                <span class="ejs-company-card__value">{{ $company['employees'] }}</span>
                                            </li>
                                        @endif
                                        @if (!empty($company['hourlyRate']))
                                            <li>
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.75" width="14" height="14" aria-hidden="true">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <path d="M12 6v6l4 2" />
                                                </svg>
                                                <span class="ejs-company-card__label">Hourly rate</span>
                                                <span class="ejs-company-card__value">{{ $company['hourlyRate'] }}</span>
                                            </li>
                                        @endif
                                        @if (!empty($company['projectRange']))
                                            <li>
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.75" width="14" height="14" aria-hidden="true">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                    <polyline points="14 2 14 8 20 8" />
                                                    <line x1="16" y1="13" x2="8" y2="13" />
                                                    <line x1="16" y1="17" x2="8" y2="17" />
                                                </svg>
                                                <span class="ejs-company-card__label">Project min</span>
                                                <span class="ejs-company-card__value">{{ $company['projectRange'] }}</span>
                                            </li>
                                        @endif
                                    </ul>

                                    @if (!empty($company['url']))
                                        <a href="{{ $company['url'] }}" target="_blank" rel="noopener"
                                            class="ejs-company-card__btn ejs-company-card__btn--{{ $i === 0 ? 'primary' : 'outline' }}">
                                            View profile
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                width="13" height="13" aria-hidden="true">
                                                <path d="M5 12h14M12 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>
                @break
            @endswitch
    @endforeach
</div>

{{-- @once prevents these from being injected multiple times if the
     component is included more than once on the same page  --}}
@once
    @push('scripts')
        <script>
            /**
             * ejsCopyCode(btn)
             * Called by onclick on the Copy button inside each code block.
             * 1. Walks up the DOM to find .ejs-code-wrap (the block wrapper)
             * 2. Finds the <code> element inside it
             * 3. Reads .innerText — this gives decoded plain text (no &lt; etc.)
             * 4. Writes to clipboard via the modern Clipboard API
             * 5. Temporarily changes the button label to "Copied!" for feedback
             */
            function ejsCopyCode(btn) {
                const code = btn.closest('.ejs-code-wrap').querySelector('code').innerText;
                navigator.clipboard.writeText(code).then(() => {
                    btn.querySelector('span').textContent = 'Copied!';
                    setTimeout(() => btn.querySelector('span').textContent = 'Copy', 2000);
                });
            }
        </script>
    @endpush

    @push('styles')
        <style>
            /* ── COMPANIES ── */
            .ejs-content .ejs-companies {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 14px;
                margin: 2rem 0;
            }

            .ejs-content .ejs-company-card {
                background: var(--color-background);
                border: 1px solid var(--color-border);
                border-radius: 14px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .ejs-content .ejs-company-card:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-md);
            }

            .ejs-content .ejs-company-card__header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 14px;
                background: var(--color-secondary);
                border-bottom: 1px solid var(--color-border);
            }

            .ejs-content .ejs-company-card__rank {
                font-size: 11px;
                font-weight: 700;
                color: var(--color-muted);
                letter-spacing: 0.05em;
                text-transform: uppercase;
            }

            .ejs-content .ejs-company-card__rating {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                font-size: 12px;
                font-weight: 600;
                color: #eee068;
                background: #272624;
                border-radius: 6px;
                padding: 2px 8px;
            }

            .ejs-content .ejs-company-card__body {
                padding: 14px;
                display: flex;
                flex-direction: column;
                flex: 1;
            }

            .ejs-content .ejs-company-card__name {
                font-size: 15px;
                font-weight: 700;
                color: white;
                line-height: 1.3;
            }

            .ejs-content .ejs-company-card__meta {
                list-style: none;
                padding: 0;
                margin: 0 0 14px;
                display: flex;
                flex-direction: column;
                gap: 7px;
                flex: 1;
            }

            .ejs-content .ejs-company-card__meta li {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .ejs-content .ejs-company-card__meta svg {
                color: var(--color-text-muted);
                flex-shrink: 0;
            }

            .ejs-content .ejs-company-card__label {
                font-size: 12px;
                color: var(--color-text-secondary);
                flex: 1;
            }

            .ejs-content .ejs-company-card__value {
                font-size: 12px;
                font-weight: 600;
                color: var(--color-text);
            }

            .ejs-content .ejs-company-card__btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                width: 100%;
                padding: 8px 0;
                border-radius: 8px;
                font-size: 12px;
                font-weight: 600;
                text-decoration: none;
                transition: opacity 0.2s ease;
                box-sizing: border-box;
            }

            .ejs-content .ejs-company-card__btn:hover {
                opacity: 0.85;
            }

            .ejs-content .ejs-company-card__btn--primary {
                background: var(--color-primary);
                color: #fff;
                border: none;
            }

            .ejs-content .ejs-company-card__btn--outline {
                background: transparent;
                color: var(--color-primary);
                border: 1px solid var(--color-primary);
            }

            .ejs-content {
                font-size: 1.0625rem;
                line-height: 1.9;
                color: var(--color-text);
            }

            /* ── TOC ACTIVE STATE ── */
            .toc-link.active {
                color: var(--color-primary);
                font-weight: 700;
                border-left: 2px solid var(--color-primary);
                padding-left: 0.5rem;
                transition: all 0.2s ease;
            }

            .ejs-content b,
            .ejs-content strong {
                font-weight: 700;
                color: var(--color-text);
            }

            .ejs-content i,
            .ejs-content em {
                font-style: italic;
            }

            .ejs-content a {
                color: var(--color-primary);
                text-decoration: underline;
                text-underline-offset: 3px;
                transition: opacity .2s;
            }

            .ejs-content a:hover {
                opacity: .7;
            }

            .ejs-content p code,
            .ejs-content li code {
                font-family: 'Fira Code', 'Cascadia Code', monospace;
                font-size: 0.875em;
                background: var(--color-surface);
                color: var(--color-primary);
                padding: 0.15em 0.45em;
                border-radius: 0.3em;
            }

            /* ── PARAGRAPH ── */
            .ejs-content .ejs-p {
                margin: 0 0 1.5rem;
                color: var(--color-text-secondary);
                letter-spacing: 0.01em;
            }

            .ejs-content .ejs-p:last-child {
                margin-bottom: 0;
            }

            /* ── HEADINGS ── */
            .ejs-content .ejs-heading--2 {
                font-size: 1.75rem;
                margin: 2.5rem 0 1rem;
                color: var(--color-primary);
                font-weight: 800;
                line-height: 1.25;
                padding-left: 1rem;
                padding-bottom: 0.4rem;
                scroll-margin-top: 10rem;
                border-bottom: 2px solid var(--color-primary-200);
                border-left: 4px solid var(--color-primary);
            }

            .ejs-content .ejs-heading--3 {
                font-size: 1.35rem;
                font-weight: 700;
                line-height: 1.35;
                color: var(--color-text);
                margin: 2rem 0 0.75rem;
                scroll-margin-top: 6rem;
                position: relative;
            }

            .ejs-content .ejs-heading--4 {
                font-size: 1.0rem;
                margin: 1.75rem 0 0.6rem;
                letter-spacing: 0.07em;
                color: var(--color-primary);
            }

            .ejs-content .ejs-heading-anchor {
                font-size: 0.7em;
                font-weight: 400;
                margin-left: 0.5rem;
                color: var(--color-primary);
                opacity: 0;
                text-decoration: none;
                transition: opacity .2s;
                vertical-align: middle;
            }

            .ejs-content .ejs-heading:hover .ejs-heading-anchor {
                opacity: 1;
            }

            /* ── IMAGE ── */
            .ejs-content .ejs-image {
                margin: 2.5rem 0;
                border-radius: 1.25rem;
                overflow: hidden;
                padding: 1rem;
                box-shadow: var(--shadow-md);
                transition: transform .25s ease, box-shadow .25s ease;
            }

            .ejs-content .ejs-image:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
            }

            .ejs-content .ejs-image__img {
                width: 100%;
                height: auto;
                display: block;
                border-radius: 0.9rem;
                transition: transform .5s ease;
            }

            .ejs-content .ejs-image:hover .ejs-image__img {
                transform: scale(1.02);
            }

            .ejs-content .ejs-image--border .ejs-image__img {
                border: 6px solid var(--color-accent);
                box-shadow: var(--shadow-sm);
            }

            .ejs-content .ejs-image--bg {
                padding: 1.4rem;
            }

            .ejs-content .ejs-image-caption {
                display: flex;
                align-items: stretch;
                gap: 0.85rem;
                padding: 0.9rem 1.25rem;
                background: var(--color-surface);
            }

            .ejs-content .ejs-image-caption__bar {
                display: block;
                width: 4px;
                border-radius: 2px;
                flex-shrink: 0;
            }

            .ejs-content .ejs-image-caption__text {
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--color-text-secondary);
                line-height: 1.65;
                font-style: normal;
            }

            .ejs-content .ejs-image--border .ejs-image__wrap {
                border: 1px solid var(--color-border);
                border-radius: 20px;
            }

            .ejs-content .ejs-image--bg {
                background: var(--color-surface);
                padding: 1.5rem;
            }

            @media (max-width: 768px) {
                .ejs-content .ejs-image {
                    padding: .8rem;
                    border-radius: 1rem;
                }
            }

            /* ── LISTS ── */
            .ejs-content .ejs-list {
                list-style: none;
                padding: 0;
                margin: 0.5rem 0 1.75rem;
                display: flex;
                flex-direction: column;
                gap: 0.55rem;
            }

            .ejs-content .ejs-list li {
                display: flex;
                align-items: flex-start;
                gap: 0.75rem;
                line-height: 1.7;
                color: var(--color-text-secondary);
            }

            .ejs-content .ejs-list__dot {
                display: inline-block;
                width: 7px;
                height: 7px;
                border-radius: 2px;
                background: var(--color-primary);
                flex-shrink: 0;
                margin-top: 0.58em;
            }

            .ejs-content .ejs-list__num {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 1.6rem;
                height: 1.6rem;
                border-radius: 0.4rem;
                background: var(--color-primary);
                color: #fff;
                font-size: 0.75rem;
                font-weight: 800;
                flex-shrink: 0;
                margin-top: 0.1em;
            }

            /* ── CHECKLIST ── */
            .ejs-content .ejs-checklist {
                list-style: none;
                padding: 0;
                margin: 0.5rem 0 1.75rem;
                display: flex;
                flex-direction: column;
                gap: 0.6rem;
            }

            .ejs-content .ejs-checklist__item {
                display: flex;
                align-items: flex-start;
                gap: 0.85rem;
                line-height: 1.65;
            }

            .ejs-content .ejs-checklist__box {
                width: 1.25rem;
                height: 1.25rem;
                border-radius: 0.35rem;
                border: 2px solid var(--color-border);
                background: var(--color-accent);
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                margin-top: 0.22em;
                color: white;
            }

            .ejs-content .ejs-checklist__box svg {
                width: 0.65rem;
                height: 0.65rem;
            }

            .ejs-content .ejs-checklist__item.is-checked .ejs-checklist__box {
                background: var(--color-primary);
                border-color: var(--color-primary);
            }

            .ejs-content .ejs-checklist__label {
                color: var(--color-text-secondary);
                font-size: 1rem;
            }

            .ejs-content .ejs-checklist__item.is-checked .ejs-checklist__label {
                text-decoration: line-through;
                color: var(--color-text-muted);
            }

            /* ── QUOTE ── */
            .ejs-content .ejs-quote {
                position: relative;
                margin: 2.5rem 0;
                padding: 2rem 2rem 1.75rem 2.5rem;
                background: var(--color-primary-50);
                border-left: 5px solid var(--color-primary);
                border-radius: 0 1.25rem 1.25rem 0;
            }

            .ejs-content .ejs-quote::before {
                content: '\201C';
                position: absolute;
                top: -0.5rem;
                left: 1rem;
                font-size: 5rem;
                line-height: 1;
                color: var(--color-primary);
                opacity: 0.12;
                font-family: Georgia, serif;
                pointer-events: none;
            }

            .ejs-content .ejs-quote__text {
                font-size: 1.15rem;
                font-weight: 500;
                color: var(--color-text);
                line-height: 1.8;
                margin: 0 0 0.75rem;
                font-style: normal;
            }

            .ejs-content .ejs-quote__footer {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .ejs-content .ejs-quote__dash {
                color: var(--color-primary);
                font-weight: 700;
            }

            .ejs-content .ejs-quote__cite {
                font-size: 0.875rem;
                font-weight: 600;
                color: var(--color-text-muted);
                font-style: normal;
            }

            .ejs-content .ejs-quote--center {
                text-align: center;
                border-left: none;
                border-top: 5px solid var(--color-primary);
                border-radius: 0 0 1.25rem 1.25rem;
                padding: 2rem;
            }

            .ejs-content .ejs-quote--center::before {
                left: 50%;
                transform: translateX(-50%);
            }

            .ejs-content .ejs-quote--center .ejs-quote__footer {
                justify-content: center;
            }

            /* ── CODE BLOCK ── */
            .ejs-content .ejs-code-wrap {
                margin: 2rem 0;
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: var(--shadow-lg);
            }

            .ejs-content .ejs-code-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0.65rem 1rem;
                background: #1e293b;
                border-bottom: 1px solid rgba(255, 255, 255, .06);
            }

            .ejs-content .ejs-code-dots {
                display: flex;
                gap: 0.4rem;
            }

            .ejs-content .ejs-code-dots span {
                width: 12px;
                height: 12px;
                border-radius: 50%;
            }

            .ejs-content .ejs-copy-btn {
                display: flex;
                align-items: center;
                gap: 0.4rem;
                font-size: 0.72rem;
                font-weight: 600;
                padding: 0.3rem 0.75rem;
                border-radius: 0.4rem;
                background: rgba(255, 255, 255, .08);
                color: #94a3b8;
                border: 1px solid rgba(255, 255, 255, .1);
                cursor: pointer;
                transition: all .2s;
            }

            .ejs-content .ejs-copy-btn:hover {
                background: rgba(255, 255, 255, .16);
                color: #e2e8f0;
            }

            .ejs-content .ejs-pre {
                background: #0f172a;
                margin: 0;
                padding: 1.5rem 1.5rem 1.75rem;
                overflow-x: auto;
            }

            .ejs-content .ejs-code {
                font-family: 'Fira Code', 'Cascadia Code', 'JetBrains Mono', monospace;
                font-size: 0.875rem;
                line-height: 1.75;
                color: #e2e8f0 !important;
                white-space: pre;
                background: none !important;
                padding: 0 !important;
                border-radius: 0 !important;
            }

            /* ── DELIMITER ── */
            .ejs-content .ejs-delimiter {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.6rem;
                margin: 3rem 0;
            }

            .ejs-content .ejs-delimiter span {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background: var(--color-primary);
                opacity: 0.3;
            }

            .ejs-content .ejs-delimiter span:nth-child(2) {
                opacity: 0.6;
                transform: scale(1.4);
            }

            /* ── TABLE ── */
            .ejs-content .ejs-table-wrap {
                overflow-x: auto;
                margin: 2rem 0;
                border-radius: 1rem;
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-sm);
            }

            .ejs-content .ejs-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 0.9rem;
            }

            .ejs-content .ejs-table thead tr {
                background: var(--color-secondary);
            }

            .ejs-content .ejs-table th {
                font-weight: 700;
                color: white;
                padding: 0.85rem 1.1rem;
                text-align: left;
                font-size: 0.8rem;
                letter-spacing: 0.04em;
                text-transform: uppercase;
            }

            .ejs-content .ejs-table td {
                padding: 0.75rem 1.1rem;
                border-bottom: 1px solid var(--color-border);
                color: var(--color-text-secondary);
            }

            .ejs-content .ejs-table tbody tr:last-child td {
                border-bottom: none;
            }

            .ejs-content .ejs-table tbody tr:nth-child(even) td {
                background: var(--color-surface);
            }

            .ejs-content .ejs-table tbody tr:hover td {
                background: var(--color-primary-50);
            }

            /* ── WARNING ── */
            .ejs-content .ejs-warning {
                display: flex;
                gap: 1rem;
                margin: 2rem 0;
                padding: 1.1rem 1.4rem;
                border-radius: 0 0.9rem 0.9rem 0;
                border-left-width: 5px;
                border-left-style: solid;
            }

            .ejs-content .ejs-warning__icon {
                font-size: 1.4rem;
                flex-shrink: 0;
            }

            .ejs-content .ejs-warning__title {
                display: block;
                font-weight: 700;
                margin-bottom: 0.3rem;
            }

            .ejs-content .ejs-warning__body p {
                margin: 0;
                font-size: 0.9rem;
                line-height: 1.6;
            }

            .ejs-content .ejs-cta {
                margin: 2.5rem 0;
                border-radius: 20px;
                overflow: hidden;
            }

            /* PRIMARY — dark stone bg matching your ready-section */
            .ejs-content .ejs-cta--primary {
                background: #1c1917;
                /* stone-900 */
            }

            /* GRADIENT — brand color */
            .ejs-content .ejs-cta--gradient {
                background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary, #2d5a00) 100%);
            }

            /* MINIMAL — white with brand border */
            .ejs-content .ejs-cta--minimal {
                background: var(--color-background);
                border: 2px solid var(--color-primary);
            }

            .ejs-content .ejs-cta__inner {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 1.1rem;
                padding: 3rem 2rem;
                text-align: center;
            }

            .ejs-content .ejs-cta__title {
                font-size: clamp(1.35rem, 3vw, 1.9rem);
                font-weight: 700;
                color: #fff;
                line-height: 1.3;
                margin: 0;
            }

            .ejs-content .ejs-cta__title--dark {
                color: var(--color-text);
            }

            .ejs-content .ejs-cta__sub {
                font-size: 1rem;
                color: rgba(255, 255, 255, 0.75);
                margin: 0;
                max-width: 520px;
                line-height: 1.7;
            }

            .ejs-content .ejs-cta__sub--dark {
                color: var(--color-text-secondary);
            }

            .ejs-content .ejs-cta__buttons {
                display: flex;
                gap: 0.75rem;
                flex-wrap: wrap;
                justify-content: center;
                margin-top: 0.5rem;
            }

            .ejs-content .ejs-cta__btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 0.9rem;
                font-weight: 600;
                padding: 0.6rem 1.4rem;
                border-radius: 8px;
                text-decoration: none;
                transition: all 0.2s ease;
                cursor: pointer;
                white-space: nowrap;
            }

            /* solid green — primary btn on dark bg */
            .ejs-content .ejs-cta__btn--solid {
                background: var(--color-primary);
                color: #fff;
                border: 2px solid transparent;
            }

            .ejs-content .ejs-cta__btn--solid:hover {
                opacity: 0.88;
            }

            /* white outline — secondary btn on dark bg */
            .ejs-content .ejs-cta__btn--outline {
                background: transparent;
                color: #fff;
                border: 2px solid #fff;
            }

            .ejs-content .ejs-cta__btn--outline:hover {
                background: #fff;
                color: #1c1917;
            }

            /* white filled — primary btn on gradient bg */
            .ejs-content .ejs-cta__btn--white {
                background: #fff;
                color: var(--color-primary);
                border: 2px solid transparent;
            }

            .ejs-content .ejs-cta__btn--white:hover {
                opacity: 0.9;
            }

            /* white outline — secondary btn on gradient bg */
            .ejs-content .ejs-cta__btn--outline-white {
                background: transparent;
                color: #fff;
                border: 2px solid rgba(255, 255, 255, 0.7);
            }

            .ejs-content .ejs-cta__btn--outline-white:hover {
                background: rgba(255, 255, 255, 0.15);
            }

            /* brand filled — primary btn on minimal style */
            .ejs-content .ejs-cta__btn--brand {
                background: var(--color-primary);
                color: #fff;
                border: 2px solid transparent;
            }

            .ejs-content .ejs-cta__btn--brand:hover {
                opacity: 0.88;
            }

            /* brand outline — secondary btn on minimal style */
            .ejs-content .ejs-cta__btn--outline-brand {
                background: transparent;
                color: var(--color-primary);
                border: 2px solid var(--color-primary);
            }

            .ejs-content .ejs-cta__btn--outline-brand:hover {
                background: var(--color-primary);
                color: #fff;
            }

            @media (max-width: 640px) {
                .ejs-content .ejs-cta__inner {
                    padding: 2rem 1.25rem;
                }

                .ejs-content .ejs-cta__buttons {
                    flex-direction: column;
                    width: 100%;
                }

                .ejs-content .ejs-cta__btn {
                    width: 100%;
                }
            }
        </style>
    @endpush
@endonce
