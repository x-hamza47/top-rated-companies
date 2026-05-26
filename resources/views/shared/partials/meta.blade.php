<meta name="description" content="@yield('meta_description', 'Find the best software development, marketing, and consulting firms. Compare top-rated agencies and read expert reviews at Top Firms Reviewer.')">
<link rel="canonical" href="{{ config('app.url') . request()->getRequestUri() }}" />

{{-- ? Open Graph --}}
<meta property="og:title" content="@yield('title', 'Top Firms Reviewer - Compare the Best Agencies & Consultants')">
<meta property="og:description" content="@yield('meta_description', 'Discover credible, experienced, and dependable companies.')">
<meta property="og:url" content="{{ config('app.url') . request()->getRequestUri() }}">
<meta property="og:type"
    content="@yield('og_type', 'website')">
<meta property="og:image" content="@yield('og_image', asset('images/og.png'))">
<meta property="og:site_name" content="Top Firms Reviewer">
<meta property="og:image:width"  content="1200" />
<meta property="og:image:height" content="630" />
{{-- ? Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('title', 'Top Firms Reviewer - Compare the Best Agencies & Consultants')">
<meta name="twitter:description" content="@yield('meta_description', 'Discover credible, experienced, and dependable companies.')">
<meta name="twitter:image" content="@yield('og_image', asset('images/og.png'))">