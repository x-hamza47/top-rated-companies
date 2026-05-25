@extends('shared.main')
{{-- Info: Css File --}}
@push('styles')
    @vite('resources/css/home.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
@endpush

@section('schema')
    <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebSite",
  "name": "Top Firms Reviewer",
  "url": "https://topfirmsreviewer.com/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://topfirmsreviewer.com/companies?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
    <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "How to Pick the Perfect Software Development Partner?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Finding the right development team can transform your project from good to exceptional. This guide highlights what to look for, that is, experience, proven results, and smooth collaboration, so you are able to collaborate with confidence and achieve your goals faster."
    }
  },{
    "@type": "Question",
    "name": "What are IT Outsourcing Trends You Can’t Ignore in 2026?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "The outsourcing landscape is evolving at lightning speed. From flexible team models to cost-efficient solutions, this article uncovers the latest trends that are helping businesses expand smartly and remain a step ahead of the competition."
    }
  },{
    "@type": "Question",
    "name": "How to Get the Most Value from Your Software Projects?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Software is an investment, and every investment should deliver results. This piece shares practical tips to maximize ROI, from setting clear objectives to choosing the right partners, making sure that every project drives real business impact."
    }
  }]
}
</script>
@endsection

@section('content')
    {{-- ! Hero Section --}}
    @include('home.hero', ['services' => $services])

    {{-- ! Services Section --}}
    @include('home.services', ['categories', $navCategories])

    {{-- ! How it works --}}
    @include('home.works')

    {{-- ! Insight Section --}}
    @include('home.insights')

    {{-- ! Ready Section --}}
    <div class="section ready-section w-full">

        <div class="flex flex-col items-center gap-5">
            <h2 class="text-2xl md:text-4xl  text-white text-center font-semibold">Ready to find your next tech partner?Or
                list your
                company to grow?</h2>
            <div class="flex gap-2">
                <button
                    class="font-semibold text-white bg-(--color-primary) rounded-md md:px-4 py-2 md:text-base text-sm px-2  cursor-pointer hover:bg-(--color-primary-hover)">
                    Hire a Company
                </button>
                <button
                    class="font-semibold text-white border-2 border-white  rounded-md md:px-4 py-2 md:text-base text-sm px-2 cursor-pointer hover:bg-white hover:text-lime-800">
                    List your Company
                </button>
            </div>
        </div>
    </div>
    {{-- ! Faq Section --}}
    @include('home.faqs')
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    @vite(['resources/js/home.js', 'resources/js/faqs.js'])
@endpush
