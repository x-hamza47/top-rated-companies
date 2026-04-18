@extends('shared.main')

@section('title', 'Cookie Policy | Top Firms Reviewer')

@section('content')
<section class="bg-gray-50 min-h-screen py-10 px-4 md:px-10 mt-20">

    <div class="max-w-4xl mx-auto bg-white shadow-sm rounded-2xl p-6 md:p-10">

        {{-- Title --}}
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Cookie Policy
        </h1>

        {{-- Last Updated --}}
        <p class="text-sm text-gray-500 mb-6">
            Last updated: March 29, 2026
        </p>

        {{-- Intro --}}
        <p class="text-gray-600 leading-relaxed mb-6">
            We use cookies to improve your experience on our platform. This policy explains what cookies are and how we use them.
        </p>

        {{-- Section: What Are Cookies --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                What Are Cookies?
            </h2>
            <p class="text-gray-600 leading-relaxed">
                Cookies are small files stored on your device that help us remember your preferences and improve your browsing experience.
            </p>
        </div>

        {{-- Section: How We Use Cookies --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                How We Use Cookies
            </h2>
            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                <li>Analytics: To understand how users interact with our platform.</li>
                <li>Session management: To keep users logged in and maintain their preferences.</li>
            </ul>
        </div>

        {{-- Section: Managing Cookies --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                Managing Cookies
            </h2>
            <p class="text-gray-600 leading-relaxed">
                You can disable cookies in your browser settings. Please note that some features of the platform may not work properly if cookies are disabled.
            </p>
        </div>

    </div>

</section>
@endsection