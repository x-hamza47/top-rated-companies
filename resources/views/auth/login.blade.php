@extends('shared.main')
@push('styles')
    @vite('resources/css/auth.css')
@endpush

@section('content')
    <div
        class="section w-full flex  items-center justify-center gap-4 mt-20 bg-[linear-gradient(45deg,#0b0f2a,#034b41,#055724)] ">

        <div class="flex flex-col bg-white px-8 py-7 rounded-md">
            <h1 class="text-2xl sm:text-3xl md:text-4xl  lg:text-5xl  text-gray-800 font-bold text-center">
                TRC <span class="text-lime-700">Login</span>
            </h1>
            <p class="my-4 text-gray-600 text-sm sm:text-base text-center">
                Login to manage your account, track activities, and get things done easily.
            </p>
            <form action="{{ route('auth.login') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="flex flex-col gap-6 mb-3">

                    <div class="inp-field w-full h-11 relative @error('email') mb-2 @enderror">
                        <input type="text" placeholder="Email Address" name="email"
                            class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-4 pr-9 py-2 @error('email') invalid-input @enderror"
                            value="{{ old('email') }}">
                        <i class="fa-solid fa-envelope absolute right-3 top-1/2 text-gray-400"></i>
                        @error('email')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="relative inp-field w-full h-11 @error('email') mb-2 @enderror">
                        <input type="password" placeholder="Password" name="password"
                            class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-4 pr-9 py-2 @error('password') invalid-input @enderror">
                        <i class="fa-solid fa-eye text-lg text-gray-400 cursor-pointer show-icon"></i>
                        @error('password')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="remember-forgot flex justify-between">
                    <label><input type="checkbox" name="" id="" class="accent-(--secondary)"> Remember
                        me</label>
                    <a href="#" class="hover:underline font-normal text-blue-500">Forgot password?</a>
                </div>

                <button type="submit"
                    class="bg-(--secondary) cursor-pointer text-white w-full text-center rounded-md py-2 hover:bg-(--light-primary) font-semibold ">Login</button>

                <div class="register-link text-center">
                    <p>Don't have an account?<a href="{{ route('register.show') }}"
                            class="text-(--secondary) hover:text-(--primary) font-medium">
                            Create One</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/password.js') }}"></script>
@endpush
