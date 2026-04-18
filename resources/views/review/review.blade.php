<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta name="robots" content="noindex, nofollow">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('/images/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('/images/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('/images/site.webmanifest') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Submit Your Review for {{ $company->name }} - Top Firms Reviewer</title>
    <meta name="description"
        content="Share your experience with {{ $company->name }}. Write a detailed, verified review about their {{ $company->category ?? 'services' }} and help other businesses choose the best agency. Quick & easy submission on Top Firms Reviewer.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section
        class="section w-full flex  items-center justify-center gap-4 bg-[linear-gradient(45deg,#0b0f2a,#034b41,#055724)] ">
        @include('badgeAlert')
        <div class="flex items-center w-full max-w-4xl mx-auto lg:px-12 lg:w-3/5 ">
            <form class="flex flex-col gap-5" action="{{ route('reviews.store') }}" method="post">
                @csrf
                <input type="hidden" name="company_slug" value="{{ $company->slug }}">
                <div>
                    <h1 class="text-xl text-white sm:text-2xl md:text-3xl  font-bold text-center">
                        Write a Review for <span class="text-lime-700">{{ $company->name }}</span>
                    </h1>
                    <p class="my-4 text-white text-sm sm:text-base text-center">
                        Share your experience with this company. Your review will help others understand the quality
                        of
                        their work.
                    </p>


                </div>
                <div class="w-full bg-white sm:px-8 py-8 px-4 rounded-md step-1">
                    <h1 class="text-xl sm:text-2xl md:text-3xl text-gray-800 font-bold text-center">
                        Your Information
                    </h1>
                    <p class="my-4 text-gray-600 text-sm sm:text-base text-center">
                        Tell us a bit about yourself. This will help others understand who is sharing this review.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-4 my-5 ">


                        {{-- Reviewer Name --}}
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Your Name</label>
                                <span class="relative h-11">
                                    <input type="text" placeholder="John Doe" name="reviewer_name"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('reviewer_name') invalid-input @enderror"
                                        value="{{ old('reviewer_name') }}">
                                    <i class="fa-solid fa-user absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('reviewer_name')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Reviewer Email --}}
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Email</label>
                                <span class="relative">
                                    <input type="email" name="reviewer_email" placeholder="john@example.com"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('reviewer_email') invalid-input @enderror"
                                        value="{{ old('reviewer_email') }}">
                                    <i class="fa-solid fa-envelope absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('reviewer_email')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Company Name --}}
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Company Name</label>
                                <span class="relative">
                                    <input type="text" name="reviewer_company" placeholder="ABC Pvt Ltd"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('reviewer_company') invalid-input @enderror"
                                        value="{{ old('reviewer_company') }}">
                                    <i class="fa-solid fa-building absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('reviewer_company')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Location --}}
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Location</label>
                                <span class="relative">
                                    <input type="text" name="reviewer_location" placeholder="City, Country"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('reviewer_location') invalid-input @enderror"
                                        value="{{ old('reviewer_location') }}">
                                    <i class="fa-solid fa-location-dot absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('reviewer_location')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Designation --}}
                        <div class="sm:col-span-2">
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Designation</label>
                                <span class="relative">
                                    <input type="text" name="reviewer_designation" placeholder="CEO / Manager"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('reviewer_designation') invalid-input @enderror"
                                        value="{{ old('reviewer_designation') }}">
                                    <i class="fa-solid fa-briefcase absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('reviewer_designation')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Company Bio --}}
                        <div class="sm:col-span-2">
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Company Bio</label>
                                <span class="relative">
                                    <textarea name="reviewer_company_bio" placeholder="A short description about the company"
                                        class="rounded-md w-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-4 pr-4 py-2 @error('reviewer_company_bio') invalid-input @enderror">{{ old('reviewer_company_bio') }}</textarea>
                                </span>
                                @error('reviewer_company_bio')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full bg-white sm:px-8 py-8 px-4 rounded-md step-2">
                    <h2 class="text-xl sm:text-2xl md:text-3xl text-gray-800 font-bold text-center">
                        Project Details & Sub Ratings
                    </h2>
                    <p class="my-4 text-gray-600 text-sm sm:text-base text-center">
                        Provide project details and rate the company's performance in each area.
                    </p>

                    <div class="grid sm:grid-cols-2 gap-4 my-5">
                        {{-- Project Title --}}
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Project Title</label>
                                <span class="relative h-11">
                                    <input type="text" name="project_title" placeholder="Website Redesign"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('project_title') invalid-input @enderror"
                                        value="{{ old('project_title') }}">
                                    <i class="fa-solid fa-pencil absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('project_title')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Service Selection --}}
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-gray-600">Service Provided</label>
                            <select name="service_id"
                                class="rounded-md w-full border-2 border-gray-400/40 focus:border-(--primary) outline-none py-2 px-3">
                                <option value="" selected>--Select Service--</option>
                                @foreach ($company->services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        {{-- Project Size --}}
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Project Size</label>
                                <span class="relative h-11">
                                    <input type="text" name="project_size" placeholder="$5000"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('project_size') invalid-input @enderror"
                                        value="{{ old('project_size') }}">
                                    <i class="fa-solid fa-dollar-sign absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('project_size')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Project Duration --}}
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Project Duration</label>
                                <span class="relative h-11">
                                    <input type="text" name="project_duration" placeholder="3 months"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('project_duration') invalid-input @enderror"
                                        value="{{ old('project_duration') }}">
                                    <i class="fa-solid fa-clock absolute left-3 top-3 text-gray-400"></i>
                                </span>
                                @error('project_duration')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Project Summary --}}
                        <div class="sm:col-span-2">
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Project Summary</label>
                                <textarea name="project_summary"
                                    class="rounded-md w-full border-2 border-gray-400/40 focus:border-(--primary) outline-none pl-4 pr-4 py-2 @error('project_summary') invalid-input @enderror"
                                    placeholder="Describe the project, goals, and outcome">{{ old('project_summary') }}</textarea>
                                @error('project_summary')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Sub Ratings --}}
                        @php
                            $subFields = [
                                'quality' => 'Quality',
                                'ai' => 'AI Usage',
                                'schedule' => 'Schedule',
                                'cost' => 'Cost',
                                'willing_to_refer' => 'Willing to Refer',
                            ];
                        @endphp

                        @foreach ($subFields as $field => $label)
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">{{ $label }}</label>
                                <select name="{{ $field }}"
                                    class="rounded-md w-full border-2 border-gray-400/40 focus:border-(--primary) outline-none py-2 px-3">
                                    @for ($i = 1; $i <= 5; $i += 0.5)
                                        <option value="{{ $i }}"
                                            {{ old($field) == $i ? 'selected' : '' }}>
                                            {{ number_format($i, 1) }}
                                        </option>
                                    @endfor
                                </select>
                                @error($field)
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="w-full bg-white sm:px-8 py-8 px-4 rounded-md step-3">
                    <h2 class="text-xl sm:text-2xl md:text-3xl text-gray-800 font-bold text-center">
                        Review Content
                    </h2>
                    <p class="my-4 text-gray-600 text-sm sm:text-base text-center">
                        Write a short title for your review and then describe your experience with the company.
                    </p>

                    <div class="grid sm:grid-cols-1 gap-4 my-5">

                        <div>
                            {{-- Review Title --}}
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Review Title</label>
                                <span class="relative h-11">
                                    <input type="text" name="review" placeholder="Great Experience!"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none pl-4 pr-4 py-2 @error('review') invalid-input @enderror"
                                        value="{{ old('review') }}">
                                </span>
                                @error('review')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Review Summary --}}
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-gray-600">Review Summary</label>
                            <textarea name="summary"
                                class="rounded-md w-full border-2 border-gray-400/40 focus:border-(--primary) outline-none pl-4 pr-4 py-2  @error('summary') invalid-input @enderror"
                                placeholder="Share your detailed experience...">{{ old('summary') }}</textarea>
                            @error('summary')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>


                <button type="submit"
                    class="bg-(--secondary) cursor-pointer text-white w-full text-center rounded-md py-2 hover:bg-(--light-primary) font-semibold peer-has-not-checked:hidden peer-has-checked:block">Submit
                    Review</button>

            </form>
        </div>
    </section>


</body>
<script>
    document.querySelectorAll('.alert').forEach(function(alert) {
        setTimeout(() => {
            alert.classList.add('opacity-0', 'transition', 'duration-500');
            setTimeout(() => alert.remove(), 1500);
        }, 4000);
    });

    // Manual close
    document.querySelectorAll('.close-alert').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const alert = btn.closest('.alert');
            alert.classList.add('opacity-0', 'transition', 'duration-500');
            setTimeout(() => alert.remove(), 500);
        });
    });
</script>

</html>
