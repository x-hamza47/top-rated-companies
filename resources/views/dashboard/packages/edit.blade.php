@extends('dashboard.layout.main')
@section('title', 'Package-edit')

@section('content')
    <div class="dashboard-form-container pb-20">
        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">Edit Package</h3>
            <a href="{{ route('packages.index') }}" class="btn btn-secondary">Go Back</a>
        </div>

        <form class="flex flex-col gap-10" action="{{ route('packages.update', $package) }}" method="post">
            @csrf
            @method('PUT')

            <div class="px-6 py-4 bg-(--color-background) rounded-b-2xl">
                <h2 class="sm:text-3xl text-2xl font-semibold">Update Package</h2>

                {{-- ================= BASIC INFO ================= --}}
                <div class="grid sm:grid-cols-2 gap-4 my-5">

                    {{-- Service --}}
                    <div class="inp-field">
                        <label class="block mb-2 text-sm">Service</label>
                        <select name="service_id"
                            class="rounded-md w-full border-2 border-gray-400/40 pl-4 py-3 @error('service_id') invalid-input @enderror">
                            <option disabled>Select Service</option>
                            @foreach ($services as $id => $name)
                                <option value="{{ $id }}" @selected(old('service_id', $package->service_id) == $id)>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price Type --}}
                    <div class="inp-field">
                        <label class="block mb-2 text-sm">Price Type</label>
                        <select name="price_type" class="rounded-md w-full border-2 border-gray-400/40 pl-4 py-3">
                            <option value="total" @selected(old('price_type', $package->price_type) === 'total')>
                                Total (One-time)
                            </option>
                            <option value="monthly" @selected(old('price_type', $package->price_type) === 'monthly')>
                                Monthly
                            </option>
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm">Description (optional)</label>
                        <textarea name="description" rows="4" class="rounded-md w-full border-2 border-gray-400/40 px-4 py-3">{{ old('description', $package->description) }}</textarea>
                    </div>
                </div>

                {{-- ================= PRICES ================= --}}
                <div class="flex flex-wrap gap-4">
                    @foreach (['small', 'medium', 'large'] as $tier)
                        <div class="flex-1 min-w-72 bg-lime-800/20 p-5 rounded-md">
                            <label class="block mb-2 text-sm capitalize">{{ $tier }} Tier Price ($)</label>
                            <input type="number" step="0.01" name="{{ $tier }}_price"
                                value="{{ old($tier . '_price', $package->{$tier . '_price'}) }}"
                                class="rounded-md w-full border-2 border-gray-400/40 px-4 py-3">
                        </div>
                    @endforeach
                </div>

                {{-- ================= FEATURES ================= --}}
                <div class="mt-10">
                    <h3 class="text-xl font-semibold mb-6">Package Features</h3>

                    <div id="features-container" class="space-y-7">
                        @php
                            $features = old('features') ?? $package->features->toArray();
                        @endphp

                        @foreach ($features as $index => $feature)
                            <div
                                class="feature-row relative bg-(--color-surface) border border-(--color-border) md:p-6 p-5 rounded-xl shadow-sm">

                                {{-- ! Feature & Type Container --}}
                                <div class="flex flex-col sm:flex-row gap-5 mb-6">
                                    <div class="flex-1">
                                        <label class="block mb-2 text-sm font-medium">Feature Name</label>
                                        <input type="text" name="features[{{ $index }}][feature]"
                                            value="{{ old("features.$index.feature", $feature['feature']) }}"
                                            class="rounded-lg w-full border px-4 py-2.5">
                                    </div>

                                    <div class="w-full sm:w-64">
                                        <label class="block mb-2 text-sm font-medium">Display Type</label>
                                        <select name="features[{{ $index }}][type]"
                                            class="feature-type-select rounded-lg w-full border px-4 py-2.5">
                                            <option value="text" @selected(old("features.$index.type", $feature['type']) === 'text')>
                                                Text
                                            </option>
                                            <option value="checkbox" @selected(old("features.$index.type", $feature['type']) === 'checkbox')>
                                                Checkbox
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                {{-- ! Value Container --}}
                                <div class="value-container mt-1">
                                    <label class="block mb-3 text-sm font-medium text-(--color-text)">
                                        {{ old("features.$index.type", $feature['type'] ?? 'text') === 'checkbox' ? 'Included in tiers' : 'Value per tier' }}
                                    </label>

                                    {{-- ? Text Container --}}
                                    <div
                                        class="text-values  {{ old("features.$index.type", $feature['type'] ?? 'text') === 'checkbox' ? 'hidden' : '' }}">
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                                            <div>
                                                <span class="block text-xs text-gray-500 mb-1.5 font-medium">Small
                                                    Tier</span>
                                                <input type="text" name="features[{{ $index }}][small_value]"
                                                    value="{{ old("features.$index.type") === 'text' ? old("features.$index.small_value") : $feature['small_value'] }}"
                                                    class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                                    placeholder="e.g. 5 GB, Basic, 1 Website">
                                                @if (old("features.$index.type") === 'text')
                                                    @error("features.$index.small_value")
                                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                    @enderror
                                                @endif
                                            </div>
                                            <div>
                                                <span class="block text-xs text-gray-500 mb-1.5 font-medium">Medium
                                                    Tier</span>
                                                <input type="text" name="features[{{ $index }}][medium_value]"
                                                    value="{{ old("features.$index.type") === 'text' ? old("features.$index.medium_value") : $feature['medium_value'] }}"
                                                    class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                                    placeholder="e.g. 20 GB, Standard, 5 Websites">
                                                @if (old("features.$index.type") === 'text')
                                                    @error("features.$index.medium_value")
                                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                    @enderror
                                                @endif
                                            </div>
                                            <div>
                                                <span class="block text-xs text-gray-500 mb-1.5 font-medium">Large
                                                    Tier</span>
                                                <input type="text" name="features[{{ $index }}][large_value]"
                                                    value="{{ old("features.$index.type") === 'text' ? old("features.$index.large_value") : $feature['large_value'] }}"
                                                    class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                                    placeholder="e.g. Unlimited, Premium, Unlimited Websites">
                                                @if (old("features.$index.type") === 'text')
                                                    @error("features.$index.large_value")
                                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ? CheckBox Container --}}

                                    <div
                                        class="checkbox-values {{ old("features.$index.type", $feature['type']) !== 'checkbox' ? 'hidden' : '' }}">
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                                            {{-- SMALL --}}
                                            <label
                                                class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">

                                                {{-- hidden fallback --}}
                                                <input type="hidden" name="features[{{ $index }}][small_value]"
                                                    value="0">

                                                <input type="checkbox" name="features[{{ $index }}][small_value]"
                                                    value="1"
                                                    class="w-5 h-5 rounded border-gray-300 text-(--color-primary)
                          focus:ring-(--color-primary) accent-(--color-primary)"
                                                    @checked(old("features.$index.small_value", $feature['small_value']) == 1)>

                                                <span class="text-sm font-medium text-(--color-text)">Small Tier</span>
                                            </label>

                                            {{-- MEDIUM --}}
                                            <label
                                                class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">

                                                {{-- hidden fallback --}}
                                                <input type="hidden" name="features[{{ $index }}][medium_value]"
                                                    value="0">

                                                <input type="checkbox" name="features[{{ $index }}][medium_value]"
                                                    value="1"
                                                    class="w-5 h-5 rounded border-gray-300 text-(--color-primary)
                          focus:ring-(--color-primary) accent-(--color-primary)"
                                                    @checked(old("features.$index.medium_value", $feature['medium_value']) == 1)>

                                                <span class="text-sm font-medium text-(--color-text)">Medium Tier</span>
                                            </label>

                                            {{-- LARGE --}}
                                            <label
                                                class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">

                                                {{-- hidden fallback --}}
                                                <input type="hidden" name="features[{{ $index }}][large_value]"
                                                    value="0">

                                                <input type="checkbox" name="features[{{ $index }}][large_value]"
                                                    value="1"
                                                    class="w-5 h-5 rounded border-gray-300 text-(--color-primary)
                          focus:ring-(--color-primary) accent-(--color-primary)"
                                                    @checked(old("features.$index.large_value", $feature['large_value']) == 1)>

                                                <span class="text-sm font-medium text-(--color-text)">Large Tier</span>
                                            </label>

                                        </div>
                                    </div>

                                </div>

                                <button type="button"
                                    class="remove-feature-btn absolute top-5 right-5 text-(--color-error) hover:text-red-800 transition-colors">
                                    <i class="fa-solid fa-trash-can text-xl"></i>
                                </button>

                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-feature-btn" class="btn btn-primary mt-5">
                        <i class="fa-solid fa-plus mr-2"></i>Add Feature
                    </button>
                </div>

                <div class="border-t mt-10 pt-6">
                    <button type="submit" class="bg-(--color-secondary) px-6 py-3 text-white rounded-md font-semibold">
                        Update Package
                    </button>
                    <a href="{{ route('packages.index') }}" class="ml-6 text-gray-500">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let featureIndex = {{ $package->features->count() }};

        $(document).ready(function() {

            // Toggle label and visibility when type changes
            $(document).on('change', '.feature-type-select', function() {
                const row = $(this).closest('.feature-row');
                const textContainer = row.find('.text-values');
                const checkContainer = row.find('.checkbox-values');
                const label = row.find('.value-container > label');

                if ($(this).val() === 'checkbox') {
                    textContainer.find('input').prop('disabled', true);
                    checkContainer.find('input').prop('disabled', false);
                    textContainer.hide();
                    checkContainer.show();
                    label.text('Included in tiers');
                } else {
                    textContainer.find('input').prop('disabled', false);
                    checkContainer.find('input').prop('disabled', true);
                    textContainer.show();
                    checkContainer.hide();
                    label.text('Value per tier');
                }
            });

            // Fix initial state for already loaded features
            $('.feature-type-select').each(function() {
                $(this).trigger('change');
            });

            // Add new feature row
            $('#add-feature-btn').on('click', function() {
                const newFeatureHtml = `
                <div class="feature-row relative bg-(--color-surface) border border-(--color-border) md:p-6 p-5 rounded-xl shadow-sm">

                    <div class="flex flex-col sm:flex-row gap-5 mb-6">
                        <div class="flex-1">
                            <label class="block mb-2 text-sm font-medium text-(--color-text)">Feature Name</label>
                            <input type="text" name="features[${featureIndex}][feature]"
                                   class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) outline-none px-4 py-2.5 text-base"
                                   placeholder="e.g. Custom Domain, Priority Support, SEO Optimization" required>
                        </div>

                        <div class="w-full sm:w-64">
                            <label class="block mb-2 text-sm font-medium text-(--color-text)">Display Type</label>
                            <select name="features[${featureIndex}][type]" class="feature-type-select rounded-lg w-full border border-gray-300 focus:border-(--color-primary) outline-none px-4 py-2.5 text-base">
                                <option value="text" selected>Text / Value per tier</option>
                                <option value="checkbox">Yes/No per tier (checkbox)</option>
                            </select>
                        </div>
                    </div>

                    <div class="value-container mt-1">
                        <label class="block mb-3 text-sm font-medium text-(--color-text)">Value per tier</label>

                        <!-- Text inputs (default visible) -->
                        <div class="text-values grid grid-cols-1 sm:grid-cols-3 gap-5">
                            <div>
                                <span class="block text-xs text-gray-500 mb-1.5 font-medium">Small Tier</span>
                                <input type="text" name="features[${featureIndex}][small_value]"
                                       class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                       placeholder="e.g. 5 GB, Basic, 1 Website">
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500 mb-1.5 font-medium">Medium Tier</span>
                                <input type="text" name="features[${featureIndex}][medium_value]"
                                       class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                       placeholder="e.g. 20 GB, Standard, 5 Websites">
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500 mb-1.5 font-medium">Large Tier</span>
                                <input type="text" name="features[${featureIndex}][large_value]"
                                       class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                       placeholder="e.g. Unlimited, Premium, Unlimited Websites">
                            </div>
                        </div>

                        <!-- Checkboxes (hidden by default) -->
                        <div class="checkbox-values hidden grid grid-cols-1 sm:grid-cols-3 gap-5">

                            <label class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                <input type="hidden" name="features[${featureIndex}][small_value]" value="0">
                                <input type="checkbox" name="features[${featureIndex}][small_value]" value="1"
                                       class="w-5 h-5 rounded border-gray-300 text-(--color-primary) focus:ring-(--color-primary)">
                                <span class="text-sm font-medium text-(--color-text)">Small Tier</span>
                            </label>

                            <label class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                <input type="hidden" name="features[${featureIndex}][medium_value]" value="0">
                                <input type="checkbox" name="features[${featureIndex}][medium_value]" value="1"
                                       class="w-5 h-5 rounded border-gray-300 text-(--color-primary) focus:ring-(--color-primary)">
                                <span class="text-sm font-medium text-(--color-text)">Medium Tier</span>
                            </label>

                            <label class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                <input type="hidden" name="features[${featureIndex}][large_value]" value="0">
                                <input type="checkbox" name="features[${featureIndex}][large_value]" value="1"
                                       class="w-5 h-5 rounded border-gray-300 text-(--color-primary) focus:ring-(--color-primary)">
                                <span class="text-sm font-medium text-(--color-text)">Large Tier</span>
                            </label>

                        </div>
                    </div>

                    <button type="button" class="remove-feature-btn absolute top-5 right-5 text-red-600 hover:text-red-800 transition-colors">
                        <i class="fa-solid fa-trash-can text-xl"></i>
                    </button>
                </div>`;

                $('#features-container').append(newFeatureHtml);

                // Trigger change on the newly added select so visibility is correct from the start
                $(`select[name="features[${featureIndex}][type]"]`).trigger('change');

                featureIndex++;
            });

            // Remove feature row
            $(document).on('click', '.remove-feature-btn', function() {
                $(this).closest('.feature-row').remove();
            });
        });
    </script>
@endpush 

@push('styles')
    @vite('resources/css/dashboard-css/form.css')
@endpush
