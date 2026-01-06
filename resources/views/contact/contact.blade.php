@extends('shared.main')
@push('styles')
    @vite('resources/css/auth.css')
@endpush

@section('content')
    <section
        class="section w-full flex  items-center justify-center gap-4 mt-20 bg-[linear-gradient(45deg,#0b0f2a,#034b41,#055724)] ">
        <div class="flex items-center w-full max-w-3xl sm:px-8 py-8 px-4 mx-auto lg:px-12 lg:w-3/5 bg-white rounded-md">
            <div class="w-full">
                <h1 class="text-3xl sm:text-4xl md:text-5xl text-gray-800 font-bold text-center">
                    Join <span class="text-lime-700">TopFirms</span>
                </h1>
                <p class="my-4 text-gray-600 text-sm sm:text-base text-center">
                    Create your account to connect with the right opportunities. Start as a company to showcase your
                    services or as an individual to find the perfect talent.
                </p>

                <form class="flex flex-col" action="{{ route('auth.register') }}" method="post">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-6 justify-center mt-8 peer">
                        <label
                            class="role-card cursor-pointer flex-1 h-max px-4 py-4 border-2 border-gray-300 rounded-xl text-center transition duration-300 relative  has-checked:border-lime-700 has-checked:[&>div>i]:text-lime-700 min-w-28">
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-building text-3xl text-gray-800 mb-3"></i>
                                <span class="font-semibold text-base">Start a Business</span>
                                <span class="text-gray-500 text-sm mt-2">Showcase your company and connect with
                                    clients.</span>
                            </div>
                            <input type="radio" name="role" value="company" class="mt-2"
                                @checked(old('role') == 'company')>
                        </label>

                        <label
                            class="role-card cursor-pointer flex-1 h-max px-4 py-4 border-2 border-gray-300 rounded-xl text-center  transition duration-300 relative has-checked:border-lime-700 has-checked:[&>div>i]:text-lime-700">
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-user text-3xl text-gray-800 mb-3"></i>
                                <span class="font-semibold text-lg">Hire for Projects</span>
                                <span class="text-gray-500 text-sm mt-2">Find the right talent or get hired by top
                                    companies.
                                </span>
                            </div>
                            <input type="radio" name="role" value="user" class="mt-2" @checked(old('role') == 'user')>
                        </label>

                        @error('role')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4 my-5 max-h-0 peer-has-checked:max-h-[600px] overflow-hidden transition-all duration-500 ease-in-out">
                        <div>
                            <div class="inp-field w-full ">
                                <label class="block mb-2 text-sm text-gray-600 ">First Name</label>
                                <span class="relative h-11">
                                    <input type="text" placeholder="John" name="firstName"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('firstName') invalid-input @enderror"
                                        value="{{ old('firstName') }}">
                                    <i class="fa-solid fa-user absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('firstName')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="inp-field w-full ">
                                <label class="block mb-2 text-sm text-gray-600 ">Last Name</label>
                                <span class="relative">
                                    <input type="text" placeholder="Snow" name="lastName"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('lastName') invalid-input @enderror"
                                        value="{{ old('lastName') }}">
                                    <i class="fa-solid fa-user absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('lastName')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="inp-field w-full ">
                                <label class="block mb-2 text-sm text-gray-600 ">Email</label>
                                <span class="relative ">
                                    <input type="text" name="email" placeholder="john@example.com"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('email') invalid-input @enderror"
                                        value="{{ old('email') }}">
                                    <i class="fa-solid fa-envelope absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('email')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="inp-field w-full ">
                                <label class="block mb-2 text-sm text-gray-600 ">Phone</label>
                                <span class="relative">
                                    <input type="tel" name="phone" placeholder="+92 300 1234567"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('phone') invalid-input @enderror"
                                        value="{{ old('phone') }}">
                                    <i class="fa-solid fa-phone absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('phone')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600 ">Password</label>
                                <span class="relative">
                                    <input type="password" placeholder="Password" name="password"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('password') invalid-input @enderror">
                                    <i class="fa-solid fa-eye text-lg text-gray-400 cursor-pointer show-icon"></i>
                                    <i class="fa-solid fa-lock absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('password')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600 ">Confirm Password</label>
                                <span class="relative">
                                    <input type="password" placeholder="Confirm Password" name="password_confirmation"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2">
                                    <i class="fa-solid fa-eye text-lg text-gray-400 cursor-pointer show-icon"></i>
                                    <i class="fa-solid fa-lock absolute left-3 top-3 text-gray-400"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-(--secondary) cursor-pointer text-white w-full text-center rounded-md py-2 hover:bg-(--light-primary) font-semibold peer-has-not-checked:hidden peer-has-checked:block">Sign
                        Up</button>
                    <div class="register-link text-center mt-2">
                        <p class="font-semibold">Already have an account?<a href="{{ route('login') }}"
                                class="text-(--secondary) hover:text-(--primary) font-medium">
                                Log In</a></p>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script src="{{ asset('assets/js/password.js') }}"></script>
@endpush
