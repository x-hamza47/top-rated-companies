@extends('shared.main')

@push('styles')
    @vite('resources/css/listicle.css')
@endpush
@section('title', 'Claim Profile | Top Firms Reviewer')
@section('content')
    <div class="section md:pt-32 pt-25 pb-20 flex flex-col justify-between text-white gap-y-5">
        @include('badgeAlert')
        <div class="w-3/5 mx-auto">
            <div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold ">
                    Claim <span class="text-lime-700">Profile</span>
                </h1>
                <p class="my-4 text-gray-200  text-sm sm:text-base  ">
                    To grant you access to your company's TopFirms profile, we need to verify your employment with the
                    company.
                    Please submit your details using your corporate email address. Once verified, we will notify you via
                    email
                    and grant you access to manage and edit your company profile.
                </p>
            </div>

            <form class="flex flex-col items-center" method="POST" action="{{ route('companies.claim.store', $company->id) }}">
                @csrf
                <div class="claim-container flex gap-x-10 md:gap-x-15 mt-5 w-full overflow-hidden">
                    <div class="logo-box bg-white/90 flex-1 flex flex-col items-center justify-center rounded-lg">
                        <img src="{{ $company->logo }}" alt="{{ $company->name }} Logo" class="company-logo">
                        <div>
                            <h4 class="text-gray-500 font-semibold text-2xl mt-3">{{ $company->name }}</h4>
                        </div>
                    </div>

                    <div class="form-box flex-1  text-white space-y-4">
                        <!-- firstName -->
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 md:text-base text-sm font-semibold">First Name</label>
                                <span class="relative h-11">
                                    <input type="text" name="first_name" placeholder="John"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-300 pl-10 pr-9 py-2 @error('first_name') invalid-input @enderror"
                                        value="{{ old('first_name', auth()->check() ? auth()->user()->firstName : '') }}">
                                    <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                </span>
                                @error('first_name')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- lastName -->
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 md:text-base text-sm font-semibold">Last Name</label>
                                <span class="relative h-11">
                                    <input type="text" name="last_name" placeholder="Doe"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-300 pl-10 pr-9 py-2 @error('last_name') invalid-input @enderror"
                                        value="{{ old('last_name', auth()->check() ? auth()->user()->lastName : '') }}">
                                    <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                </span>
                                @error('last_name')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 md:text-base text-sm font-semibold">Company Email</label>
                                <span class="relative h-11">
                                    <input type="email" name="company_email" placeholder="Company email"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-300 pl-10 pr-9 py-2 @error('company_email') invalid-input @enderror"
                                        value="{{ old('email') }}">
                                    <i
                                        class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2  text-gray-400"></i>
                                </span>
                                @error('company_email')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Title -->
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 md:text-base text-sm font-semibold">Title</label>
                                <span class="relative h-11">
                                    <input type="text" name="job_title" placeholder="Job Title"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('job_title') invalid-input @enderror"
                                        value="{{ old('job_title') }}">
                                    <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                </span>
                                @error('job_title')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="bg-(--primary) mt-4 text-lg md:px-10 py-2 rounded-md flex items-center gap-4 cursor-pointer hover:bg-lime-600">Claim your Profile <i class="fa-solid fa-chevron-right text-[10px]"></i></button>
            </form>
        </div>
    </div>

@endsection
