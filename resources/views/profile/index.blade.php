@extends('shared.main')

@push('styles')
    @vite('resources/css/listicle.css')
@endpush

@section('title', "$company->name Reviews ($company->reviews_count), Pricing, Services & Ratings | Top Firms Reviewer")
@section('meta_description', "Read $company->reviews_count verified reviews of $company->name. Explore ratings, pricing,
    services, and company details on Top Firms Reviewer.")
@section('og_image', $company->logo ?? asset('images/og.png'))
@section('schema')
    <script type="application/ld+json">
{
 "@@context": "https://schema.org",
 "@@type": "Organization",
 "name": "{{ $company->name }}",
 "url": "{{ url()->current() }}",
 "logo": "{{ $company->logo }}",
 "sameAs": [
    @foreach ($company->details->social_links as $url)
        "{{ $url }}"@if(!$loop->last),@endif
    @endforeach
 ],
 "aggregateRating": {
   "@type": "AggregateRating",
   "ratingValue": "{{ number_format($company->reviews_avg_rating, 1) }}",
   "reviewCount": "{{ $company->reviews_count }}",
   "bestRating": "5",
   "worstRating": "1"
 }
}
</script>
@endsection

@section('content')
    {{-- ! Hero Section --}}
    @include('profile.hero')

    {{-- ! Sub-Section --}}
    @include('profile.details')

    {{-- ! Pricing Snapshot --}}
    <div class="section flex flex-col gap-4">
        <h2 class="text-2xl font-bold">Pricing Snapshot</h2>
        <div
            class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-(--color-border) border border-(--color-border) rounded-xl overflow-hidden bg-(--color-surface)">

            {{-- Most Common Project Size --}}
            <div class="flex flex-col gap-1 px-6 py-5">
                <small class="text-(--color-text-muted) text-sm font-medium">Most Common Project Size:</small>
                <span class="priceRange text-2xl font-bold text-(--color-text)" data-company="{{ $company->id }}">
                    {{ '$' . number_format($reviews->pluck('project_size')->map(fn($v) => (int) str_replace(['$', ','], '', $v))->min()) }}
                    –
                    {{ '$' . number_format($reviews->pluck('project_size')->map(fn($v) => (int) str_replace(['$', ','], '', $v))->max()) }}
                </span>
                <small class="text-(--color-text-muted) text-xs">Based on {{ $reviews->count() }} Reviews</small>
            </div>

            {{-- Average Hourly Rate --}}
            <div class="flex flex-col gap-1 justify-center items-center px-6 py-5">
                <small class="text-(--color-text-muted) text-sm font-medium">Average Hourly Rate:</small>
                <span class="text-2xl font-bold text-(--color-text)">${{ $company->details->hourly_rate }}</span>
            </div>

            {{-- Rating for Cost --}}
            <div class="flex flex-col gap-1 items-center justify-center px-6 py-5">
                <small class="text-(--color-text-muted) text-sm font-medium">Rating for Cost:</small>
                <span class="flex items-center gap-3">
                    <span class="text-2xl font-bold text-(--color-text)">{{ intval($reviews->avg('cost')) }}/5</span>
                    <div class="w-24 bg-(--color-border) rounded-full h-2">
                        <div class="h-2 rounded-full bg-(--color-primary)"
                            style="width: {{ (intval($reviews->avg('cost')) / 5) * 100 }}%"></div>
                    </div>
                </span>
            </div>

        </div>

        {{-- Service filter buttons --}}
        <div class="project-size-wrapper flex gap-2 flex-wrap mt-1">
            <button data-service="all"
                class="tag max-[600px]:grow bg-(--color-secondary)/10 outline-(--color-secondary) outline-2 text-(--color-secondary) rounded-md py-1 px-3 text-sm active">All</button>
            @foreach ($reviews->unique('service_id') as $review)
                <button data-service="{{ $review->service_id }}"
                    class="tag max-[600px]:grow bg-(--color-secondary)/10 outline-(--color-secondary) outline-2 text-(--color-secondary) rounded-md py-1 px-3 text-sm">
                    {{ $review->service->name }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- ! Reviews --}}
    <a href="{{ route('review.form', $company->slug) }}" class="btn-outline-primary btn cursor-pointer w-fit">Submit
        Review</a>

    <div id="review" class="section flex flex-col gap-4">
        <h2 class="text-2xl font-bold">Reviews</h2>

        @foreach ($reviews as $review)
            <div id="review-{{ $review->id }}" class="border border-(--color-border) rounded-xl bg-(--color-surface) overflow-hidden">

                <div
                    class="grid grid-cols-1 md:grid-cols-[180px_1fr_1fr_160px] divide-y md:divide-y-0 md:divide-x divide-(--color-border)">

                    {{-- Column 1: The Project --}}
                    <div class="flex flex-col gap-3 p-4">
                        <strong class="uppercase text-(--color-text-muted) text-xs tracking-widest">The Project</strong>
                        <div class="flex flex-col gap-2">
                            <span class="flex gap-2 items-start">
                                <i class="fa-regular fa-building text-(--color-text-muted) mt-0.5 w-4 shrink-0"></i>
                                <small class="font-semibold text-(--color-text)">{{ $review->service->name }}</small>
                            </span>
                            <span class="flex gap-2 items-start">
                                <i class="fa-solid fa-tag text-(--color-text-muted) mt-0.5 w-4 shrink-0"></i>
                                <small class="text-(--color-text-secondary)">{{ $review->project_size }}</small>
                            </span>
                            <span class="flex gap-2 items-start">
                                <i class="fa-regular fa-calendar text-(--color-text-muted) mt-0.5 w-4 shrink-0"></i>
                                <small class="text-(--color-text-secondary)">{{ $review->project_duration }}</small>
                            </span>
                        </div>
                        {{-- Rating box --}}
                        <div
                            class="mt-auto border border-(--color-border) rounded-lg bg-(--color-surface-hover) flex flex-col items-center py-4 gap-1">
                            <span class="text-4xl font-bold text-(--color-text)">{{ $review->rating }}</span>
                            <div class="flex gap-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fa-solid fa-star text-sm {{ $i <= $review->rating ? 'text-(--color-primary)' : 'text-(--color-border)' }}"></i>
                                @endfor
                            </div>
                            <div class="flex flex-col w-full px-3 mt-2 gap-1 text-xs">
                                <span class="flex justify-between">
                                    <span class="text-(--color-text-muted)">Quality</span>
                                    <span class="font-semibold">{{ $review->quality }}</span>
                                </span>
                                <span class="flex justify-between">
                                    <span class="text-(--color-text-muted)">Schedule</span>
                                    <span class="font-semibold">{{ $review->schedule }}</span>
                                </span>
                                <span class="flex justify-between">
                                    <span class="text-(--color-text-muted)">Cost</span>
                                    <span class="font-semibold">{{ $review->cost }}</span>
                                </span>
                                <span class="flex justify-between">
                                    <span class="text-(--color-text-muted)">Willing to Refer</span>
                                    <span class="font-semibold">{{ $review->willing_to_refer }}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Column 2: The Review --}}
                    <div class="flex flex-col gap-3 p-4">
                        <strong class="uppercase text-(--color-text-muted) text-xs tracking-widest">The Review</strong>
                        <h3 class="text-lg font-bold text-(--color-text) leading-snug">{{ $review->project_title }}</h3>
                        <p class="text-(--color-text-secondary) text-sm leading-relaxed">
                            "{{ $review->review }}"
                        </p>
                        <small class="text-(--color-text-muted) text-xs">{{ $review->created_at->diffForHumans() }}</small>

                        @if ($review->project_summary)
                            <div class="mt-auto pt-3 border-t border-(--color-border)">
                                <strong class="uppercase text-(--color-text-muted) text-xs tracking-widest">Feedback
                                    Summary</strong>
                                <p class="text-(--color-text-secondary) text-sm mt-1 leading-relaxed">
                                    {{ $review->project_summary }}</p>
                            </div>
                        @endif
                    </div>

                    {{-- Column 3: Project Summary (hidden on mobile) --}}
                    <div class="hidden md:flex flex-col gap-3 p-4">
                        <strong class="uppercase text-(--color-text-muted) text-xs tracking-widest">Project Summary</strong>
                        <p class="text-(--color-text-secondary) text-sm leading-relaxed">{{ $review->project_summary }}</p>
                    </div>

                    {{-- Column 4: The Reviewer --}}
                    <div class="flex flex-col gap-3 p-4">
                        <strong class="uppercase text-(--color-text-muted) text-xs tracking-widest">The Reviewer</strong>
                        <div class="flex flex-col gap-2">
                            <span class="flex gap-2 items-center">
                                <div
                                    class="w-9 h-9 rounded-full bg-(--color-primary) flex items-center justify-center text-white text-sm font-bold shrink-0">
                                    {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                                </div>
                                <div class="flex flex-col">
                                    <small class="font-semibold text-(--color-text)">{{ $review->reviewer_name }}</small>
                                    <small
                                        class="text-(--color-text-muted) text-xs">{{ $review->service->category->name }}</small>
                                </div>
                            </span>

                            <span class="flex gap-2 items-center">
                                <i class="fa-solid fa-location-dot text-(--color-text-muted) w-4 shrink-0"></i>
                                <small class="text-(--color-text-secondary)">{{ $company->details->locations }}</small>
                            </span>
                            <span class="flex gap-2 items-center">
                                <i class="fa-solid fa-users text-(--color-text-muted) w-4 shrink-0"></i>
                                <small class="text-(--color-text-secondary)">{{ $company->details->employees }}</small>
                            </span>
                            @if ($company->verified)
                                <span class="flex gap-2 items-center mt-1">
                                    <span
                                        class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-600 border border-emerald-500/30 rounded-full px-2.5 py-0.5 text-xs font-semibold">
                                        <i class="fa-solid fa-circle-check text-xs"></i>
                                        Verified
                                    </span>
                                </span>
                            @endif
                        </div>

                        {{-- Share --}}
                        <button
                            onclick="navigator.clipboard.writeText('{{ url()->current() }}#review-{{ $review->id }}').then(() => {
        this.innerHTML = '<i class=\'fa-solid fa-check\'></i> Copied!';
        setTimeout(() => this.innerHTML = '<i class=\'fa-regular fa-share-from-square\'></i> Share', 2000);
    })"
                            class="mt-auto flex items-center gap-1.5 text-(--color-text-muted) hover:text-(--color-text) text-xs transition-colors w-fit">
                            <i class="fa-regular fa-share-from-square"></i>
                            Share
                        </button>
                    </div>

                </div>
            </div>
        @endforeach

        <div class="mt-4 flex justify-center">
            {{ $reviews->withQueryString()->fragment('review')->links() }}
        </div>
    </div>

    {{-- ! Social Links --}}
    @php
        $socialColors = [
            'facebook' => 'bg-[#1877F2] text-white hover:bg-[#1464d8]',
            'instagram' => 'bg-[#E1306C] text-white hover:bg-[#c4285d]',
            'twitter' => 'bg-[#000000] text-white hover:bg-[#333333]',
            'linkedin' => 'bg-[#0A66C2] text-white hover:bg-[#0958a8]',
        ];
    @endphp
    <div class="section border-t border-(--color-border) flex flex-col gap-3 pt-8">
        <h2 class="text-xl font-semibold">Connect with {{ $company->name }} on Social</h2>
        <div class="flex gap-2 flex-wrap">
            @foreach ($company->details->social_links as $platform => $url)
                <a href="{{ $url }}" target="_blank"
                    class="flex gap-2 items-center text-sm px-4 py-2 rounded-md font-medium transition-colors {{ $socialColors[$platform] ?? 'bg-gray-500 text-white' }}">
                    <i class="fa-brands fa-{{ $platform }}"></i>
                    {{ ucfirst($platform) }}
                </a>
            @endforeach
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/js/projectSize.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="{{ asset('assets/js/chart.js') }}"></script>
        <script>
            window.chartData = {
                labels: @json($company->services->pluck('name')->toArray()),
                data: @json($company->services->pluck('pivot.expertise_percentage')->toArray())
            };
        </script>
        <script>
            const modal = document.getElementById('inquiryModal');
            const openBtn = document.getElementById('openInquiryModal');
            const closeBtn = document.getElementById('closeInquiryModal');

            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });

            closeBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });

            @if ($errors->any())
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            @endif
        </script>
    @endpush
@endsection
