<meta name="description" content="@yield('meta_description', 'Find the best software development, marketing, and consulting firms. Compare top-rated agencies and read expert reviews at Top Firms Reviewer.')">
<link rel="canonical" href="{{ url()->current() }}" />

{{--? Open Graph --}}
<meta property="og:title" content="@yield('title','Top Firms Reviewer - Compare the Best Agencies & Consultants')">
<meta property="og:description" content="@yield('meta_description','Discover credible, experienced, and dependable companies.')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:image"
      content="@yield('og_image', asset('images/og.png'))">