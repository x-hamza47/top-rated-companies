@extends('shared.main')
@push('styles')
    @vite('resources/css/listicle.css')
@endpush
@section('title', $author->name . ' | Top Firms Reviewer')
@section('meta_description', $author->bio ?? 'Articles and insights by ' . $author->name)
@section('og_image', $author->image ? asset('storage/' . $author->image) : asset('images/og.png'))
@section('og_type', 'profile')

@section('content')

{{-- ── HERO ──────────────────────────────────────────────────────── --}}
<section class="relative w-full overflow-hidden" style="min-height: 520px; background: #0d0d0d;">

    {{-- Blurred portrait background --}}
    @if ($author->image)
        <div class="absolute inset-0 scale-110"
            style="background: url('{{ asset('storage/' . $author->image) }}') center/cover no-repeat; filter: blur(28px) brightness(0.22);"></div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(135deg, #0d0d0d 60%, var(--color-secondary) 200%);"></div>
    @endif

    {{-- Diagonal accent stripe --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -right-32 top-0 bottom-0 w-[55%]"
            style="background: var(--color-primary); opacity: .07; transform: skewX(-8deg);"></div>
    </div>

    {{-- Top accent line --}}
    <div class="absolute top-0 inset-x-0 h-1" style="background: var(--color-primary);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 md:px-12 flex flex-col md:flex-row items-center md:items-start gap-10 pt-28 pb-16">

        {{-- Photo --}}
        <div class="shrink-0 relative">
           <div class="w-44 h-44 md:w-52 md:h-52 rounded-2xl overflow-hidden shadow-2xl ring-4 ring-(--color-primary)">
                @if ($author->image)
                    <img src="{{ asset('storage/' . $author->image) }}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-6xl font-extrabold text-white" style="background: var(--color-primary);">
                        {{ strtoupper(substr($author->name, 0, 1)) }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Info --}}
        <div class="flex-1 text-center md:text-left">

            @if ($author->designation)
                <p class="text-xs font-bold uppercase tracking-[.2em] mb-3" style="color: var(--color-primary);">
                    {{ $author->designation }}@if($author->company) &nbsp;·&nbsp; {{ $author->company }}@endif
                </p>
            @endif

            <h1 class="font-extrabold leading-none text-white mb-4" style="font-size: clamp(2.5rem, 6vw, 4.5rem); letter-spacing: -.02em;">
                {{ $author->name }}
            </h1>

            @if ($author->bio)
                <p class="text-gray-300 leading-relaxed max-w-2xl text-base md:text-lg mb-6">
                    {{ $author->bio }}
                </p>
            @endif

            <div class="flex flex-wrap items-center justify-center md:justify-start gap-6">

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(255,255,255,.08);">
                        <i class="fas fa-pen-nib text-sm" style="color: var(--color-primary);"></i>
                    </div>
                    <div>
                        <p class="text-white font-extrabold text-xl leading-none">{{ $insights->total() }}</p>
                        <p class="text-gray-400 text-xs uppercase tracking-widest mt-0.5">{{ Str::plural('Article', $insights->total()) }}</p>
                    </div>
                </div>

                @if ($author->linkedin_url || $author->twitter_url)
                    <div class="w-px h-8 bg-white/10"></div>
                    <div class="flex items-center gap-3">
                        @if ($author->linkedin_url)
                            <a href="{{ $author->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                                class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-white border border-white/20 transition-all duration-200"
                                onmouseover="this.style.background='var(--color-primary)'; this.style.borderColor='transparent';"
                                onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255,255,255,.2)';">
                                <i class="fab fa-linkedin text-base"></i> LinkedIn
                            </a>
                        @endif
                        @if ($author->twitter_url)
                            <a href="{{ $author->twitter_url }}" target="_blank" rel="noopener noreferrer"
                                class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold text-white border border-white/20 transition-all duration-200"
                                onmouseover="this.style.background='var(--color-primary)'; this.style.borderColor='transparent';"
                                onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(255,255,255,.2)';">
                                <i class="fab fa-twitter text-base"></i> Twitter
                            </a>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Bottom fade --}}
    <div class="absolute bottom-0 inset-x-0 h-16 pointer-events-none"
        style="background: linear-gradient(to bottom, transparent, var(--color-background));"></div>
</section>

