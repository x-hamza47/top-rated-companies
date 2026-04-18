@extends('shared.main')
@push('styles')
    @vite('resources/css/auth.css')
@endpush
@section('title', 'Contact Us | Top Firms Reviewer')
@section('meta_description', 'Get in touch with Top Firms Reviewer. Send your inquiries or feedback using our contact form.')
@section('content')
    <section
        class="section w-full flex items-center justify-center gap-4 mt-20 bg-[linear-gradient(45deg,#0b0f2a,#034b41,#055724)] ">
            @include('badgeAlert')
        <div class="flex items-center w-full max-w-3xl sm:px-8 py-8 px-4 mx-auto lg:px-12 lg:w-3/5 bg-white rounded-md">
            <div class="w-full">
                <h1 class="text-3xl sm:text-4xl md:text-5xl text-gray-800 font-bold text-center">
                    Contact <span class="text-lime-700">TopFirms</span>
                </h1>
                <p class="my-4 text-gray-600 text-sm sm:text-base text-center">
                    Have a question or feedback? Send us a message and our team will get back to you as soon as possible.
                </p>

                <form class="flex flex-col" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-4 my-5  transition-all duration-500 ease-in-out">

                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">First Name</label>
                                <span class="relative h-11">
                                    <input type="text" name="fname" placeholder="John"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('fname') invalid-input @enderror"
                                        value="{{ old('fname') }}">
                                    <i class="fa-solid fa-user absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('fname')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Last Name</label>
                                <span class="relative h-11">
                                    <input type="text" name="lname" placeholder="Doe"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('lname') invalid-input @enderror"
                                        value="{{ old('lname') }}">
                                    <i class="fa-solid fa-user absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('lname')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Email</label>
                                <span class="relative h-11">
                                    <input type="email" name="email" placeholder="example@example.com"
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

                        <div class="sm:col-span-2">
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Subject</label>
                                <span class="relative h-11">
                                    <input type="text" name="subject" placeholder="Subject"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('subject') invalid-input @enderror"
                                        value="{{ old('subject') }}">
                                    <i class="fa-solid fa-tag absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('subject')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Message</label>
                                <textarea name="message" rows="5" placeholder="Write your message..."
                                    class="rounded-md w-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 p-3 @error('message') invalid-input @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <button type="submit"
                        class="bg-(--secondary) cursor-pointer text-white w-full text-center rounded-md py-2 hover:bg-(--light-primary) font-semibold peer-has-not-checked:hidden peer-has-checked:block">
                        Send Message
                    </button>

                </form>
            </div>
        </div>
    </section>
@endsection
