    <div class="section md:pt-32 pt-25 pb-20 flex flex-col justify-between text-white gap-y-5 relative">
        {{-- <pre> {{ print_r($company->toArray(), true)  }}</pre> --}}
        <div class="flex items-center gap-x-5 gap-y-6 flex-col md:flex-row">
            <div class="w-40 h-40">
                <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="w-full h-full object-cover rounded-md">
            </div>
            <div class="flex flex-col gap-3 items-center md:items-start text-center">
                <div class="flex flex-wrap-reverse gap-2 items-center justify-center md:justify-start">
                    <h1 class="text-3xl sm:text-3xl md:text-4xl  font-bold">{{ $company->name }}</h1>
                    @if ($company->verified)
                        <span
                            class="flex gap-2 items-center flex-wrap bg-white md:px-3 md:py-1.5 px-2 py-1 rounded-full">
                            <svg class="md:w-5 md:h-5 w-4.5 h-4.5" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M21.007 8.27C22.194 9.125 23 10.45 23 12c0 1.55-.806 2.876-1.993 3.73.24 1.442-.134 2.958-1.227 4.05-1.095 1.095-2.61 1.459-4.046 1.225C14.883 22.196 13.546 23 12 23c-1.55 0-2.878-.807-3.731-1.996-1.438.235-2.954-.128-4.05-1.224-1.095-1.095-1.459-2.611-1.217-4.05C1.816 14.877 1 13.551 1 12s.816-2.878 2.002-3.73c-.242-1.439.122-2.955 1.218-4.05 1.093-1.094 2.61-1.467 4.057-1.227C9.125 1.804 10.453 1 12 1c1.545 0 2.88.803 3.732 1.993 1.442-.24 2.956.135 4.048 1.227 1.093 1.092 1.468 2.608 1.227 4.05Zm-4.426-.084a1 1 0 0 1 .233 1.395l-5 7a1 1 0 0 1-1.521.126l-3-3a1 1 0 0 1 1.414-1.414l2.165 2.165 4.314-6.04a1 1 0 0 1 1.395-.232Z"
                                    class="fill-lime-600" />
                            </svg>
                            <p class="text-xs sm:text-sm font-bold text-lime-800 ">Premier Verified</p>
                        </span>
                    @endif
                </div>
                <div class="flex gap-x-5 gap-y-3 items-center flex-wrap justify-center md:justify-start"">
                    <div class="flex items-center gap-1 flex-wrap justify-center md:justify-start">
                        {{-- !stars --}}
                        <x-star-rating :rating="$company->reviews_avg_rating" :reviews="$company->reviews_count" color="yellow" textColor="text-white" />
                        <span class="flex items-center gap-1">|
                            <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602" />
                            </svg>
                            {{-- ! Location --}}
                            <address class="text-sm">{{ $company->details->locations }}</address>
                        </span>
                    </div>

                    {{-- <span class="flex items-center flex-wrap gap-2">
     
                        <div class="flex flex-wrap justify-center -space-x-3">
                            <img class="size-10 rounded-full"
                                src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=200"
                                alt="userImage1" />
                            <img class="size-10 rounded-full"
                                src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=200"
                                alt="userImage2" />
                            <img class="size-10 rounded-full"
                                src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=200&h=200&auto=format&fit=crop"
                                alt="userImage3" />
                        </div>
                        <a href="#">
                            <small>
                                567+ Network Connections
                            </small>
                        </a>
                    </span> --}}
                </div>
                <div class="flex gap-2 w-full text-base font-semibold flex-wrap justify-center md:justify-start">
                    <a target="_blank" href="" class="btn-white flex-1  text-nowrap ">
                        Visit Website
                    </a>
                    <a href="javascript:void(0)" id="openInquiryModal" class="btn-outlined flex-1 text-nowrap ">
                        Contact
                    </a>
                    @if ($company->packages->count() > 0)
                        <a target="_blank" href="{{ route('profile.packages', $company->slug) }}"
                            class="btn-outlined flex-1 text-nowrap">
                            View Packages
                        </a>
                    @endif
                </div>
                @if (is_null($company->user_id))
                    <div class="bg-lime-50 text-gray-800 px-4 py-1.5 rounded flex items-center justify-between w-full">
                        <p>This profile is unclaimed. <i class="fa-solid fa-circle-exclamation"></i></p>
                        <a href="{{ route('companies.claim.form', $company->id) }}"
                            class="outline px-2 py-1 rounded-md outline-lime-800 hover:bg-lime-800 hover:text-white">claim</a>
                    </div>
                @endif
            </div>
        </div>
        <button
            class="absolute top-25 md:right-10 right-5 rounded-md font-medium flex items-center gap-2 text-white cursor-pointer">
            {{-- <i class="fa-solid fa-bookmark"></i> --}}
            <i class="fa-regular fa-bookmark text-2xl text-lime-600"
                onclick="this.classList.contains('fa-regular') 
            ? (this.classList.replace('fa-regular', 'fa-solid')) 
            : (this.classList.replace('fa-solid', 'fa-regular'));"></i>
            <p class="hidden md:block">Add to shortlist</p>
        </button>
    </div>

    <!-- Inquiry Modal -->
    <div id="inquiryModal"
        class="fixed inset-0 bg-black/60 bg-opacity-50 flex items-center justify-center px-3 hidden z-50">
        <div
            class="bg-white rounded-md w-full max-w-3xl sm:px-8 py-8 px-4 mx-auto lg:px-12 mt-20 lg:w-3/5 overflow-auto max-h-[90vh]">
            <div class="w-full">
                <h2 class="text-3xl sm:text-4xl md:text-5xl text-gray-800 font-bold text-center">
                    Contact <span class="text-lime-700">{{ $company->name }}</span>
                </h2>
                <p class="my-4 text-gray-600 text-sm sm:text-base text-center">
                    Send your inquiry to this company and they will get back to you soon.
                </p>

                <form action="{{ route('inquiries.store') }}" method="POST" class="flex flex-col">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">

                    <div class="grid sm:grid-cols-2 gap-4 my-5 transition-all duration-500 ease-in-out">

                        <!-- Name -->
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Name</label>
                                <span class="relative h-11">
                                    <input type="text" name="name" placeholder="John Doe"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('name') invalid-input @enderror"
                                        value="{{ old('name', auth()->check() ? auth()->user()->firstName . ' ' . auth()->user()->lastName : '') }}">
                                    <i
                                        class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                </span>
                                @error('name')
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
                                <label class="block mb-2 text-sm text-gray-600">Email</label>
                                <span class="relative h-11">
                                    <input type="email" name="email" placeholder="example@example.com"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('email') invalid-input @enderror"
                                        value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}">
                                    <i
                                        class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2  text-gray-400"></i>
                                </span>
                                @error('email')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Subject -->
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Subject</label>
                                <span class="relative h-11">
                                    <input type="text" name="subject" placeholder="Subject"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('subject') invalid-input @enderror"
                                        value="{{ old('subject') }}">
                                    <i
                                        class="fa-solid fa-tag absolute left-3 top-1/2 -translate-y-1/2  text-gray-400"></i>
                                </span>
                                @error('subject')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div class="inp-field w-full">
                                <label class="block mb-2 text-sm text-gray-600">Phone</label>
                                <span class="relative h-11">
                                    <input type="tel" name="phone" placeholder="+92 300 1234567"
                                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-2 @error('phone') invalid-input @enderror"
                                        value="{{ old('phone', auth()->check() ? auth()->user()->phone : '') }}">
                                    <i
                                        class="fa-solid fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                </span>
                                @error('phone')
                                    <span class="error">
                                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                        <p class="error-text">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Message -->
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

                    <div class="flex justify-end gap-2">
                        <button type="button" id="closeInquiryModal" class="btn-outlined">Cancel</button>
                        <button type="submit" class="btn-white">Send Inquiry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    