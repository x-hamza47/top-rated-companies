<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('/images/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('/images/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('/images/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('/images/favicon/site.webmanifest') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('dashboard-assets/css/style.css') }}" /> --}}
    <meta name="theme-color" content="#497d00">
    <title>Top Rated Companies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/dashboard-css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
