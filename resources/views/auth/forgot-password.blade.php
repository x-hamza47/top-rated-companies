@extends('auth.admin.layout.main')

@push('styles')
    @vite('resources/css/auth.css')
@endpush

@section('content')
    <div
        class="w-full flex items-center justify-center px-2 gap-4 min-h-dvh bg-[linear-gradient(45deg,#0b0f2a,#034b41,#055724)]">
        <div class="flex flex-col bg-white sm:px-8 sm:py-7 px-4 py-5 rounded-md ">

            <h1 class="text-3xl md:text-4xl text-gray-800 font-bold text-center">
                Forgot <span class="text-lime-700">Password</span>
            </h1>

            <p class="my-4 text-gray-600 text-sm sm:text-base text-center">
                Enter your email and we’ll send you a password reset link.
            </p>

            <form action="{{ route('password.email') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="inp-field w-full h-11 relative">
                    <input type="email" name="email" placeholder="Email Address"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-4 pr-9 py-2"
                        value="{{ old('email') }}" required>
                    <i class="fa-solid fa-envelope absolute right-3 top-1/2 text-gray-400"></i>

                    @error('email')
                        <span class="error">
                            <i class="fa-solid fa-circle-exclamation error-icon"></i>
                            <p class="error-text">{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                @if (session('status'))
                    <p class="text-green-600 text-sm text-center">{{ session('status') }}</p>
                @endif
                @if (session('error'))
                    <p class="text-red-500 text-center mt-2">{{ session('error') }}</p>
                @endif

                <button type="submit" id="sendBtn"
                    class="bg-(--secondary) text-white rounded-md py-2 font-semibold hover:bg-(--light-primary)">
                    Send Reset Link
                </button>
            </form>

            <p class="text-sm text-gray-600 text-center mt-4">
                Didn’t receive email?
                <button id="resendBtn" disabled class="text-blue-500 font-medium cursor-not-allowed">
                    Resend in <span id="timer">{{ session('remaining', 0) }}</span>s
                </button>
            </p>

            <a href="{{ route('login') }}" class="text-center text-sm text-gray-600 hover:underline mt-4">
                Back to Login
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const resendBtn = document.getElementById('resendBtn');
            const timerEl = document.getElementById('timer');

            let timer = parseInt(timerEl.textContent);

            function startCountdown() {
                resendBtn.disabled = true;
                resendBtn.classList.add('cursor-not-allowed');

                const countdown = setInterval(() => {
                    timer--;
                    timerEl.textContent = timer;

                    if (timer <= 0) {
                        clearInterval(countdown);
                        resendBtn.disabled = false;
                        resendBtn.classList.remove('cursor-not-allowed');
                        resendBtn.textContent = 'Resend Email';
                    }
                }, 1000);
            }

            // Start timer if there is remaining time
            if (timer > 0) startCountdown();

            // Resend button submits the same form
            resendBtn.addEventListener('click', () => {
                document.getElementById('sendBtn').click();
            });
        });
    </script>
@endpush
