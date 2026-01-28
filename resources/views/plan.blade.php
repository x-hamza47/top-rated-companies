@extends('shared.main')

@push('styles')
    @vite('resources/css/listicle.css')
@endpush
@section('title', 'Packages')
@section('content')
    <div class="section md:pt-32 pt-25 pb-20 flex flex-col justify-between text-white gap-y-5 relative">
        {{-- <pre> {{ print_r($company->toArray(), true) }}</pre> --}}
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

    <section class="flex items-center justify-center flex-col py-12 px-4 md:px-6 bg-white w-full">
        <h1 class="font-medium text-4xl md:text-5xl text-slate-800 text-center tracking-tight">
            Service Packages
        </h1>
        <p class="text-lg text-zinc-600 text-center mt-4 max-w-3xl">
            Explore the service packages offered by this company and choose the plan that best fits your business needs.
        </p>

        <div class="w-full max-w-2xl mt-8">
            <label for="serviceSelect" class="block text-sm font-medium text-slate-700 mb-2">
                Packages we offer:
            </label>
            <select id="serviceSelect" data-company-id="{{ $company->id }}"
                class="w-full border border-zinc-300 rounded-xl px-5 py-3.5 bg-white shadow-sm focus:border-lime-600 focus:ring-lime-500 transition">
                @php
                    $selectedServiceId = $service->packageTiers->first()?->service_id;
                @endphp

                @foreach ($allServices as $s)
                    <option value="{{ $s->id }}" {{ $s->id == $selectedServiceId ? 'selected' : '' }}>

                        {{ $s->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="loading" class="hidden mt-12 text-center text-zinc-500">
            <svg class="animate-spin h-8 w-8 mx-auto text-lime-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <p class="mt-3">Loading packages...</p>
        </div>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-7xl" id="packageContainer">
            @foreach ($service->packageTiers as $package)
                @include('shared.partials.package-card', ['package' => $package])
            @endforeach
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const select = document.getElementById('serviceSelect');
            const container = document.getElementById('packageContainer');
            const loading = document.getElementById('loading');
            const companyId = select.dataset.companyId;

            let debounceTimeout;

            const fetchPackages = async () => {
                const serviceId = select.value;
                if (!serviceId) return;

                loading.classList.remove('hidden');
                container.classList.add('opacity-50');

                try {
                    const response = await fetch(`/company/${companyId}/service/${serviceId}/packages`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error('Network response was not ok');

                    const data = await response.json();

                    container.innerHTML = '';

                    if (data.packages.length === 0) {
                        container.innerHTML = `
                <div class="col-span-full text-center py-12 text-zinc-500">
                    No packages available for this service yet.
                </div>`;
                        return;
                    }

                    data.packages.forEach(pkg => {
                        let featuresHtml = pkg.features.map(f => `
                <p class="flex items-start gap-3 text-sm text-zinc-600">
                    <span class="size-5 mt-0.5 flex items-center justify-center shrink-0">
                        ${f.type === 'checkbox' 
                            ? (f.included 
                                ? '<i class="fa-solid fa-check text-lime-600 text-lg"></i>' 
                                : '<i class="fa-solid fa-xmark text-red-500 text-lg"></i>')
                            : '<span class="size-2.5 rounded-full bg-lime-600 inline-block"></span>'}
                    </span>
                    <span class="${!f.included ? 'line-through text-zinc-400' : ''}">
                        ${f.feature}
                        ${f.type === 'text' && f.value ? `<span class="block text-xs text-zinc-400 mt-0.5">${f.value}</span>` : ''}
                    </span>
                </p>`).join('');

                        container.innerHTML += `
                <div class="border border-zinc-200 rounded-2xl p-7 flex flex-col bg-white shadow-sm hover:shadow-md hover:border-lime-600 transition-all duration-300">
                    <h3 class="font-semibold text-2xl md:text-3xl text-slate-900 capitalize">${pkg.type}</h3>
                    <p class="text-sm text-zinc-500 mt-1">${pkg.service.name}</p>
                    
                    <div class="mt-6 flex items-baseline">
                        <span class="text-5xl font-bold text-slate-900">$${Number(pkg.price).toLocaleString()}</span>
                        <span class="ml-2 text-lg text-zinc-500">/${pkg.price_type}</span>
                    </div>

                    <button class="mt-8 w-full py-3.5 px-6 border border-lime-600 text-lime-700 font-medium rounded-xl hover:bg-lime-600 hover:text-white transition duration-200">
                        Get Started
                    </button>

                    <div class="mt-8 space-y-3">
                        ${featuresHtml}
                    </div>
                </div>`;
                    });
                } catch (err) {
                    console.error('Error fetching packages:', err);
                    container.innerHTML = `
            <div class="col-span-full text-center py-12 text-red-600">
                Failed to load packages. Please try again.
            </div>`;
                } finally {
                    loading.classList.add('hidden');
                    container.classList.remove('opacity-50');
                }
            };


            select.addEventListener('change', () => {
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    fetchPackages();
                }, 2000);
            });
        });
    </script>
@endpush
