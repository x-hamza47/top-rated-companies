@extends('shared.main')
@push('styles')
    @vite('resources/css/auth.css')
@endpush
@section('title', 'Contact Us | Top Firms Reviewer')
@section('meta_description', 'Get in touch with Top Firms Reviewer. Send your inquiries or feedback using our contact form.')
@section('content')


<section class="contact-section w-full">
    @include('badgeAlert')
    <div class="contact-grid">

        {{-- Left Panel --}}
        <div class="contact-left">
            <div>
                <h2>Let's <span>Talk</span><br>With Us</h2>
                <p>Have a question or feedback? We'd love to hear from you. Our team typically responds within 24 hours.</p>

                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="info-text">
                        <span>Address</span>
                        <p>Business Center Sharjah Publishing City<br>Free Zone, Sharjah, UAE</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="info-text">
                        <span>Phone</span>
                        <a href="tel:+971567716432">+971 56 771 6432</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div class="info-text">
                        <span>Email</span>
                        <a href="mailto:info@topfirmsreviewer.com">info@topfirmsreviewer.com</a>
                    </div>
                </div>
            </div>

            <div class="social-row">
                <a href="https://www.facebook.com/people/Top-Firms-Reviewer/61590606452636/" class="social-btn" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="social-btn" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#" class="social-btn" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>

        {{-- Right Panel --}}
        <div class="contact-right">
            <h3>Send a Message</h3>
            <p>Fill out the form below and we'll get back to you as soon as possible.</p>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <div class="inp-wrap">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="fname" placeholder="John"
                                class="@error('fname') invalid-input @enderror"
                                value="{{ old('fname') }}">
                        </div>
                        @error('fname')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <div class="inp-wrap">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="lname" placeholder="Doe"
                                class="@error('lname') invalid-input @enderror"
                                value="{{ old('lname') }}">
                        </div>
                        @error('lname')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="inp-wrap">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="email" placeholder="example@example.com"
                                class="@error('email') invalid-input @enderror"
                                value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <div class="inp-wrap">
                            <i class="fa-solid fa-phone"></i>
                            <input type="tel" name="phone" placeholder="+92 300 1234567"
                                class="@error('phone') invalid-input @enderror"
                                value="{{ old('phone') }}">
                        </div>
                        @error('phone')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label>Subject</label>
                        <div class="inp-wrap">
                            <i class="fa-solid fa-tag"></i>
                            <input type="text" name="subject" placeholder="How can we help?"
                                class="@error('subject') invalid-input @enderror"
                                value="{{ old('subject') }}">
                        </div>
                        @error('subject')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label>Message</label>
                        <div class="inp-wrap textarea-wrap">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <textarea name="message" rows="4" placeholder="Write your message..."
                                class="@error('message') invalid-input @enderror">{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                            <span class="error">
                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                <p class="error-text">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-paper-plane"></i>
                    Send Message
                </button>
            </form>
        </div>

    </div>
</section>
@endsection