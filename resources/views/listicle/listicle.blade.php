@extends('shared.main')
@push('styles')
    @vite('resources/css/listicle.css')
@endpush

@section('title', "Top {$service->name} Companies in " . now()->format('F Y'))
@section('meta_description',
    "Compare top $service->name companies. Read verified reviews, pricing, and services to find
    the best $service->name partner for your business.")
@section('schema')
    @include('listicle.schema.listicleSchema')
@endsection
@section('content')

    {{-- ! Hero Content --}}?
    @include('listicle.hero')

    {{-- ! Section Of Agencies --}}
    <div class=" w-full max-w-[1920px] flex flex-col flex-wrap md:p-10 lg:p-12 p-4 sm:p-7">
        <h2 class="text-3xl sm:text-4xl font-bold text-(--color-text)">
            List of the Best <span class="text-(--color-primary)"> {{ $service->name }} </span> Agencies
        </h2>
        <div id="stickyTrigger"></div>
        {{-- ! Quick Search Buttons --}}
        <div class="sticky top-20 bg-(--color-background) pt-6 z-999 -mx-4 sm:-mx-7 md:-mx-10 lg:-mx-12 px-4 sm:px-7 md:px-10 lg:px-12 "
            id="stickyFilters">
            @include('listicle.filters')
        </div>
        {{-- ?? List Of Agencies --}}
        <div class="company-wrapper flex flex-col gap-4 mt-2">
            @forelse ($companies as $company)
                <div class="company outline-2 bg-(--color-surface) outline-gray-500/55 hover:outline-(--color-primary) rounded-md px-3 py-3 md:px-3.5 md:py-3.5 lg:px-6 lg:py-5 hover:scale-[1.01] hover:outline-grap-800 hover:shadow-2xl transition-all duration-300 relative"
                    id="{{ $company->id }}">
                    <button class="text-(--color-primary) font-semibold px-3 py-2  cursor-pointer absolute top-1 right-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M16 2v17.582l-4-3.512-4 3.512v-17.582h8zm2-2h-12v24l6-5.269 6 5.269v-24z" />
                        </svg>
                    </button>
                    <div class="company-intro max-[840px]:flex-col flex justify-between gap-2 text-(--color-text)">
                        <div class="flex items-start md:items-center gap-2">
                            <img src="{{ $company->logo }}" alt="{{ $company->name }}"
                                class="md:w-[50px] md:h-[50px] w-12 h-12 object-cover border border-(--color-border) rounded-md">
                            <div class="name flex flex-col ml-1">
                                <div class="flex sm:gap-2 gap-1 flex-wrap flex-col sm:flex-row">
                                    <p class="lg:text-2xl text-xl font-bold uppercase ">{{ $company->name }}</p>
                                    @if ($company->verified)
                                        <span
                                            class="flex sm:gap-1.5 gap-1 items-center flex-wrap bg-lime-200/80 md:px-2.5 h-fit sm:py-1 py-0.5 px-2 rounded-full w-max md:self-center">
                                            <svg class="md:w-4 md:h-4 w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M21.007 8.27C22.194 9.125 23 10.45 23 12c0 1.55-.806 2.876-1.993 3.73.24 1.442-.134 2.958-1.227 4.05-1.095 1.095-2.61 1.459-4.046 1.225C14.883 22.196 13.546 23 12 23c-1.55 0-2.878-.807-3.731-1.996-1.438.235-2.954-.128-4.05-1.224-1.095-1.095-1.459-2.611-1.217-4.05C1.816 14.877 1 13.551 1 12s.816-2.878 2.002-3.73c-.242-1.439.122-2.955 1.218-4.05 1.093-1.094 2.61-1.467 4.057-1.227C9.125 1.804 10.453 1 12 1c1.545 0 2.88.803 3.732 1.993 1.442-.24 2.956.135 4.048 1.227 1.093 1.092 1.468 2.608 1.227 4.05Zm-4.426-.084a1 1 0 0 1 .233 1.395l-5 7a1 1 0 0 1-1.521.126l-3-3a1 1 0 0 1 1.414-1.414l2.165 2.165 4.314-6.04a1 1 0 0 1 1.395-.232Z"
                                                    class="fill-(--color-primary)" />
                                            </svg>
                                            <p class="text-xs font-semibold text-(--color-primary)">Verified</p>
                                        </span>
                                    @endif
                                </div>
                                
                                {{-- hack: Ratings Component --}}
                                <x-star-rating :rating="$company->reviews_avg_rating" :reviews="$company->reviews_count" />
                            </div>
                        </div>
                        <div
                            class="flex gap-3 max-[840px]:mt-2 flex-wrap justify-center max-[840px]:pr-0 max-[840px]:pt-0 pr-5 pt-5">
                            <a href="{{ route('profile.index', $company->slug) }}" target="_blank"
                                class="text-(--color-primary) h-fit rounded-md font-semibold border-2 border-(--color-primary) px-3 py-2 cursor-pointer hover:text-white active:text-white hover:bg-(--color-primary) active:bg-(--color-primary) flex-1 text-center text-nowrap text-sm md:text-base"> 
                                View Profile
                            </a>
                            @if (filled($company->details->website))
                                <a href="{{ $company->details->website }}" target="_blank"
                                    class="text-lime-800 h-fit rounded-md font-semibold border-2 border-lime-400 bg-lime-400 px-3 py-2 cursor-pointer hover:bg-(--color-background) active:bg-(--color-primary) hover:text-(--color-primary-hover) active:text-(--color-primary-hover) flex-1 text-center text-nowrap text-sm md:text-base">
                                    Visit Website
                                </a>
                            @endif
                        </div>

                    </div>
                    {{-- Info: Company Details --}}
                    {{-- <div
                        class=""> --}}
                    {{-- ! Column 1 --}}
                    <div
                        class="company-detail grid lg:grid-cols-[.28fr_.5fr_1fr] grid-cols-1 gap-x-7 gap-y-7 text-sm md:text-base md:px-0 mt-5">
                        <div class="flex flex-col gap-4 text-sm flex-1 lg:ml-5 text-(--color-text)">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    stroke-linecap="round" stroke-linejoin="round" stroke="currentColor" fill-rule="evenodd"
                                    clip-rule="evenodd">
                                    <path
                                        d="M14.101 24l-14.101-14.105v-9.895h9.855l14.145 14.101c-3.3 3.299-6.6 6.599-9.899 9.899zm-4.659-23h-8.442v8.481l13.101 13.105 8.484-8.484c-4.381-4.368-8.762-8.735-13.143-13.102zm-1.702 3.204c.975.976.975 2.56 0 3.536-.976.975-2.56.975-3.536 0-.976-.976-.976-2.56 0-3.536s2.56-.976 3.536 0zm-.708.707c.586.586.586 1.536 0 2.121-.585.586-1.535.586-2.121 0-.585-.585-.585-1.535 0-2.121.586-.585 1.536-.585 2.121 0z" />
                                </svg>
                                <p class="text-nowrap text-sm">${{ $company->details->min_project_size }}+</p>
                            </span>
                            <span class="flex items-center gap-2 ">
                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25"
                                    stroke-linecap="round" stroke-linejoin="round" stroke="currentColor" fill-rule="evenodd"
                                    clip-rule="evenodd">
                                    <path
                                        d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 11h6v1h-7v-9h1v8z" />
                                </svg>
                                <p class="text-nowrap ">{{ $company->details->formattedHourlyRate }}
                                    / hr</p>
                            </span>

                            <span class="flex items-center gap-2">
                                @if ($company->details->is_freelancer)
                                    <i class="fas fa-user-tie text-(--color-text)"></i>
                                @else
                                    <i class="fas fa-users text-(--color-text)"></i>
                                @endif

                                <p class="text-nowrap">
                                    {{ $company->details->employees }}
                                </p>
                            </span>
                            <span class="flex items-center gap-2 ">
                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    stroke-linecap="round" stroke-linejoin="round" stroke="currentColor" fill-rule="evenodd"
                                    clip-rule="evenodd">
                                    <path
                                        d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602" />
                                </svg>
                                <p class="">{{ $company->details->locations }}</p>
                            </span>
                        </div>
                        {{-- ! Column 2 --}}
                        <div class="flex flex-col gap-4 text-sm flex-1 lg:ml-5">
                            <div class="flex flex-col gap-2 w-full">
                                <small class="uppercase text-(--color-text-muted) font-semibold">Services Provided</small>
                                {{-- * Bar --}}
                                <div class="w-full h-2 md:h-3 rounded-lg overflow-hidden flex">
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

                                <div class="flex flex-col gap-2 mt-2 text-(--color-text)">
                                    @foreach ($company->services->take($showLimit) as $index => $service)
                                        <div class="flex items-center gap-2">
                                            <span class="w-4 h-4 rounded {{ $colors[$index % count($colors)] }}"></span>
                                            <span
                                                class="sm:text-nowrap {{ $loop->first ? 'font-bold text-[14px]' : 'font-normal text-[13px]' }} ">{{ $service->pivot->expertise_percentage }}%
                                                {{ $service->name }}</span>
                                        </div>
                                    @endforeach
                                    @if ($totalServices > $showLimit)
                                        <div class="relative inline-block">
                                            <span
                                                class="text-blue-500 cursor-pointer peer">+{{ $totalServices - $showLimit }}
                                                {{ Str::plural('service', $remainingServices->count()) }}</span>


                                            <div
                                                class="absolute left-0 bottom-5 mt-1 bg-(--color-surface) border border-(--color-border) rounded shadow-lg px-3 py-2 pointer-events-none opacity-0 peer-hover:opacity-100 peer-active:opacity-100 z-10">
                                                <span class="text-(--color-text) text-xs">
                                                    @foreach ($remainingServices as $index => $service)
                                                        {{ $service->name }}@if (!$loop->last)
                                                            <small class="text-(--color-muted) text-base mx-1">•</small>
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
                        <div class="text-sm text-(--color-text)">
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
                <h2 class="text-2xl md:text-4xl text-white text-center font-semibold">Have a question or want to get in touch?
                </h2>
                <div class="flex gap-2">
                    <a href="{{ route('contact.showForm') }}"
                        class="font-semibold text-white bg-(--color-primary) rounded-md md:px-4 py-2 md:text-base text-sm px-2  cursor-pointer hover:bg-(--color-primary-hover)">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>


        {{-- ! Faqs --}}
        <div class="section  flex flex-col gap-4 ">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center">
                Frequently asked <span class="text-(--color-primary)">Questions</span>
            </h2>

            <div class="flex flex-col items-center text-center px-4 py-2 ">
                <div id="faqContainer" class="grid grid-cols-1 lg:grid-cols-2 gap-4 w-full mt-2 text-left">
                    @foreach ($serviceFaqs as $faq)
                        <div class="faq-item flex flex-col items-start w-full" data-index="{{ $loop->index }}">
                            <div
                                class="faq-header flex items-center justify-between w-full cursor-pointer bg-linear-to-r from-(--color-primary-50) to-(--color-background) border border-lime-200 p-4 rounded transition-all">
                                <p class="text-sm">{{ $faq->question }}</p>
                                <svg class="faq-icon transition-all duration-500 ease-in-out" width="18" height="18"
                                    viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m4.5 7.2 3.793 3.793a1 1 0 0 0 1.414 0L13.5 7.2" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p
                                class="faq-answer text-sm text-(--color-text)/70 px-4 overflow-hidden max-h-0 opacity-0 -translate-y-2 transition-all duration-500 ease-in-out">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    @endforeach


                </div>
            </div>


        </div>
    @endsection

    @push('scripts')
        @vite(['resources/js/listicle.js'])
    @endpush
