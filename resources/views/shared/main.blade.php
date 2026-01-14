<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('/images/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('/images/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('/images/site.webmanifest') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Top Firms - @yield('title', 'Home') </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
</head>

<body class="flex flex-col items-center">
    @include('shared.header')
        @yield('content')
    @include('shared.footer')
</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')
{{-- ! Page Js --}}

</html>
