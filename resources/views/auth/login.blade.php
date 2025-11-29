@extends('shared.main')
@section('content')
    <div
        class="section w-full max-w-[1920px] flex flex-col items-center justify-center gap-4 p-[50px] mt-20 max-[720px]:p-5">
        <h1 class="text-3xl font-bold text-white">TRC <span class="text-lime-400"> Login</span></h1>
        <div class="bg-lime-400/10 p-10 rounded-md outline-1 outline-lime-400/30 max-w-[500px] w-full flex flex-col">
            <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div>
                    <input type="text" placeholder="Username" name="username"
                        class="bg-lime-400/10 text-lime-400 placeholder:text-lime-400/30 outline-1 outline-lime-400 p-2 rounded-md w-full">
                </div>
                <div class="relative">
                    <input type="password" placeholder="Password" name="password"
                        class="password bg-lime-400/10 text-lime-400 placeholder:text-lime-400/30 outline-1 outline-lime-400 p-2 rounded-md w-full">
                    <div class="show-hide absolute right-2 top-1/2 -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path class="fill-lime-400"
                                d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full bg-lime-400 rounded-md p-2 font-bold text-lime-900">Login</button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/password.js') }}"></script>
    @endpush
@endsection
