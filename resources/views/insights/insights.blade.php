@extends('shared.main')
@push('styles')
    @vite('resources/css/listicle.css')
@endpush
{{-- @section('title', $service->name) --}}

@section('content')
    {{-- !Hero Section --}}
    <div class="section md:pt-32 pt-25 pb-20 flex flex-col justify-between text-white gap-y-5">
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-y-4">
            <div class="flex flex-col items-center lg:items-start gap-4 lg:text-start text-center flex-1">
                <h1 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-bold w-full max-w-[900px]">
                    Latest <span class="text-lime-600">Insights</span>
                </h1>

                <p class="md:leading-6 leading-5 font-semibold text-gray-300 md:text-base text-sm max-w-[900px]">
                    Explore expert perspectives, industry trends, and in-depth analysis from professionals across services.
                </p>
            </div>
        </div>
    </div>

    {{-- Info: Insights --}}
    <div class="insights-container py-6 px-3 space-y-8 ">
        @forelse ($insights as $insight)
            <article class="outline-2 outline-gray-500/55 hover:outline-lime-700 rounded-md px-3 py-3 md:px-3.5 md:py-3.5 lg:px-6 lg:py-5 hover:scale-[1.01] hover:outline-grap-800 hover:shadow-2xl transition-all duration-300  ">
                <div class="inline-block bg-lime-100 text-lime-700 text-xs px-3 py-1 rounded-full mb-2">
                    {{ $insight->service->name }}
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 mb-2">
                    {{ $insight->title }}
                </h2>

                <p class="text-sm text-gray-500 mb-3">
                    By {{ $insight->user->company->name ?? $insight->user->role }} •
                    {{ $insight->created_at->format('M d, Y') }}
                </p>

                <p class="text-gray-700 mb-4 line-clamp-2">
                    {{ $insight->description }}
                </p>

                <a href="{{ route('insights.showInsight', $insight->slug) }}"
                    class="text-lime-600 font-medium hover:underline">
                    Read full insight →
                </a>
            </article>

        @empty
            <p>No insights available.</p>
        @endforelse

        <div class="mt-8">
            {{ $insights->links() }} 
        </div>

    </div>
@endsection
