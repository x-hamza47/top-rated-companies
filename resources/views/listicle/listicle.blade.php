@extends('shared.main')
@push('styles')
    @vite('resources/css/listicle.css')
@endpush

@section('title', $service->name)

@section('content')
    {{-- ! Hero Content --}}
    @include('listicle.hero')


    {{-- ! Section Of Agencies --}}
    <div class=" w-full max-w-[1920px] flex flex-col flex-wrap gap-5 md:p-10 lg:p-12 p-4 sm:p-7">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">
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
                            <a href="{{ route('profile.index', $company->slug) }}"
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
                        class=""> --}}
                    {{-- ! Column 1 --}}
                    <div
                        class="company-detail grid lg:grid-cols-[.28fr_.5fr_1fr] grid-cols-1 gap-x-7 gap-y-7 text-sm md:text-base md:px-0 mt-5">
                        <div class="flex flex-col gap-4 text-sm flex-1 lg:ml-5">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                    <path
                                        d="M14.101 24l-14.101-14.105v-9.895h9.855l14.145 14.101c-3.3 3.299-6.6 6.599-9.899 9.899zm-4.659-23h-8.442v8.481l13.101 13.105 8.484-8.484c-4.381-4.368-8.762-8.735-13.143-13.102zm-1.702 3.204c.975.976.975 2.56 0 3.536-.976.975-2.56.975-3.536 0-.976-.976-.976-2.56 0-3.536s2.56-.976 3.536 0zm-.708.707c.586.586.586 1.536 0 2.121-.585.586-1.535.586-2.121 0-.585-.585-.585-1.535 0-2.121.586-.585 1.536-.585 2.121 0z" />
                                </svg>
                                <p class="text-nowrap text-sm">{{ $company->details->min_project_size }}+</p>
                            </span>
                            <span class="flex items-center gap-2 ">
                                {{-- <i class="fa-regular fa-clock text-xl"></i> --}}
                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill-rule="evenodd"
                                    clip-rule="evenodd">
                                    <path
                                        d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 11h6v1h-7v-9h1v8z" />
                                </svg>
                                <p class="text-nowrap ">${{ str_replace('-', ' - $', $company->details->hourly_rate) }}
                                    / hr</p>
                            </span>

                            <span class="flex items-center gap-2">
                                @if ($company->details->is_freelancer)
                                    <i class="fas fa-user-tie text-gray-700"></i>
                                @else
                                    <i class="fas fa-users text-gray-700"></i>
                                @endif

                                <p class="text-nowrap">
                                    {{ $company->details->employees }}
                                </p>
                            </span>
                            <span class="flex items-center gap-2 ">
                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                    <path
                                        d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602" />
                                </svg>
                                <p class="">{{ $company->details->locations }}</p>
                            </span>
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

                                        $showLimit = 3;
                                        $totalServices = $company->services->count();
                                        $remainingServices = $company->services->slice($showLimit);
                                    @endphp
                                    @foreach ($company->services as $index => $service)
                                        <div class="{{ $colors[$index % count($colors)] }}"
                                            style="width: {{ $service->pivot->expertise_percentage }}%"></div>
                                    @endforeach
                                </div>

                                <div class="flex flex-col gap-2 mt-2 text-gray-700">
                                    @foreach ($company->services->take($showLimit) as $index => $service)
                                        <div class="flex items-center gap-2">
                                            <span class="w-4 h-4 rounded {{ $colors[$index % count($colors)] }}"></span>
                                            <strong class="sm:text-nowrap">{{ $service->pivot->expertise_percentage }}%
                                                {{ $service->name }}</strong>
                                        </div>
                                    @endforeach
                                    @if ($totalServices > $showLimit)
                                        <div class="relative inline-block">
                                            <span
                                                class="text-blue-500 cursor-pointer peer">+{{ $totalServices - $showLimit }}
                                                {{ Str::plural('service', $remainingServices->count()) }}</span>


                                            <div
                                                class="absolute left-0 bottom-5 mt-1 bg-white border border-gray-300 rounded shadow-lg p-2 pointer-events-none opacity-0 peer-hover:opacity-100 peer-active:opacity-100 z-10">
                                                <span class="text-gray-700 text-sm">
                                                    @foreach ($remainingServices as $index => $service)
                                                        {{ $service->name }}@if (!$loop->last)
                                                            •
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- ! Column 3 --}}
                        <div class="text-sm ">
                            <p class="break-word lg:line-clamp-6 md:line-clamp-5 line-clamp-3">{!! $company->about !!}
                            </p>
                        </div>
                    </div>

                    {{-- </div> --}}
                </div>
                @empty
                    <p>No companies found.</p>
                @endforelse
                <div class="mt-4">
                    {{ $companies->links() }}
                </div>

            </div>
        </div>

        {{-- ? Ready Section --}}
        <div class="section ready-section w-full">
            <div class="flex flex-col items-center gap-5">
                <h2 class="text-2xl md:text-4xl  text-white text-center font-semibold">Have a question or want to get in touch?
                </h2>
                <div class="flex gap-2">
                    <a href="{{ route('contact.showForm') }}"
                        class="font-semibold text-white bg-(--primary) rounded-md md:px-4 py-2 md:text-base text-sm px-2  cursor-pointer hover:bg-(--light-primary)">
                        Contact Us
                    </a>

                </div>
            </div>
        </div>


        {{-- ! Faqs --}}
        <div class="section  flex flex-col gap-4 ">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center">
                Frequently asked <span class="text-(--primary)">Questions</span>
            </h2>

            <div class="flex flex-col items-center text-center px-4 py-2 ">
                <div id="faqContainer" class="grid grid-cols-1 lg:grid-cols-2 gap-4 w-full mt-2 text-left">
                    @foreach ($serviceFaqs as $faq)
                        <div class="faq-item flex flex-col items-start w-full" data-index="{{ $loop->index }}">
                            <div
                                class="faq-header flex items-center justify-between w-full cursor-pointer bg-linear-to-r from-lime-50 to-white border border-lime-200 p-4 rounded transition-all">
                                <h2 class="text-sm">{{ $faq->question }}</h2>
                                <svg class="faq-icon transition-all duration-500 ease-in-out" width="18" height="18"
                                    viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m4.5 7.2 3.793 3.793a1 1 0 0 0 1.414 0L13.5 7.2" stroke="#1D293D"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p
                                class="faq-answer text-sm text-slate-500 px-4 overflow-hidden max-h-0 opacity-0 -translate-y-2 transition-all duration-500 ease-in-out">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    @endforeach


                </div>
            </div>


        </div>
    @endsection

    @push('scripts')
        @vite('resources/js/faqs.js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {

                $('.filter-btn').on('click', function(e) {
                    e.stopPropagation();
                    const $dropdown = $(this).next('.filter-dropdown');
                    $dropdown.toggleClass('hidden');
                    $('.filter-dropdown').not($dropdown).addClass('hidden');
                });

                $(document).on('click', function(e) {
                    if (!$(e.target).closest('.filter-dropdown, .filter-btn').length) {
                        $('.filter-dropdown').addClass('hidden');
                    }
                });

                $('.service-search').on('input', function() {
                    const val = $(this).val().toLowerCase().trim();
                    const $labels = $(this).closest('.filter-dropdown').find('label.service-option');
                    $labels.each(function() {
                        const text = $(this).data('label')?.toLowerCase() || '';
                        $(this).toggle(text.includes(val));
                    });
                });

                $(document).on('click', '.remove-chip', function() {
                    const $chip = $(this).closest('.filter-chip');
                    const name = $chip.find('.remove-chip').data('name');
                    const value = $chip.find('.remove-chip').data('value');


                    $chip.fadeOut(150, function() {
                        $(this).remove();
                        updateMoreLink();
                    });

                    const selector =
                        `input[name="${name}[]"][value="${value}"], input[name="${name}"][value="${value}"]`;
                    $(selector).prop('checked', false);

                    $chip.closest('form').submit();
                });

                function updateMoreLink() {
                    const $extra = $('.extra-chip');
                    const $toggle = $('#toggle-chips');

                    if ($extra.length === 0) {
                        $toggle.remove();
                        return;
                    }

                    if ($extra.is(':visible')) {
                        $toggle.text('Show Less');
                    } else {
                        $toggle.text(`+${$extra.length} more`);
                    }
                }

                // Toggle extra chips
                $(document).on('click', '#toggle-chips', function() {
                    const $extra = $('.extra-chip');
                    if ($extra.is(':visible')) {
                        $extra.addClass('hidden');
                        $(this).text(`+${$extra.length} more`);
                    } else {
                        $extra.removeClass('hidden');
                        $(this).text('Show Less');
                    }
                });

                // Initialize more link state
                updateMoreLink();
            });
        </script>
        <script>
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
