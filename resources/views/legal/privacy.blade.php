@extends('shared.main')

@section('title', 'Privacy Policy | Top Firms Reviewer') 

@section('content')
<section class="bg-gray-50 min-h-screen py-10 px-4 md:px-10 mt-20">
    
    <div class="max-w-4xl mx-auto bg-white shadow-sm rounded-2xl p-6 md:p-10">
        
        {{-- Title --}}
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Privacy Policy
        </h1>

        <p class="text-sm text-gray-500 mb-6">
            Last updated: March 29, 2026
        </p>

        {{-- Intro --}}
        <p class="text-gray-600 leading-relaxed mb-6">
            We value your privacy. This policy explains how we collect, use, and protect your information when you use our platform.
        </p>

        {{-- Section --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                Information We Collect
            </h2>
            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                <li>Name, email, and phone number</li>
                <li>Company details and profile information</li>
                <li>Usage data such as pages visited and interactions</li>
            </ul>
        </div>

        {{-- Section --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                How We Use Your Information
            </h2>
            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                <li>To provide and maintain our services</li>
                <li>To improve user experience and platform performance</li>
                <li>To communicate updates, support, and notifications</li>
            </ul>
        </div>

        {{-- Section --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                Data Protection
            </h2>
            <p class="text-gray-600 leading-relaxed">
                We implement appropriate technical and organizational measures to protect your personal data from unauthorized access, loss, or misuse.
            </p>
        </div>

        {{-- Section --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">
                Contact Us
            </h2>
            <p class="text-gray-600">
                If you have any questions about this Privacy Policy, you can contact us at:
            </p>
            <p class="mt-2 text-lime-600 font-medium">
                info@topfirmsreviewer.com
            </p>
        </div>

    </div>

</section>
@endsection