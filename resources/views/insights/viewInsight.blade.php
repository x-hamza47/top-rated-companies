@extends('shared.main')

@section('title', "$insight->title — Top Firms Reviewer")
@section('meta_description', $insight->description ?? Str::limit(strip_tags($insight->article),150))

@section('content')

    {{-- Hero / Header Section --}}
    <div class="bg-[#0b190d] text-white pt-32 pb-16">
        <div class="container mx-auto px-4">

            <div class="max-w-4xl">
                {{-- Service Badge --}}
                <span
                    class="inline-block bg-lime-600/10 text-lime-500 border border-lime-600/30 
                         px-4 py-1 rounded-full text-sm font-semibold mb-4">
                    {{ $insight->service->name }}
                </span>

                <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                    {{ $insight->title }}
                </h1>

                <p class="text-gray-300 text-sm">
                    By
                    @if ($insight->user->company)
                        <a href="{{ route('profile.index', $insight->user->company->slug) }}"
                            class="text-lime-500 hover:underline font-medium">
                            {{ $insight->user->company->name }}
                        </a>
                    @else
                        <span class="text-lime-500">Admin</span>
                    @endif
                    • {{ $insight->created_at->format('M d, Y') }}
                </p>
            </div>

        </div>
    </div>

    {{-- Article Content --}}
    <div class="container mx-auto px-4 py-12 ">
        <div class="max-w-4xl mx-auto">

            <div class="prose prose-lg max-w-none">
                {!! $insight->article !!}
            </div>

            <div class="mt-10">
                <a href="{{ route('insights.list') }}"
                    class="btn-primary inline-flex items-center gap-2 text-lime-600 font-semibold hover:underline">
                    ← Back to Insights
                </a>
            </div>

        </div>
    </div>

@endsection
