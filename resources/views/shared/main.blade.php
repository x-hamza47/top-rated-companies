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
    {{-- <style>
        body.loading {
            overflow: hidden;
        }

        /* From Uiverse.io by Nawsome */
        #loader {

            position: fixed;
            /* not absolute */
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: #0f172a;
            /* change to your theme */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .boxes {
            --size: 32px;
            --duration: 800ms;
            height: calc(var(--size) * 2);
            width: calc(var(--size) * 3);
            position: relative;
            transform-style: preserve-3d;
            transform-origin: 50% 50%;
            margin-top: calc(var(--size) * 1.5 * -1);
            transform: rotateX(60deg) rotateZ(45deg) rotateY(0deg) translateZ(0px);
        }

        .boxes .box {
            width: var(--size);
            height: var(--size);
            top: 0;
            left: 0;
            position: absolute;
            transform-style: preserve-3d;
        }

        .boxes .box:nth-child(1) {
            transform: translate(100%, 0);
            -webkit-animation: box1 var(--duration) linear infinite;
            animation: box1 var(--duration) linear infinite;
        }

        .boxes .box:nth-child(2) {
            transform: translate(0, 100%);
            -webkit-animation: box2 var(--duration) linear infinite;
            animation: box2 var(--duration) linear infinite;
        }

        .boxes .box:nth-child(3) {
            transform: translate(100%, 100%);
            -webkit-animation: box3 var(--duration) linear infinite;
            animation: box3 var(--duration) linear infinite;
        }

        .boxes .box:nth-child(4) {
            transform: translate(200%, 0);
            -webkit-animation: box4 var(--duration) linear infinite;
            animation: box4 var(--duration) linear infinite;
        }

        .boxes .box>div {
            --background: #114113;
            --top: auto;
            --right: auto;
            --bottom: auto;
            --left: auto;
            --translateZ: calc(var(--size) / 2);
            --rotateY: 0deg;
            --rotateX: 0deg;
            position: absolute;
            width: 100%;
            height: 100%;
            background: var(--background);
            top: var(--top);
            right: var(--right);
            bottom: var(--bottom);
            left: var(--left);
            transform: rotateY(var(--rotateY)) rotateX(var(--rotateX)) translateZ(var(--translateZ));
        }

        .boxes .box>div:nth-child(1) {
            --top: 0;
            --left: 0;
        }

        .boxes .box>div:nth-child(2) {
            --background: #27f214;
            --right: 0;
            --rotateY: 90deg;
        }

        .boxes .box>div:nth-child(3) {
            --background: #59f544;
            --rotateX: -90deg;
        }

        .boxes .box>div:nth-child(4) {
            --background: #DBE3F4;
            --top: 0;
            --left: 0;
            --translateZ: calc(var(--size) * 3 * -1);
        }

        @-webkit-keyframes box1 {

            0%,
            50% {
                transform: translate(100%, 0);
            }

            100% {
                transform: translate(200%, 0);
            }
        }

        @keyframes box1 {

            0%,
            50% {
                transform: translate(100%, 0);
            }

            100% {
                transform: translate(200%, 0);
            }
        }

        @-webkit-keyframes box2 {
            0% {
                transform: translate(0, 100%);
            }

            50% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(100%, 0);
            }
        }

        @keyframes box2 {
            0% {
                transform: translate(0, 100%);
            }

            50% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(100%, 0);
            }
        }

        @-webkit-keyframes box3 {

            0%,
            50% {
                transform: translate(100%, 100%);
            }

            100% {
                transform: translate(0, 100%);
            }
        }

        @keyframes box3 {

            0%,
            50% {
                transform: translate(100%, 100%);
            }

            100% {
                transform: translate(0, 100%);
            }
        }

        @-webkit-keyframes box4 {
            0% {
                transform: translate(200%, 0);
            }

            50% {
                transform: translate(200%, 100%);
            }

            100% {
                transform: translate(100%, 100%);
            }
        }

        @keyframes box4 {
            0% {
                transform: translate(200%, 0);
            }

            50% {
                transform: translate(200%, 100%);
            }

            100% {
                transform: translate(100%, 100%);
            }
        }
    </style> --}}
</head>

<body class="flex flex-col items-center">

    @include('shared.header')
    @yield('content')
    @include('shared.footer')
    {{-- <div id="loader">

        <!-- From Uiverse.io by Nawsome -->
        <div class="boxes">
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div> --}}
</body>


{{-- <script>
document.body.classList.add("loading");

window.addEventListener("load", function() {
    document.getElementById("loader").style.display = "none";
    document.body.classList.remove("loading");
});
</script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')
{{-- ! Page Js --}}

</html>