{{-- ── ARTICLES ─────────────────────────────────────────────────── --}}
<section class="w-full bg-(--color-background) py-12 md:py-16 px-4 sm:px-6 md:px-12">
    <div class="max-w-7xl mx-auto">

        <h2 class="text-3xl md:text-4xl font-bold text-(--color-text) mb-8">
            Articles by <span class="text-(--color-primary)">{{ $author->name }}</span>
        </h2>

        @if ($insights->isEmpty())
            <div class="text-center py-20 text-gray-400">
                <p class="text-lg font-medium">No articles published yet.</p>
                <a href="{{ route('insights.list') }}" class="text-sm mt-2 inline-block text-(--color-primary)">
                    Browse all insights
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 w-full">
                @foreach ($insights as $insight)
                    <article
                        class="bg-(--color-surface) outline-2 outline-gray-500/55 hover:outline-(--color-primary) rounded-md overflow-hidden hover:scale-[1.01] hover:shadow-2xl transition-all duration-300">

                        {{-- Thumbnail --}}
                        <a href="{{ route('insights.showInsight', $insight->slug) }}" class="block overflow-hidden">
                            @if ($insight->thumbnail_url)
                                <img src="{{ $insight->thumbnail_url }}" alt="{{ $insight->title }}"
                                    class="h-48 w-full object-cover transition-transform duration-500 hover:scale-105"
                                    loading="lazy" decoding="async">
                            @else
                                <div class="h-48 w-full bg-linear-to-br from-(--color-primary) to-(--color-secondary) flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-gray-300"></i>
                                </div>
                            @endif
                        </a>

                        <div class="p-6">

                            {{-- Meta row --}}
                            <div class="flex items-center justify-between text-xs uppercase tracking-widest text-(--color-text-muted) mb-3">
                                <time datetime="{{ $insight->created_at->toDateString() }}">
                                    {{ $insight->created_at->format('M d, Y') }}
                                </time>
                            </div>

                            {{-- Service badge --}}
                            @if ($insight->service)
                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-full mb-2"
                                    style="background: color-mix(in srgb, var(--color-primary) 10%, transparent); color: var(--color-primary)">
                                    {{ $insight->service->name }}
                                </span>
                            @endif

                            {{-- Title --}}
                            <h3 class="text-lg font-bold text-(--color-text) mb-2 line-clamp-2">
                                <a href="{{ route('insights.showInsight', $insight->slug) }}"
                                    class="hover:text-(--color-primary) transition">
                                    {{ $insight->title }}
                                </a>
                            </h3>

                            {{-- Excerpt --}}
                            @if ($insight->excerpt)
                                <p class="text-sm text-gray-500 leading-relaxed line-clamp-2">
                                    {{ $insight->excerpt }}
                                </p>
                            @endif

                            {{-- Footer row --}}
                            <div class="flex items-center justify-between mt-4">
                                <a href="{{ route('insights.showInsight', $insight->slug) }}"
                                    class="text-sm font-bold text-(--color-primary) hover:text-(--color-secondary) transition">
                                    Read More →
                                </a>
                                @if ($insight->read_time)
                                    <span class="text-xs text-(--color-text-muted)">
                                        <i class="fas fa-clock mr-1"></i>{{ $insight->read_time }} min read
                                    </span>
                                @endif
                            </div>

                        </div>
                    </article>
                @endforeach
            </div>

            @if ($insights->hasPages())
                <div class="mt-10">
                    {{ $insights->links() }}
                </div>
            @endif
        @endif

    </div>
</section>

{{-- ── MORE INSIGHTS ────────────────────────────────────────────── --}}
@if ($moreInsights->count())
    <section class="w-full mt-6 bg-(--color-background) py-12 md:py-16 md:px-12 sm:px-6 px-4">

        <div class="max-w-7xl mx-auto">

            <div class="mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-(--color-text)">
                    More <span class="text-(--color-primary)">Insights</span>
                </h2>
                <p class="text-gray-500 mt-2 text-sm">More insights you might find useful</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($moreInsights as $related)
                    <article
                        class="outline-2 outline-gray-500/55 hover:outline-(--color-primary) bg-(--color-surface) rounded-md overflow-hidden hover:scale-[1.01] hover:shadow-2xl transition-all duration-300">

                        <a href="{{ route('insights.showInsight', $related->slug) }}" class="block overflow-hidden">
                            @if ($related->thumbnail_url)
                                <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}"
                                    class="h-48 w-full object-cover transition-transform duration-500 hover:scale-105"
                                    loading="lazy" decoding="async">
                            @else
                                <div class="h-48 w-full bg-linear-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-gray-300"></i>
                                </div>
                            @endif
                        </a>

                        <div class="p-6">

                            <div class="flex items-center justify-between text-xs uppercase tracking-widest text-gray-400 mb-2">
                                <time datetime="{{ $related->created_at->toDateString() }}">
                                    {{ $related->created_at->format('M d, Y') }}
                                </time>

                                @if ($related->author)
                                    <div class="flex items-center gap-2 normal-case tracking-normal">
                                        <div class="w-6 h-6 rounded-full overflow-hidden shrink-0">
                                            @if ($related->author->image)
                                                <img src="{{ asset('storage/' . $related->author->image) }}"
                                                    class="w-full h-full object-cover"
                                                    alt="{{ $related->author->name }}">
                                            @else
                                                <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold text-white"
                                                    style="background: var(--color-primary)">
                                                    {{ strtoupper(substr($related->author->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{ route('authors.show', $related->author->slug) }}"
                                            class="text-gray-500 font-medium hover:text-(--color-primary) transition">
                                            {{ $related->author->name }}
                                        </a>
                                    </div>
                                @endif
                            </div>

                            @if ($related->service)
                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-full mb-2"
                                    style="background: color-mix(in srgb, var(--color-primary) 10%, transparent); color: var(--color-primary)">
                                    {{ $related->service->name }}
                                </span>
                            @endif

                            <h3 class="text-lg font-bold text-(--color-secondary) mb-2 line-clamp-2">
                                <a href="{{ route('insights.showInsight', $related->slug) }}"
                                    class="hover:text-(--color-primary) transition">
                                    {{ $related->title }}
                                </a>
                            </h3>

                            @if ($related->excerpt)
                                <p class="text-sm text-gray-500 leading-relaxed line-clamp-2">
                                    {{ $related->excerpt }}
                                </p>
                            @endif

                            <a href="{{ route('insights.showInsight', $related->slug) }}"
                                class="inline-block mt-4 text-sm font-bold text-(--color-primary) hover:text-(--color-secondary) transition">
                                Read More →
                            </a>

                        </div>
                    </article>
                @endforeach
            </div>

        </div>
    </section>
@endif

{{-- ── BACK LINK ─────────────────────────────────────────────────── --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12 pb-12">
    <a href="{{ route('insights.list') }}"
        class="inline-flex items-center gap-2 text-sm font-bold text-(--color-primary) hover:text-(--color-secondary) transition">
        <i class="fas fa-arrow-left text-xs"></i> Back to Insights
    </a>
</div>

@endsection