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
                @error('locations')
                    <span class="error">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="error-text">{{ $message }}</p>
                    </span>
                @enderror
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
                @error('website')
                    <span class="error">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="error-text">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>
        {{-- !languages --}}
        <div>
            <div class="inp-field w-full ">
                <label class="block mb-2 text-sm text-(--color-text)">Languages</label>

                <span class="relative ">
                    <input id="languages" type="text" name="languages" placeholder="Type language & press Enter"
                        class="rounded-md w-full  border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('languages') invalid-input @enderror text-white">

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

        <div class="mb-4">
            <label class="block mb-2 text-sm text-(--color-text)">
                Min Project Size
            </label>

            <select name="min_project_size" class="w-full border border-(--color-border) rounded px-3 py-2 text-sm">
                <option value="">Select project size</option>

                @foreach (config('company.project_sizes') as $size)
                    <option value="{{ $size }}"
                        {{ old('min_project_size', $company->details->min_project_size ?? '') === $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                @endforeach
            </select>

            @error('min_project_size')
                <span class="error">
                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                    <p class="error-text">{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- ! Hourly Rate --}}
        <div class="mb-4 ">
            <label class="block mb-2 text-sm text-(--color-text)">
                Hourly Rate ($)
            </label>

            <select name="hourly_rate" class="w-full border border-(--color-border) rounded px-3 py-2 text-sm">
                <option value="">Select hourly rate</option>

                @foreach (config('company.hourly_rates') as $rate)
                    <option value="{{ $rate }}"
                        {{ old('hourly_rate', $company->details->hourly_rate ?? '') === $rate ? 'selected' : '' }}>
                        {{ $rate }}
                    </option>
                @endforeach
            </select>

            @error('hourly_rate')
                <span class="error">
                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                    <p class="error-text">{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- ! Employees --}}
        <div class="mb-4">
            <label class="block mb-2 text-sm text-(--color-text)">
                Employees
            </label>

            <select name="employees_range" class="w-full border border-(--color-border) rounded px-3 py-2 text-sm"
                {{ old('is_freelancer', $company->details->is_freelancer ?? false) ? 'disabled' : '' }}>
                <option value="">Select employee range</option>

                @foreach (config('company.employee_ranges') as $range)
                    <option value="{{ $range }}"
                        {{ old('employees_range', $company->details->employees_range ?? '') === $range ? 'selected' : '' }}>
                        {{ $range }}
                    </option>
                @endforeach
            </select>

            @error('employees_range')
                <span class="error">
                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                    <p class="error-text">{{ $message }}</p>
                </span>
            @enderror
        </div>

    </div>
    {{-- !Social links --}}
    <h3 class="text-xl sm:text-2xl font-semibold mb-2">
        Add Social Links
        <span class="text-sm text-gray-500 font-normal">(At least one social link is required)</span>
    </h3>
    @php
        $socialLinks = $company->details->social_links ?? [];
    @endphp

    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4 my-5 transition-all duration-500 ease-in-out">
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
                            class="fa-brands fa-{{ $platform }} absolute left-3 top-1/2 -translate-y-1/2 text-[{{ $platform == 'instagram'
                                ? '#E4405F'
                                : ($platform == 'linkedin'
                                    ? '#0077B5'
                                    : ($platform == 'twitter'
                                        ? '#1DA1F2'
                                        : '#1877F2')) }}]">
                        </i>
                    </span>
                    @error('social_links.' . $platform)
                        <span class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>
</div>
