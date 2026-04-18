@extends('shared.main')

@section('title', 'Terms & Conditions | Top Firms Reviewer')

@section('content')
<section class="bg-gray-50 min-h-screen py-10 px-4 md:px-10 mt-20">

    <div class="max-w-4xl mx-auto bg-white shadow-sm rounded-2xl p-6 md:p-10">

        {{-- Title --}}
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Terms & Conditions
        </h1>

        {{-- Last Updated --}}
        <p class="text-sm text-gray-500 mb-6">
            Last updated: March 29, 2026
        </p>

        {{-- Intro --}}
        <p class="text-gray-600 leading-relaxed mb-6">
            By using our platform, you agree to the following terms and conditions. Please read them carefully.
        </p>

        {{-- Section: Use of Platform --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                Use of Platform
            </h2>
            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                <li>Users must provide accurate and truthful information.</li>
                <li>No misuse or illegal activity is allowed on the platform.</li>
            </ul>
        </div>

        {{-- Section: Company Listings --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                Company Listings
            </h2>
            <p class="text-gray-600 leading-relaxed">
                We do not guarantee the accuracy or completeness of listed companies. All information is provided as-is.
            </p>
        </div>

        {{-- Section: Limitation of Liability --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                Limitation of Liability
            </h2>
            <p class="text-gray-600 leading-relaxed">
                We are not responsible for any damages or losses arising from the use of the platform or reliance on company listings and reviews.
            </p>
        </div>

        {{-- Section: Changes --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                Changes to Terms
            </h2>
            <p class="text-gray-600 leading-relaxed">
                We may update these terms at any time. Users are encouraged to review them periodically. Continued use of the platform constitutes acceptance of the updated terms.
            </p>
        </div>

    </div>

</section>
@endsection