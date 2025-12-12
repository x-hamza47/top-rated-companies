@extends('shared.main')
@push('styles')
    @vite('resources/css/listicle.css')
@endpush

@section('content')
{{-- ! Hero Content --}}
@include('listicle.hero')


{{-- ! Section Of Agencies --}}
<div class=" w-full max-w-[1920px] flex flex-col flex-wrap gap-5 md:p-10 lg:p-12 p-4 sm:p-7">
        {{-- <pre> {{ print_r($companies->toArray(), true)  }}</pre> --}}
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold ">
            List of the Best <span class="text-lime-600"> {{ $service->name }} </span> Agencies
        </h2>
        {{-- ! Quick Search Buttons --}}
        @include('listicle.filters')
        {{-- ?? List Of Agencies --}}
        <div class="company-wrapper flex flex-col gap-4">
            @forelse ($companies as $company)
                <div
                    class="company outline-2 outline-gray-500/55 hover:outline-lime-700 rounded-md px-3 py-3 md:px-3.5 md:py-3.5 lg:px-6 lg:py-5 hover:scale-[1.01] hover:outline-grap-800 hover:shadow-2xl transition-all duration-300 relative">
                    <button class="text-lime-900 font-semibold px-3 py-2  cursor-pointer absolute top-1 right-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M16 2v17.582l-4-3.512-4 3.512v-17.582h8zm2-2h-12v24l6-5.269 6 5.269v-24z" />
                        </svg>
                    </button>
                    <div class="company-intro max-[840px]:flex-col flex justify-between gap-2 ">
                        <div class="flex md:items-center gap-2 ">
                            <img src="{{ $company->logo }}" alt="{{ $company->name }}"
                                class="md:w-[85px] md:h-[85px] w-12 h-12 object-cover rounded-md bg-lime-900 p-1">
                            <div class="name flex flex-col ml-1">
                                <div class="flex sm:gap-2 gap-1  flex-wrap flex-col sm:flex-row">
                                    <h4 class="lg:text-4xl text-2xl font-semibold uppercase ">{{ $company->name }}</h4>
                                    @if ($company->verified)
                                        <span class="flex gap-2 items-center flex-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor" class="fill-lime-800"
                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                            </svg>
                                            <h5 class="text-xs sm:text-sm font-bold text-lime-800">Premier Verified</h5>
                                        </span>
                                    @endif
                                </div>
                                {{-- hack: Ratings Component --}}
                                <x-star-rating :rating="$company->reviews_avg_rating" :reviews="$company->reviews_count" />
                            </div>
                        </div>
                        <div
                            class="flex gap-3 max-[840px]:mt-2 flex-wrap justify-center max-[840px]:pr-0 max-[840px]:pt-0 pr-5 pt-5">
                            <a href="{{ route('profile.index',$company->slug) }}"
                                class="text-lime-600 h-fit rounded-md font-semibold border-2 border-lime-600 px-3 py-2 cursor-pointer hover:text-white active:text-white hover:bg-lime-600 active:bg-lime-600 flex-1 text-center text-nowrap text-sm md:text-base">
                                View Profile
                            </a>
                            <a href="{{ $company->details->website }}" target="_blank"
                                class="text-lime-800 h-fit rounded-md font-semibold border-2 border-lime-400 bg-lime-400 px-3 py-2 cursor-pointer hover:bg-white active:bg-white hover:text-lime-400 active:text-lime-400 flex-1 text-center text-nowrap text-sm md:text-base">
                                Visit Website
                            </a>

                        </div>

                    </div>
                    {{-- Info: Company Details --}}
                    {{-- <div
                        class="company-detail max-[840px]:flex-col flex lg:justify-between md:gap-12 sm:gap-7 gap-7 lg:gap-20 mt-5 text-sm md:text-base sm:px-8 md:px-0"> --}}
                    <div
                        class="company-detail grid lg:grid-cols-[.28fr_.5fr_1fr] grid-cols-1 gap-x-7 gap-y-7  mt-5 text-sm md:text-base md:px-0">
                        {{-- ! Column 1 --}}
                        <div class="grid lg:grid-cols-1 grid-cols-2 gap-y-5 gap-x-3 ">
                            {{-- <div class="flex md:flex-col justify-evenly gap-7"> --}}
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                    <path
                                        d="M14.101 24l-14.101-14.105v-9.895h9.855l14.145 14.101c-3.3 3.299-6.6 6.599-9.899 9.899zm-4.659-23h-8.442v8.481l13.101 13.105 8.484-8.484c-4.381-4.368-8.762-8.735-13.143-13.102zm-1.702 3.204c.975.976.975 2.56 0 3.536-.976.975-2.56.975-3.536 0-.976-.976-.976-2.56 0-3.536s2.56-.976 3.536 0zm-.708.707c.586.586.586 1.536 0 2.121-.585.586-1.535.586-2.121 0-.585-.585-.585-1.535 0-2.121.586-.585 1.536-.585 2.121 0z" />
                                </svg>
                                <p class="text-nowrap text-sm">{{ $company->details->min_project_size }}+</p>
                            </span>
                            <span class="flex items-center gap-2 ">
                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                    <path
                                        d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 11h6v1h-7v-9h1v8z" />
                                </svg>
                                <p class="text-nowrap ">${{ intval($company->details->hourly_rate_min) }}-${{ intval($company->details->hourly_rate_max) }}/hr</p>
                            </span>
                            {{-- </div> --}}
                            {{-- <div class="flex md:flex-col justify-evenly gap-7"> --}}
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                    <path
                                        d="M10.119 16.064c2.293-.53 4.427-.994 3.394-2.946-3.147-5.941-.835-9.118 2.488-9.118 3.388 0 5.643 3.299 2.488 9.119-1.065 1.964 1.149 2.427 3.393 2.946 1.985.458 2.118 1.428 2.118 3.107l-.003.828h-1.329c0-2.089.083-2.367-1.226-2.669-1.901-.438-3.695-.852-4.351-2.304-.239-.53-.395-1.402.226-2.543 1.372-2.532 1.719-4.726.949-6.017-.902-1.517-3.617-1.509-4.512-.022-.768 1.273-.426 3.479.936 6.05.607 1.146.447 2.016.206 2.543-.66 1.445-2.472 1.863-4.39 2.305-1.252.29-1.172.588-1.172 2.657h-1.331c0-2.196-.176-3.406 2.116-3.936zm-10.117 3.936h1.329c0-1.918-.186-1.385 1.824-1.973 1.014-.295 1.91-.723 2.316-1.612.212-.463.355-1.22-.162-2.197-.952-1.798-1.219-3.374-.712-4.215.547-.909 2.27-.908 2.819.015.935 1.567-.793 3.982-1.02 4.982h1.396c.44-1 1.206-2.208 1.206-3.9 0-2.01-1.312-3.1-2.998-3.1-2.493 0-4.227 2.383-1.866 6.839.774 1.464-.826 1.812-2.545 2.209-1.49.345-1.589 1.072-1.589 2.334l.002.618z" />
                                </svg>
                                <p class="text-nowrap">{{ intval($company->details->employees_min) }}-{{ intval($company->details->employees_max) }}</p>
                            </span>
                            <span class="flex items-center gap-2 ">
                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                    <path
                                        d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602" />
                                </svg>
                                <p class="">{{ $company->details->locations }}</p>
                            </span>
                            {{-- </div> --}}
                        </div>
                        {{-- ! Column 2 --}}
                        <div class="flex flex-col gap-4 text-sm flex-1 lg:ml-5">
                            <div class="flex flex-col gap-2 w-full">
                                <small class="uppercase text-gray-500 font-semibold">Services Provided</small>
                                {{-- * Bar --}}
                                <div class="w-full h-2 md:h-3 rounded-lg overflow-hidden flex ">
                                    @php
                                        $colors = [
                                            'bg-lime-600',
                                            'bg-purple-500',
                                            'bg-blue-400',
                                            'bg-pink-400',
                                            'bg-yellow-400',
                                            'bg-indigo-500',
                                        ];
                                    @endphp
                                    @foreach ($company->services as $index => $service)
                                        <div class="{{ $colors[$index % count($colors)] }}"
                                            style="width: {{ $service->pivot->expertise_percentage }}%"></div>
                                    @endforeach
                                </div>

                                <div class="flex flex-col gap-2 mt-2 text-gray-700">
                                    @foreach ($company->services as $index => $service)
                                        <div class="flex items-center gap-2">
                                            <span class="w-4 h-4 rounded {{ $colors[$index % count($colors)] }}"></span>
                                            <strong class="sm:text-nowrap">{{ $service->pivot->expertise_percentage }}%
                                                {{ $service->name }}</strong>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- ! Column 3 --}}
                        <div class="text-sm ">
                            <p class="break-word lg:line-clamp-6 md:line-clamp-5 line-clamp-4">{{ $company->about }}</p>
                            <span class="text-blue-500 font-medium inline">See all 26 Projects <i
                                    class="fa-solid fa-chevron-right"></i></span>
                        </div>
                    </div>
                    {{-- Info: Detail Boxes --}}
                    <div class="md:mt-6 w-full text-xs gap-4 font-semibold text-gray-700 mt-2 info-group">

                        <div class="buttons-container grid grid-cols-1 gap-4 overflow-hidden max-h-0 transition-all duration-500 ease-in-out md:max-h-full md:grid-cols-2 xl:grid-cols-4"
                            data-open="false">

                            <div class="button-wrapper flex-1">
                                <button
                                    class="border border-lime-800 rounded-md  px-9 py-4 hover:bg-lime-600 transition w-full h-full hover:text-white relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="absolute top-1/2 left-3 -translate-y-2/4">
                                        <path
                                            d="M23.873 9.81c.086-.251.127-.508.127-.763 0-.77-.379-1.514-1.055-1.982-2.152-1.492-1.868-1.117-2.68-3.544-.339-1.014-1.321-1.7-2.429-1.696-2.654.008-2.193.153-4.335-1.354-.446-.314-.974-.471-1.501-.471s-1.055.157-1.502.471c-2.154 1.515-1.687 1.362-4.335 1.354-1.107-.003-2.09.683-2.429 1.696-.812 2.433-.533 2.055-2.68 3.544-.675.469-1.054 1.212-1.054 1.982 0 .255.041.512.127.763.83 2.428.827 1.963 0 4.38-.086.251-.127.509-.127.763 0 .77.379 1.514 1.055 1.982 2.147 1.489 1.869 1.114 2.68 3.544.339 1.014 1.321 1.7 2.429 1.696 2.654-.009 2.193-.152 4.335 1.354.446.314.974.471 1.501.471s1.055-.157 1.502-.471c2.141-1.506 1.681-1.362 4.335-1.354 1.107.003 2.09-.683 2.429-1.696.812-2.428.528-2.053 2.68-3.544.675-.468 1.054-1.212 1.054-1.982 0-.254-.041-.512-.127-.763-.831-2.427-.827-1.963 0-4.38zm-7.565 1.984c.418.056.63.328.63.61 0 .323-.277.66-.844.705-.348.027-.434.312-.016.406.351.08.549.326.549.591 0 .314-.279.654-.913.771-.383.07-.421.445-.016.477.344.026.479.146.479.312 0 .466-.826 1.333-2.426 1.333-2.501.001-3.407-1.499-6.751-1.499v-4.964c1.766-.271 3.484-.817 4.344-3.802.239-.831.39-1.734 1.187-1.734 1.188 0 1.297 2.562.844 4.391.656.344 1.875.468 2.489.442.886-.036 1.136.409 1.136.745 0 .505-.416.675-.677.755-.304.094-.444.404-.015.461z" />
                                    </svg>
                                    Reviewd 8 times in the past 6 months
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="absolute top-1/2 right-3 -translate-y-2/4">
                                        <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                                    </svg>

                                </button>
                            </div>
                            <div class="button-wrapper flex-1">
                                <button
                                    class="border border-lime-800  rounded-md px-9 py-4 hover:bg-lime-600 transition w-full h-full hover:text-white relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" class="absolute top-1/2 left-3 -translate-y-2/4">
                                        <path
                                            d="M13 2h2v2h1v19h1v-15l6 3v12h1v1h-24v-1h1v-11h7v11h1v-19h1v-2h2v-2h1v2zm8 21v-2h-2v2h2zm-15 0v-2h-3v2h3zm8 0v-2h-3v2h3zm-2-4v-13h-1v13h1zm9 0v-1h-2v1h2zm-18 0v-2h-1v2h1zm4 0v-2h-1v2h1zm-2 0v-2h-1v2h1zm9 0v-13h-1v13h1zm7-2v-1h-2v1h2zm-18-1v-2h-1v2h1zm2 0v-2h-1v2h1zm2 0v-2h-1v2h1zm14-1v-1h-2v1h2zm0-2.139v-1h-2v1h2z"
                                            fill="currentColor" />
                                    </svg>
                                    Experience in 30 Industries
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="absolute top-1/2 right-3 -translate-y-2/4">
                                        <path fill="currentColor"
                                            d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                                    </svg>

                                </button>
                            </div>
                            <div class="button-wrapper flex-1 ">
                                <button
                                    class="border border-lime-800 rounded-md px-9 py-4 hover:bg-lime-600 transition w-full h-full hover:text-white relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" class="absolute top-1/2 left-3 -translate-y-2/4">
                                        <path
                                            d="M0 8v-2c0-1.104.896-2 2-2h18c1.104 0 2 .896 2 2v2h-22zm24 7.5c0 2.485-2.015 4.5-4.5 4.5s-4.5-2.015-4.5-4.5 2.015-4.5 4.5-4.5 4.5 2.015 4.5 4.5zm-2.156-.882l-.696-.696-2.116 2.169-.991-.94-.696.697 1.688 1.637 2.811-2.867zm-8.844.882c0 1.747.696 3.331 1.82 4.5h-12.82c-1.104 0-2-.896-2-2v-7h14.82c-1.124 1.169-1.82 2.753-1.82 4.5zm-5 .5h-5v1h5v-1zm3-2h-8v1h8v-1z"
                                            fill="currentColor" />
                                    </svg>
                                    4.9 out of 5.0 rating for cost
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="absolute top-1/2 right-3 -translate-y-2/4">
                                        <path fill="currentColor"
                                            d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                                    </svg>

                                </button>
                            </div>
                            <div class="button-wrapper flex-1 ">
                                <button
                                    class="border border-lime-800 rounded-md px-9 py-4 hover:bg-lime-600 transition w-full h-full hover:text-white relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="absolute top-1/2 left-3 -translate-y-2/4">
                                        <path d="M8 24l3-9h-9l14-15-3 9h9l-14 15z" />
                                    </svg>
                                    Responsive
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="currentColor"
                                        class="absolute top-1/2 right-3 -translate-y-2/4">
                                        <path fill="currentColor"
                                            d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                        <div class="mt-2 md:hidden">
                            <button
                                class="toggle-btn border border-lime-800 rounded-md px-3 py-3 font-medium w-full text-blue-700"
                                aria-expanded="false">
                                More info +
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p>No companies found.</p>
            @endforelse
            {{-- Pagination Links --}}
            <div class="mt-4">
                {{ $companies->links() }}
            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const infoGroups = document.querySelectorAll('.info-group');

        function updateGroupHeight(group) {
            const container = group.querySelector('.buttons-container');
            if (!container) return;
            if (window.innerWidth >= 768) {
                container.style.maxHeight = null;

                const btn = group.querySelector('.toggle-btn');
                if (btn) {
                    btn.setAttribute('aria-expanded', 'true');
                }
            } else {
                if (container.dataset.open === "true") {
                    container.style.maxHeight = container.scrollHeight + "px";
                } else {
                    container.style.maxHeight = "0px";
                }
                const btn = group.querySelector('.toggle-btn');
                if (btn) {
                    btn.setAttribute('aria-expanded', container.dataset.open === "true");
                }
            }
        }

        function updateAllGroups() {
            infoGroups.forEach(updateGroupHeight);
        }


        updateAllGroups();


        let rTimer;
        window.addEventListener('resize', () => {
            clearTimeout(rTimer);
            rTimer = setTimeout(updateAllGroups, 100);
        });


        infoGroups.forEach(group => {
            const btn = group.querySelector('.toggle-btn');
            const container = group.querySelector('.buttons-container');
            if (!btn || !container) return;

            if (typeof container.dataset.open === 'undefined') container.dataset.open = "false";

            btn.addEventListener('click', () => {
                const isOpen = container.dataset.open === "true";

                infoGroups.forEach(otherGroup => {
                    if (otherGroup !== group) {
                        const otherContainer = otherGroup.querySelector('.buttons-container');
                        const otherBtn = otherGroup.querySelector('.toggle-btn');
                        if (otherContainer && otherContainer.dataset.open === "true") {
                            otherContainer.dataset.open = "false";
                            otherContainer.style.maxHeight = "0px";
                            if (otherBtn) {
                                otherBtn.textContent = "More info +";
                                otherBtn.setAttribute('aria-expanded', 'false');
                            }
                        }
                    }
                });

                if (isOpen) {
                    container.dataset.open = "false";
                    container.style.maxHeight = "0px";
                    btn.textContent = "More info +";
                    btn.setAttribute('aria-expanded', 'false');
                } else {
                    container.dataset.open = "true";
                    container.style.maxHeight = container.scrollHeight + "px";
                    btn.textContent = "Less info -";
                    btn.setAttribute('aria-expanded', 'true');
                }
            });

            window.addEventListener('load', () => updateGroupHeight(group));
        });



        // ! Counter Animation
        const element = document.getElementById('companyCount');
        const target = +element.getAttribute('data-target');
        const duration = 3000;
        let start = null;

        function easeOutQuad(t) {
            return t * (2 - t);
        }

        function animateCount(timestamp) {
            if (!start) start = timestamp;
            const progress = (timestamp - start) / duration;
            const easedProgress = easeOutQuad(Math.min(progress, 1));
            element.innerText = Math.ceil(easedProgress * target) + '+ Companies';
            if (progress < 1) {
                requestAnimationFrame(animateCount);
            }
        }

        requestAnimationFrame(animateCount);
    </script>
@endpush
