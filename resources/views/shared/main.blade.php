<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>TRC - Top Rated Companies</title>
</head>

<body class="flex flex-col items-center">
    @include('shared.header')
    @yield('content')
    @include('shared.footer')
    <div class="background w-screen fixed -z-1 top-0 left-0 h-screen"></div>
    {{-- <div class="mouse p-3 rounded-full bg-lime-500 fixed z-100"></div>
    <div class="mouse-trail p-1 rounded-full bg-lime-950 fixed z-100"></div> --}}
</body>

@stack('scripts')

</html>
