@extends('shared.main')
@push('styles')
    @vite('resources/css/listicle.css')
@endpush
@section('title', 'Blogs | Top Firms Reviewer')
@section('meta_description',
    'Read the latest blogs on software development, marketing, design, and consulting. Discover
    insights, trends, and expert tips from industry leaders.')

@section('content')

    {{-- ── HERO ──────────────────────────────────────────────────────── --}}
    <section class="w-full min-h-dvh relative overflow-hidden  flex items-center bg-blend-overlay md:px-12 sm:px-6 px-4"
        style="background: #212121 url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=1920&q=80') center / cover no-repeat;">

        <div class="relative z-10 max-w-7xl mx-auto w-full flex items-center h-full mt-10">
            <div class="text-white max-w-2xl flex flex-col gap-5">

                <h1 class="font-extrabold uppercase leading-tight lg:text-6xl md:text-5xl text-3xl">
                    Insights & <span class="text-(--color-primary)">Stories </span> from our Blog
                </h1>

                <p class="text-gray-300 text-base md:text-lg leading-relaxed">
                    Explore the latest trends in digital marketing, technology updates,
                    and strategies to grow your business online.
                </p>

                <div class="flex gap-4 mt-2">
                    <a href="#latest"
                        class="bg-(--color-primary) text-white font-bold uppercase md:px-4 px-3 lg:px-6 md:text-base text-sm py-3 rounded-sm hover:bg-transparent 
                        border border-(--color-primary) hover:border-(--color-primary-hover) transition-all hover:text-(--color-primary-hover)">
                        Read Blogs
                    </a>
                    <a href="#contact"
                        class="border border-white text-white font-bold uppercase md:px-4 px-3 lg:px-6 md:text-base text-sm py-3 rounded-sm hover:bg-(--color-primary-hover) hover:text-white transition-all hover:border-(--color-primary-hover)">
                        Let's Connect
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ── MAIN SECTION ─────────────────────────────────────────────── --}}
    <section id="latest" class="w-full bg-(--color-background) py-12 md:py-16 lg:py-20 px-4 sm:px-6 md:px-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            {{-- ── LEFT: BLOG LIST ──────────────────────────────────── --}}
            <div class="lg:col-span-8 flex flex-col">

                <h2 class="text-3xl md:text-4xl font-bold text-(--color-text) mb-8">
                    Latest <span class="text-(--color-primary)"> Insights </span>
                </h2>

                {{-- Filters --}}
                <div class="flex flex-wrap gap-3 mb-8">
                    <a href="{{ route('insights.list') }}"
                        class="px-4 py-2 rounded-full border text-sm font-medium transition
                               {{ !request('service') ? 'bg-(--color-secondary) text-white border-(--color-secondary)' : 'text-(--color-secondary) hover:bg-(--color-secondary) hover:text-white' }}">
                        All
                    </a>
                    @foreach ($services as $service)
                        <a href="{{ route('insights.list', ['service' => $service->id]) }}"
                            class="px-4 py-2 rounded-full border text-sm font-medium transition
                                   {{ request('service') == $service->id ? 'bg-(--color-secondary) text-white border-(--color-secondary)' : 'text-(--color-secondary) hover:bg-(--color-secondary) hover:text-white' }}">
                            {{ $service->name }}
                            <span class="text-xs opacity-60">({{ $service->insights_count }})</span>
                        </a>
                    @endforeach
                </div>

                {{-- Insight Grid --}}
                @if ($insights->isEmpty())
                    <div class="text-center py-20 text-gray-400">
                        <p class="text-lg font-medium">No insights found.</p>
                        <a href="{{ route('insights.list') }}" class="text-sm mt-2 inline-block text-(--color-primary)">
                            Clear filter
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-7 w-full">
                        @foreach ($insights as $insight)
                            <article
                                class="bg-(--color-surface) outline-2 outline-gray-500/55 hover:outline-(--color-primary) rounded-md overflow-hidden hover:scale-[1.01] hover:outline-grap-800 hover:shadow-2xl transition-all duration-300">

                                {{-- Thumbnail --}}
                                <a href="{{ route('insights.showInsight', $insight->slug) }}" class="block overflow-hidden">
                                    @if ($insight->thumbnail_url)
                                        <img src="{{ $insight->thumbnail_url }}" alt="{{ $insight->title }}"
                                            class="h-48 w-full object-cover transition-transform duration-500 hover:scale-105"
                                            loading="lazy" decoding="async">
                                    @else
                                        <div
                                            class="h-48 w-full bg-linear-to-br from-(--color-primary) to-(--color-secondary) flex items-center justify-center">
                                            <i class="fas fa-image text-4xl text-gray-300"></i>
                                        </div>
                                    @endif
                                </a>

                                <div class="p-6">

                                    {{-- Meta row --}}
                                    <div
                                        class="flex items-center justify-between text-xs uppercase tracking-widest text-(--color-text-muted) mb-3">
                                        <time datetime="{{ $insight->created_at->toDateString() }}">
                                            {{ $insight->created_at->format('M d, Y') }}
                                        </time>
                                        @if ($insight->author)
                                            <div class="flex items-center gap-2 normal-case tracking-normal">
                                                <div class="w-6 h-6 rounded-full overflow-hidden shrink-0">
                                                    @if ($insight->author->image)
                                                        <img src="{{ asset('storage/' . $insight->author->image) }}"
                                                            class="w-full h-full object-cover"
                                                            alt="{{ $insight->author->name }}">
                                                    @else
                                                        <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold text-white"
                                                            style="background: var(--color-primary)">
                                                            {{ strtoupper(substr($insight->author->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <a href="{{ route('authors.show', $insight->author->slug) }}"
                                                    class="font-medium hover:text-(--color-primary) transition">
                                                    By {{ $insight->author->name }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Service badge --}}
                                    @if ($insight->service)
                                        <span
                                            class="inline-block text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded-full mb-2"
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

                                    {{-- Description --}}
                                    @if ($insight->excerpt)
                                        <p class="text-sm text-gray-500 leading-relaxed line-clamp-2">
                                            {{ $insight->excerpt }}
                                        </p>
                                    @endif

                                    {{-- Footer row --}}
                                    {{-- Footer row --}}
                                    <div class="flex items-center justify-between mt-4">
                                        <a href="{{ route('insights.showInsight', $insight->slug) }}"
                                            class="text-sm font-bold text-blue-600 hover:text-blue-400 transition">
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

                    {{-- Pagination --}}
                    @if ($insights->hasPages())
                        <div class="mt-10">
                            {{ $insights->links() }}
                        </div>
                    @endif
                @endif

            </div>

            {{-- ── RIGHT: SIDEBAR ───────────────────────────────────── --}}
            <div class="lg:col-span-4">
                <div class="space-y-6 lg:sticky lg:top-24">

                    {{-- Recent Insights --}}
                    <div class="bg-(--color-surface) rounded-xl shadow-md p-6 border border-(--color-border)">
                        <h3 class="text-xl font-bold text-(--color-text) mb-5">Recent <span
                                class="text-(--color-primary)">Posts</span></h3>
                        <div class="flex flex-col gap-4 ">
                            @foreach ($recentInsights as $recent)
                                <a href="{{ route('insights.showInsight', $recent->slug) }}"
                                    class="flex items-center gap-4 group">
                                    <div class="w-14 h-14 rounded-xl overflow-hidden shrink-0 bg-gray-100">
                                        @if ($recent->thumbnail_url)
                                            <img src="{{ $recent->thumbnail_url }}" alt="{{ $recent->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center"
                                                style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary))">
                                                <i class="fas fa-newspaper text-white text-xl opacity-70"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="text-sm font-semibold text-(--color-text) group-hover:text-(--color-primary) transition line-clamp-2">
                                            {{ $recent->title }}
                                        </p>
                                        <p class="text-xs text-(--color-text-muted) mt-1 flex items-center gap-1">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $recent->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Categories --}}
                    @if ($services->count())
                        <div class="bg-(--color-surface) rounded-3xl shadow-xl p-6">
                            <h3 class="text-xl font-bold text-(--color-primary) mb-5">Categories</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($services as $service)
                                    <a href="{{ route('insights.list', ['service' => $service->id]) }}"
                                        class="px-4 py-2 text-sm rounded-full border transition
                                               {{ request('service') == $service->id
                                                   ? 'bg-(--color-secondary) text-white border-(--color-secondary)'
                                                   : 'text-(--color-secondary) hover:bg-(--color-secondary) hover:text-white' }}">
                                        {{ $service->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </section>

@endsection
