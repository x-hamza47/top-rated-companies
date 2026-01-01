<div class="step-2 px-6 py-6 bg-(--color-background) rounded-2xl">
    <h2 class="sm:text-3xl text-2xl font-semibold">Company Details</h2>
    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4 my-5 transition-all duration-500 ease-in-out ">
        {{-- !location --}}
        <div>
            <div class="inp-field w-full ">
                <label class="block mb-2 text-sm text-(--color-text)">Location</label>
                <span class="relative h-11">
                    <input type="text" placeholder="e.g., Karachi, Pakistan" name="locations"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('locations') invalid-input @enderror"
                        value="{{ old('locations', $company->details->locations ?? '') }}">
                    <i class="fa-solid fa-location-dot absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </span>
                {{-- @error('firstName')
                                            <span class="error">
                                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                                <p class="error-text">{{ $message }}</p>
                                            </span>
                                        @enderror --}}
            </div>
        </div>
        {{-- !Website --}}
        <div>
            <div class="inp-field w-full ">
                <label class="block mb-2 text-sm text-(--color-text)">Website</label>
                <span class="relative h-11">
                    <input type="text" placeholder="https://example.com" name="website"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-3 py-3 @error('website') invalid-input @enderror"
                        value="{{ old('website', $company->details->website ?? '') }}">
                    <i class="fa-solid fa-globe absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </span>
                {{-- @error('firstName')
                                            <span class="error">
                                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                                <p class="error-text">{{ $message }}</p>
                                            </span>
                                        @enderror --}}
            </div>
        </div>
        {{-- !languages --}}
        <div>
            <div class="inp-field w-full ">
                <label class="block mb-2 text-sm text-(--color-text)">Languages</label>

                <span class="relative ">
                    <input id="languages" type="text" name="languages" placeholder="Type language & press Enter"
                        class="rounded-md w-full  border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('languages') invalid-input @enderror text-white"
                        value='@json(old('languages', $company->details->languages ?? []))'>

                    <i class="fa-solid fa-language absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </span>

                {{-- validation --}}
                @error('languages')
                    <span class="error">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="error-text">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        {{-- ! Project Size --}}
        <div class="mb-4 slider-container"
            data-start="{{ old('min_project_size', $company->details->min_project_size ?? 1000) }}" data-min="500"
            data-max="250000" data-step="500" data-single="true" data-input="#project-size-input"
            data-hidden="#min_project_size">
            <label class="block mb-10 text-sm text-(--color-text)">Min Project Size (500 - 250,000)</label>

            <div class="slider" id="project-size-slider"></div>

            <div class="mt-2 flex items-center gap-2 relative">
                <span class="absolute top-1/2 left-2 -translate-y-1/2 text-gray-600">$</span>
                <input type="number" id="project-size-input"
                    class="border border-(--color-border) rounded px-2 py-1 pl-7 text-xs sm:text-base sm:w-32 w-24"
                    value="{{ old('min_project_size', $company->details->min_project_size ?? 1000) }}">
            </div>

            <input type="hidden" name="min_project_size" id="min_project_size"
                value="{{ old('min_project_size', $company->details->min_project_size ?? 1000) }}">
        </div>
        {{-- ! Hourly Rate  --}}
        <div class="mb-4 slider-container"
            data-start-min="{{ old('hourly_rate_min', $company->details->hourly_rate_min ?? 50) }}"
            data-start-max="{{ old('hourly_rate_max', $company->details->hourly_rate_max ?? 200) }}" data-min="5"
            data-max="500" data-step="5" data-single="false" data-input-min="#hourly-rate-min-input"
            data-input-max="#hourly-rate-max-input" data-hidden-min="#hourly_rate_min"
            data-hidden-max="#hourly_rate_max">
            <label class="block mb-10 text-sm text-(--color-text)">Hourly Rate ($)</label>
            <div class="slider" id="hourly-rate-slider"></div>

            <div class="mt-2 flex gap-2 items-center">
                <span class="text-xs sm:text-base">Min: $</span>
                <input type="number" id="hourly-rate-min-input"
                    class="border border-(--color-border) rounded px-2 py-1 text-xs sm:text-base sm:w-24 w-12">
                <span class="text-xs sm:text-base">Max: $</span>
                <input type="number" id="hourly-rate-max-input"
                    class="border border-(--color-border) rounded px-2 py-1 text-xs sm:text-base sm:w-24 w-12">
            </div>

            <input type="hidden" name="hourly_rate_min" id="hourly_rate_min">
            <input type="hidden" name="hourly_rate_max" id="hourly_rate_max">
        </div>
        {{-- ! Employees  --}}
        <div class="mb-4 slider-container"
            data-start-min="{{ old('employee_min', $company->details->employee_min ?? 1) }}"
            data-start-max="{{ old('employee_max', $company->details->employee_max ?? 50) }}" data-min="5"
            data-max="500" data-step="5" data-single="false" data-input-min="#employee-min-input"
            data-input-max="#employee-max-input" data-hidden-min="#employee_min" data-hidden-max="#employee_max">
            <label class="block mb-10 text-sm text-(--color-text)">Employees</label>
            <div class="slider" id="employee-slider"></div>

            <div class="mt-2 flex gap-2 items-center">
                <span class="text-xs sm:text-base">Min: </span>
                <input type="number" id="employee-min-input"
                    class="border border-(--color-border) rounded px-2 py-1 text-xs sm:text-base sm:w-24 w-12">
                <span class="text-xs sm:text-base">Max: </span>
                <input type="number" id="employee-max-input"
                    class="border border-(--color-border) rounded px-2 py-1 text-xs sm:text-base sm:w-24 w-12">
            </div>

            <input type="hidden" name="employee_min" id="employee_min">
            <input type="hidden" name="employee_max" id="employee_max">
        </div>
    </div>
    {{-- !Social links --}}
    <h3 class="text-xl sm:text-2xl font-semibold mb-2">
        Add Social Links
        <span class="text-sm text-gray-500 font-normal">(At least one social link is required)</span>
    </h3>
    @php
        $socialLinks = [];
        if (!empty($company->details->social_links)) {
            foreach ($company->details->social_links as $link) {
                $socialLinks[$link['platform']] = $link['value'];
            }
        }
    @endphp

    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4 my-5 transition-all duration-500 ease-in-out ">
        @foreach (['facebook', 'instagram', 'linkedin', 'twitter'] as $platform)
            <div>
                <div class="inp-field w-full">
                    <label class="block mb-2 text-sm text-(--color-text)">
                        {{ ucfirst($platform) }}
                    </label>
                    <span class="relative h-11">
                        <input type="url" placeholder="https://{{ $platform }}.com/..."
                            name="social_links[{{ $platform }}]"
                            class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-3 py-3 @error('social_links.' . $platform) invalid-input @enderror"
                            value="{{ old('social_links.' . $platform, $socialLinks[$platform] ?? '') }}">
                        <i
                            class="fa-brands fa-{{ $platform }} absolute left-3 top-1/2 -translate-y-1/2 text-[{{ $platform == 'instagram' ? '#E4405F': 
                            ($platform == 'linkedin' ? '#0077B5': 
                            ($platform == 'twitter' ? '#1DA1F2': '#1877F2')) }}]">
                        </i>
                    </span>
                </div>
            </div>
        @endforeach
        {{-- Facebook --}}

        {{-- <div>
            <div class="inp-field w-full">
                <label class="block mb-2 text-sm text-(--color-text)">Facebook</label>
                <span class="relative h-11">
                    <input type="url" placeholder="https://facebook.com/..." name="social_links[facebook]"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-3 py-3 @error('social_links.facebook') invalid-input @enderror"
                        value="{{ old('social_links.facebook', $company->details->social_links['facebook'] ?? '') }}">
                    <i class="fa-brands fa-facebook absolute left-3 top-1/2 -translate-y-1/2 text-[#1877F2]"></i>
                </span>
            </div>
        </div> --}}

        {{-- Instagram --}}
        {{-- <div>
            <div class="inp-field w-full">
                <label class="block mb-2 text-sm text-(--color-text)">Instagram</label>
                <span class="relative h-11">
                    <input type="url" placeholder="https://instagram.com/..." name="social_links[instagram]"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-3 py-3 @error('social_links.instagram') invalid-input @enderror"
                        value="{{ old('social_links.instagram', $company->details->social_links['instagram'] ?? '') }}">
                    <i class="fa-brands fa-instagram absolute left-3 top-1/2 -translate-y-1/2 text-[#E4405F]"></i>
                </span>
            </div>
        </div> --}}

        {{-- LinkedIn --}}
        {{-- <div>
            <div class="inp-field w-full">
                <label class="block mb-2 text-sm text-(--color-text)">LinkedIn</label>
                <span class="relative h-11">
                    <input type="url" placeholder="https://linkedin.com/..." name="social_links[linkedin]"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-3 py-3 @error('social_links.linkedin') invalid-input @enderror"
                        value="{{ old('social_links.linkedin', $company->details->social_links['linkedin'] ?? '') }}">
                    <i class="fa-brands fa-linkedin absolute left-3 top-1/2 -translate-y-1/2 text-[#0077B5]"></i>
                </span>
            </div>
        </div> --}}

        {{-- Twitter --}}
        {{-- <div>
            <div class="inp-field w-full">
                <label class="block mb-2 text-sm text-(--color-text)">Twitter</label>
                <span class="relative h-11">
                    <input type="url" placeholder="https://twitter.com/..." name="social_links[twitter]"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-3 py-3 @error('social_links.twitter') invalid-input @enderror"
                        value="{{ old('social_links.twitter', $company->details->social_links['twitter'] ?? '') }}">
                    <i class="fa-brands fa-twitter absolute left-3 top-1/2 -translate-y-1/2 text-[#1DA1F2]"></i>
                </span>
            </div>
        </div> --}}

    </div>
</div>
