@extends('auth.admin.layout.main')

@push('styles')
    @vite('resources/css/auth.css')
@endpush

@section('content')
<div class="w-full flex items-center justify-center px-2 gap-4 min-h-dvh bg-[linear-gradient(45deg,#0b0f2a,#034b41,#055724)]">
    <div class="flex flex-col bg-white sm:px-8 sm:py-7 px-4 py-5 rounded-md shadow-md w-full max-w-md">

        <h1 class="text-3xl md:text-4xl text-gray-800 font-bold text-center mb-4">
            Reset <span class="text-lime-700">Password</span>
        </h1>

        <p class="my-2 text-gray-600 text-sm sm:text-base text-center">
            Enter your new password to reset your account access.
        </p>

        @if(session('status'))
            <p class="text-green-600 text-sm text-center my-2">{{ session('status') }}</p>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="inp-field w-full h-11 relative">
                <input type="password" name="password" placeholder="New Password"
                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-4 py-2"
                    required>
                @error('password')
                    <span class="error">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="error-text">{{ $message }}</p>
                    </span>
                @enderror
            </div>

            <div class="inp-field w-full h-11 relative">
                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-4 py-2"
                    required>
            </div>

            <button type="submit"
                class="bg-(--secondary) text-white w-full rounded-md py-2 font-semibold hover:bg-(--light-primary)">
                Reset Password
            </button>
        </form>

        <a href="{{ route('login') }}" class="text-center text-sm text-gray-600 hover:underline mt-4">
            Back to Login
        </a>
    </div>
</div>
@endsection
