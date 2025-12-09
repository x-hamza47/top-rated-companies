@extends('shared.main')
{{-- Info: Css File --}}
@push('styles')
    @vite('resources/css/home.css')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
@endpush

@section('content')
    {{-- ! Hero Section --}}
    @include('home.hero')

    {{-- ! Services Section --}}
    @include('home.services')

    {{-- ! How it works --}}
    @include('home.works')

    {{-- ! Insight Section --}}
    @include('home.insights')

    {{-- ! Ready Section --}}
    <div class="section ready-section w-full">
        <div class="flex flex-col items-center gap-5">
            <h2 class="text-2xl md:text-4xl  text-white text-center font-semibold">Ready to find your next tech partner?Or list your
                company to grow?</h2>
            <div class="flex gap-2">
                <button
                    class="font-semibold text-white bg-(--primary) rounded-md md:px-4 py-2 md:text-base text-sm px-2  cursor-pointer hover:bg-(--light-primary)">
                    Hire a Company
                </button>
                <button
                    class="font-semibold text-white border-2 border-white  rounded-md md:px-4 py-2 md:text-base text-sm px-2  cursor-pointer hover:bg-white hover:text-lime-800">
                    List your Company
                </button>
            </div>
        </div>
    </div>
    {{-- ! Faq Section --}}
    @include('home.faqs')
@endsection
@push('scripts')
    {{-- <script src="{{ asset('assets/js/services.js') }}"></script> --}}
    <script src="{{ asset('assets/js/faqs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    {{-- <script src="{{ asset('assets/js/accordian.js') }}"></script> --}}

    <script>
        const workSwiper = new Swiper('.works-swipper', {
            slidesPerView: 1,
            spaceBetween: 40,
            loop: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.main-next',
                prevEl: '.main-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });

        var insightsSwiper = new Swiper(".insights-swiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
            },
            pagination: {
                el: ".insights-swiper .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 2,
                },
                1400: {
                    slidesPerView: 2,
                }
            }
        });
    </script>
@endpush
