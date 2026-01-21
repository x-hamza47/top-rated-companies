@extends('shared.main')

@push('styles')
    @vite('resources/css/listicle.css')
@endpush
@section('title', 'Packages')
@section('content')
    <div class="section md:pt-32 pt-25 pb-20 flex flex-col justify-between text-white gap-y-5 relative">
        <pre> {{ print_r($company->toArray(), true)  }}</pre>
        <div class="flex items-center gap-x-5 gap-y-6 flex-col md:flex-row">
            <div class="w-40 h-40">
                <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="w-full h-full object-cover rounded-md">
            </div>
            <div class="flex flex-col gap-3 items-center md:items-start text-center">
                <div class="flex flex-wrap-reverse gap-2 items-center justify-center md:justify-start">
                    <h1 class="text-3xl sm:text-3xl md:text-4xl  font-bold">{{ $company->name }}</h1>
                    @if ($company->verified)
                        <span class="flex gap-2 items-center flex-wrap bg-white md:px-3 md:py-1.5 px-2 py-1 rounded-full">
                            <svg class="md:w-5 md:h-5 w-4.5 h-4.5" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M21.007 8.27C22.194 9.125 23 10.45 23 12c0 1.55-.806 2.876-1.993 3.73.24 1.442-.134 2.958-1.227 4.05-1.095 1.095-2.61 1.459-4.046 1.225C14.883 22.196 13.546 23 12 23c-1.55 0-2.878-.807-3.731-1.996-1.438.235-2.954-.128-4.05-1.224-1.095-1.095-1.459-2.611-1.217-4.05C1.816 14.877 1 13.551 1 12s.816-2.878 2.002-3.73c-.242-1.439.122-2.955 1.218-4.05 1.093-1.094 2.61-1.467 4.057-1.227C9.125 1.804 10.453 1 12 1c1.545 0 2.88.803 3.732 1.993 1.442-.24 2.956.135 4.048 1.227 1.093 1.092 1.468 2.608 1.227 4.05Zm-4.426-.084a1 1 0 0 1 .233 1.395l-5 7a1 1 0 0 1-1.521.126l-3-3a1 1 0 0 1 1.414-1.414l2.165 2.165 4.314-6.04a1 1 0 0 1 1.395-.232Z"
                                    class="fill-lime-600" />
                            </svg>
                            <h5 class="text-xs sm:text-sm font-bold text-lime-800 ">Premier Verified</h5>
                        </span>
                    @endif
                </div>
                <div class="flex gap-x-5 gap-y-3 items-center flex-wrap justify-center md:justify-start"">
                    <div class="flex items-center gap-1 flex-wrap justify-center md:justify-start">
                        {{-- !stars --}}
                        <x-star-rating :rating="$company->reviews_avg_rating" :reviews="$company->reviews_count" color="yellow" textColor="text-white" />
                        <span class="flex items-center gap-1">|
                            <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602" />
                            </svg>
                            {{-- ! Location --}}
                            <address class="text-sm">{{ $company->details->locations }}</address>
                        </span>
                    </div>

                </div>
                <div class="flex gap-2 w-full text-base font-semibold flex-wrap justify-center md:justify-start">
                    <a target="_blank" href="website " class="btn-white flex-1  text-nowrap ">
                        View Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class='flex items-center justify-center flex-col py-10 px-4 bg-white w-full'>
        <h1 class='font-medium text-4xl md:text-[52px] text-slate-800 text-center'>Flexible Pricing Plans</h1>
        <p class='text-base/7 text-zinc-500  text-center mt-4'>Choose a plan that supports your business growth
            and
            digital goals.</p>
        <div class="w-4/5 mt-6">
            <select id="serviceSelect" class="w-full border border-gray-400 rounded-lg px-4 py-3 text-gray-700">

                <option value="">Select a service</option>

                @foreach ($company->services as $service)
                    @if ($service->package)
                        <option value="{{ $service->package->id }}">
                            {{ $service->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class='mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-4/5'>

            <div
                class='border border-zinc-200 rounded-2xl p-6 flex flex-col items-start max-w-md transition duration-300 hover:-translate-y-1 hover:border-lime-700'>
                <h1 class='font-medium text-3xl text-slate-800 mt-1'>Basic</h1>
                <p class='text-sm text-zinc-500 mt-2'>For startups and small teams.</p>
                <h1 class='font-medium text-5xl text-slate-800 mt-6'>$<span id="basicPrice">100</span></h1>
                <button
                    class='w-full border border-zinc-300/80 px-4 py-3 rounded-full cursor-pointer text-slate-600 text-sm mt-8 bg-lime-100 hover:bg-lime-700/70 hover:text-white'>Get
                    Started
                </button>
                <div class='w-full mt-8 space-y-2.5 pb-4'>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Essential site setup support
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Access to basic UI templates
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Email support for minor updates
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Access to basic components
                    </p>
                </div>
            </div>

            <div
                class='bg-lime-100 border border-zinc-200 rounded-2xl p-6 flex flex-col items-start max-w-md transition duration-300 hover:-translate-y-1'>
                <h1 class='font-medium text-3xl text-slate-800 mt-1'>Pro</h1>
                <p class='text-sm text-zinc-500 mt-2'>Perfect for growing businesses.</p>
                <h1 class='font-medium text-5xl text-slate-800 mt-6'>$<span id="proPrice">300</span></h1>
                <button
                    class='bg-gray-800 hover:bg-gray-900 text-white w-full px-4 py-3 rounded-full cursor-pointer text-sm mt-8'>Get
                    Started
                </button>
                <div class='w-full mt-8 space-y-2.5 pb-4'>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Custom web page design up to 5 pages
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Access to basic UI templates
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Email support for minor updates
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Access to basic components
                    </p>
                </div>
            </div>

            <div
                class='border border-zinc-200 rounded-2xl p-6 flex flex-col items-start max-w-md transition duration-300 hover:-translate-y-1'>
                <h1 class='font-medium text-3xl text-slate-800 mt-1'>Enterprise</h1>
                <p class='text-sm text-zinc-500 mt-2'>For scaling brands and teams.</p>
                <h1 class='font-medium text-5xl text-slate-800 mt-6'>$<span id="enterprisePrice">500</span></h1>
                <button
                    class='w-full border border-zinc-300/80 px-4 py-3 rounded-full cursor-pointer text-slate-600 text-sm mt-8 bg-lime-100 hover:bg-lime-700/70 hover:text-white'>Get
                    Started
                </button>
                <div class='w-full mt-8 space-y-2.5 pb-4'>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Full website redesign & development
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Advanced analytics insights
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Ongoing dedicated support
                    </p>
                    <p class='flex items-center gap-3 text-sm text-zinc-500'>
                        <span class='size-3 rounded-full bg-zinc-300 flex items-center justify-center shrink-0'>
                            <span class='size-1.5 rounded-full bg-zinc-800'></span>
                        </span>
                        Access to basic UI templates
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection


{{-- @push('scripts')
    <script>
        let isAnnual = true;

        const pricing = {
            basic: {
                monthly: 10,
                annual: 100
            },
            pro: {
                monthly: 30,
                annual: 300
            },
            enterprise: {
                monthly: 50,
                annual: 500
            }
        };

        function togglePricing(annual) {
            isAnnual = annual;

            // Update prices
            document.getElementById('basicPrice').textContent = isAnnual ? pricing.basic.annual : pricing.basic.monthly;
            document.getElementById('proPrice').textContent = isAnnual ? pricing.pro.annual : pricing.pro.monthly;
            document.getElementById('enterprisePrice').textContent = isAnnual ? pricing.enterprise.annual : pricing
                .enterprise.monthly;

            // Update button styles
            const monthlyBtn = document.getElementById('monthlyBtn');
            const annuallyBtn = document.getElementById('annuallyBtn');

            if (isAnnual) {
                monthlyBtn.className = 'px-4 py-2 rounded-full text-xs cursor-pointer transition text-gray-600';
                annuallyBtn.className =
                    'px-4 py-2 rounded-full text-xs cursor-pointer transition bg-lime-800 hover:bg-lime-900 text-white';
            } else {
                monthlyBtn.className =
                    'px-4 py-2 rounded-full text-xs cursor-pointer transition bg-lime-800 hover:bg-lime-900 text-white';
                annuallyBtn.className = 'px-4 py-2 rounded-full text-xs cursor-pointer transition text-gray-600';
            }
        }
    </script>
@endpush --}}
