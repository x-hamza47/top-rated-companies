<div class="step-2 px-6 py-6 bg-(--color-background) rounded-2xl">
    <h2 class="sm:text-3xl text-2xl font-semibold">Company Details</h2>
    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4 my-5">

        <x-forms.input-field name="locations" label="Location" icon="location-dot" placeholder="e.g., Karachi, Pakistan"
            :value="$company->details?->locations ?? ''" />
        <x-forms.input-field name="website" label="Website" icon="globe" placeholder="https://example.com"
            :value="$company->details?->website ?? ''" />
        <x-forms.input-field name="languages" label="Languages" icon="language"
            placeholder="Type language & press Enter" />

        {{-- Min Project Size --}}
        <x-forms.input-field name="min_project_size" label="Min Project Size" type="select" icon="dollar-sign">
            <option value="">Select project size</option>
            @foreach (config('company.project_sizes') as $value => $label)
                <option value="{{ $value }}"
                    {{ old('min_project_size', $company->details?->min_project_size ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </x-forms.input-field>

        {{-- Hourly Rate --}}
        <x-forms.input-field name="hourly_rate" label="Hourly Rate ($)" type="select" icon="clock">
            <option value="">Select hourly rate</option>
            @foreach (config('company.hourly_rates') as $value => $label)
                <option value="{{ $value }}"
                    {{ old('hourly_rate', $company->details?->hourly_rate ?? '') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </x-forms.input-field>

        {{-- Employees --}}
        @php
            $isFreelancer = old('is_freelancer', $company->details?->is_freelancer ?? false);
        @endphp

        <x-forms.input-field name="employees_range" label="Employees" type="select" icon="users" :disabled="$isFreelancer">
            <option value="">Select employee range</option>
            @foreach (config('company.employee_ranges') as $range)
                <option value="{{ $range }}"
                    {{ old('employees_range', $company->details?->employees_range ?? '') == $range ? 'selected' : '' }}>
                    {{ $range }}</option>
            @endforeach
        </x-forms.input-field>

    </div>

    {{-- Social Links --}}
    {{-- Social Links --}}
    <h3 class="text-xl sm:text-2xl font-semibold mb-2">
        Add Social Links

    </h3>

    @php
        $socialLinks = $company->details?->social_links ?? [];
        $socialIcons = [
            'facebook' => ['icon' => 'facebook', 'color' => '#1877F2'],
            'instagram' => ['icon' => 'instagram', 'color' => '#E4405F'],
            'linkedin' => ['icon' => 'linkedin', 'color' => '#0077B5'],
            'twitter' => ['icon' => 'twitter', 'color' => '#1DA1F2'],
        ];
    @endphp

    <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4 my-5">
        @foreach ($socialIcons as $platform => $meta)
            <div class="inp-field w-full">
                <label for="social_{{ $platform }}"
                    class="block mb-2 text-sm text-(--color-text)">{{ ucfirst($platform) }}</label>
                <span class="relative flex items-center h-11">
                    <i class="fa-brands fa-{{ $meta['icon'] }} absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
                        style="color: {{ $meta['color'] }}"></i>
                    <input type="url" id="social_{{ $platform }}" name="social_links[{{ $platform }}]"
                        placeholder="https://{{ $platform }}.com/..."
                        value="{{ old('social_links.' . $platform, $socialLinks[$platform] ?? '') }}"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-4 py-3 {{ $errors->has('social_links.' . $platform) ? 'invalid-input' : '' }}">
                </span>
                @error('social_links')
                    <span class="error">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="error-text">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        @endforeach
    </div>
</div>
