@extends('shared.main')
{{-- Info: Css File --}}
@push('styles') @vite("resources/css/home.css") @endpush

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
    <div
        class="section w-full max-w-[1920px] items-center bg-lime-700 flex gap-4 p-[50px] max-[720px]:p-5 max-[720px]:flex-col">
        <img class="w-[150px] h-[150px] object-cover rounded-md"
            src="https://s3.amazonaws.com/cdn.designcrowd.com/blog/40-Brand-Logos-for-Creative-and-Cool-Companies/orange-electronics-company-by-ions-brandcrowd.png"
            alt="">
        <div class="flex flex-col max-[720px]:items-center">
            <h1 class="text-6xl text-white w-fit text-center font-bold">Ready to start?</h1>
            <h1 class="text-4xl text-white w-fit text-center font-bold">Create your company profile for free</h1>
            <button
                class="flex justify-center gap-2 items-center w-fit bg-lime-900 p-3 text-center font-semibold text-white rounded-md">
                Watch Top Companies
                <svg width="22" height="22" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-white" stroke-width="5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
    {{-- ! Faq Section --}}
    @include('home.faqs')
    {{-- <div class="w-full mb-[13000px] text-white"></div> --}}
@endsection
@push('scripts')
    {{-- <script src="{{ asset('assets/js/services.js') }}"></script> --}}
    <script src="{{ asset('assets/js/accordian.js') }}"></script>
@endpush
