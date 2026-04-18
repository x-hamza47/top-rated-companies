@extends('shared.main')
@push('styles')
    @vite('resources/css/listicle.css')
@endpush
@section('title', "Best {{ $service->name }} Packages ")
@section('meta_description', "Explore verified {{ $service->name }} packages from top companies. Compare pricing, features, and services to choose the right solution for your business.")

@section('content')
    {{-- !Hero Section --}}
    @include('packages.hero')

    {{-- ! Section Of Packages --}}
    <div class=" w-full max-w-[1920px] flex flex-col flex-wrap gap-5 md:p-10 lg:p-12 p-4 sm:p-7">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800">
            List of the Best <span class="text-lime-600"> {{ $service->name }} </span> Packages
        </h2>

        {{-- Info: Package boxes --}}
        <div class="package-wrapper grid lg:grid-cols-2 grid-cols-1 gap-x-6 gap-y-5">
            @foreach ($packages as $package)
                <div
                    class="package outline-2 outline-gray-500/55 hover:outline-lime-700 rounded-md px-3 py-3 md:px-3.5 md:py-3.5 lg:px-6 lg:py-5 hover:scale-[1.01] hover:outline-grap-800 hover:shadow-2xl transition-all duration-300 text-gray-800 flex flex-wrap gap-3">
                    <div class="company-detail bg-lime-700/5 flex flex-col items-center gap-y-3 min-w-64 sm:py-5 ">
                        <div>
                            <img src="{{ $package->company->logo }}" alt="{{ $package->company->name }}"
                                class="md:w-[47px] md:h-[47px] w-10 h-10 object-cover border border-gray-200 rounded-md">
                        </div>
                        <p class="md:text-lg text-base font-bold uppercase">{{ $package->company->name }}</p>
                        {{-- hack: Ratings Component --}}
                        <x-star-rating :rating="$package->company->reviews_avg_rating" :reviews="$package->company->reviews_count" reviewDisable />
                        <span class="flex items-center gap-2 ">
                            <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" stroke="currentColor" fill-rule="evenodd"
                                clip-rule="evenodd">
                                <path
                                    d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602" />
                            </svg>
                            <p class="text-sm">{{ $package->company->details->locations }}</p>
                        </span>
                        @if ($package->company->verified)
                            <span
                                class="flex w-max gap-2 items-center flex-wrap bg-lime-200/80 md:px-3 h-fit py-1 px-2 rounded-full">
                                <svg class="md:w-4.5 md:h-4.5 w-4 h-4" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M21.007 8.27C22.194 9.125 23 10.45 23 12c0 1.55-.806 2.876-1.993 3.73.24 1.442-.134 2.958-1.227 4.05-1.095 1.095-2.61 1.459-4.046 1.225C14.883 22.196 13.546 23 12 23c-1.55 0-2.878-.807-3.731-1.996-1.438.235-2.954-.128-4.05-1.224-1.095-1.095-1.459-2.611-1.217-4.05C1.816 14.877 1 13.551 1 12s.816-2.878 2.002-3.73c-.242-1.439.122-2.955 1.218-4.05 1.093-1.094 2.61-1.467 4.057-1.227C9.125 1.804 10.453 1 12 1c1.545 0 2.88.803 3.732 1.993 1.442-.24 2.956.135 4.048 1.227 1.093 1.092 1.468 2.608 1.227 4.05Zm-4.426-.084a1 1 0 0 1 .233 1.395l-5 7a1 1 0 0 1-1.521.126l-3-3a1 1 0 0 1 1.414-1.414l2.165 2.165 4.314-6.04a1 1 0 0 1 1.395-.232Z"
                                        class="fill-lime-600" />
                                </svg>
                                <p class="text-xs font-semibold text-lime-800 ">Verified</p>
                            </span>
                        @endif
                    </div>

                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <span class="flex flex-col">
                                <span class="text-sm font-medium text-gray-500">
                                    Starting at
                                </span>
                                <a href=""
                                    class="text-[26px] font-bold">${{ number_format($package->small_price) }}</a>
                            </span>
                            <a href=""
                                class="text-white h-fit rounded-md font-semibold border-2 border-lime-700 bg-lime-700 px-3 py-2 cursor-pointer hover:bg-white active:bg-white hover:text-lime-700 active:text-lime-400 text-center text-nowrap text-sm md:text-base w-40">
                                View Package
                            </a>
                        </div>
                        
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
