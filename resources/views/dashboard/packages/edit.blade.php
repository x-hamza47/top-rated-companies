@extends('dashboard.layout.main')
@section('title', 'Package-edit')
@section('content')
    <div class="dashboard-form-container pb-20">
        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">Edit Package</h3>
            <a href="{{ route('packages.index') }}" class="btn btn-secondary">Go Back</a>
        </div>

        <form class="flex flex-col gap-10" action="{{ route('packages.update', $package->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="px-6 py-4 bg-(--color-background) rounded-b-2xl">
                <h2 class="sm:text-3xl text-2xl font-semibold">Edit Package</h2>

                <div class="grid sm:grid-cols-2 gap-4 my-5 transition-all duration-500 ease-in-out">

                    {{-- Service Dropdown --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Service</label>
                            <span class="relative h-11">
                                <select name="service_id"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-10 py-3 @error('service_id') invalid-input @enderror">
                                    <option value="" disabled>Select Service</option>
                                    @foreach ($services as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ old('service_id', $package->service_id) == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="fa-solid fa-briefcase absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('service_id')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Price Type --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Price Type</label>
                            <span class="relative h-11">
                                <select name="price_type"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-10 py-3 @error('price_type') invalid-input @enderror">
                                    <option value="total"
                                        {{ old('price_type', $package->price_type) == 'total' ? 'selected' : '' }}>
                                        Total (One-time)
                                    </option>
                                    <option value="monthly"
                                        {{ old('price_type', $package->price_type) == 'monthly' ? 'selected' : '' }}>
                                        Monthly
                                    </option>
                                </select>
                                <i
                                    class="fa-solid fa-dollar-sign absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('price_type')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="sm:col-span-2">
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Description (optional)</label>
                            <textarea name="description" rows="4"
                                class="rounded-md w-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-3 pr-3 py-3 @error('description') invalid-input @enderror"
                                placeholder="Brief package overview...">{{ old('description', $package->description) }}</textarea>
                            @error('description')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex [&>div]:flex-1 [&>div]:min-w-72 flex-wrap gap-y-3 gap-x-3 justify-center">
                    {{-- Small Price --}}
                    <div class="bg-lime-800/20 px-5 py-6 rounded-md">
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Small Tier Price ($)</label>
                            <span class="relative h-11">
                                <input type="number" step="0.01" name="small_price" placeholder="0.00"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-10 pr-4 py-3 @error('small_price') invalid-input @enderror"
                                    value="{{ old('small_price', $package->small_price) }}">
                                <i class="fa-solid fa-tag absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('small_price')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Medium Price --}}
                    <div class="bg-lime-800/20 px-5 py-6 rounded-md">
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Medium Tier Price ($)</label>
                            <span class="relative h-11">
                                <input type="number" step="0.01" name="medium_price" placeholder="0.00"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-10 pr-4 py-3 @error('medium_price') invalid-input @enderror"
                                    value="{{ old('medium_price', $package->medium_price) }}">
                                <i class="fa-solid fa-tag absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('medium_price')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Large Price --}}
                    <div class="bg-lime-800/20 px-5 py-6 rounded-md">
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Large Tier Price ($)</label>
                            <span class="relative h-11">
                                <input type="number" step="0.01" name="large_price" placeholder="0.00"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-10 pr-4 py-3 @error('large_price') invalid-input @enderror"
                                    value="{{ old('large_price', $package->large_price) }}">
                                <i class="fa-solid fa-tag absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('large_price')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="mt-10">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold">Package Features</h3>
                        <button type="button" id="add-feature-btn" class="btn btn-primary px-5 py-2.5 text-sm font-medium">
                            <i class="fa-solid fa-plus mr-2"></i>Add Feature
                        </button>
                    </div>

                    <div id="features-container" class="space-y-7">

                        @foreach ($package->features as $index => $feature)
                            <div
                                class="feature-row relative bg-(--color-surface) border border-(--color-border) md:p-6 p-5 rounded-xl shadow-sm">

                                <!-- Name + Type -->
                                <div class="flex flex-col sm:flex-row gap-5 mb-6">
                                    <div class="flex-1">
                                        <label class="block mb-2 text-sm font-medium text-(--color-text)">Feature
                                            Name</label>
                                        <input type="text" name="features[{{ $index }}][feature]"
                                            value="{{ old("features.$index.feature", $feature->feature) }}"
                                            class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) outline-none px-4 py-2.5 text-base"
                                            placeholder="e.g. Custom Domain, Priority Support, SEO Optimization" required>
                                    </div>

                                    <div class="w-full sm:w-64">
                                        <label class="block mb-2 text-sm font-medium text-(--color-text)">Display
                                            Type</label>
                                        <select name="features[{{ $index }}][type]"
                                            class="feature-type-select rounded-lg w-full border border-gray-300 focus:border-(--color-primary) outline-none px-4 py-2.5 text-base">
                                            <option value="text"
                                                {{ old("features.$index.type", $feature->type) === 'text' ? 'selected' : '' }}>
                                                Text / Value per tier</option>
                                            <option value="checkbox"
                                                {{ old("features.$index.type", $feature->type) === 'checkbox' ? 'selected' : '' }}>
                                                Yes/No per tier (checkbox)</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Value / Include area -->
                                <div class="value-container mt-1">
                                    <label class="block mb-3 text-sm font-medium text-(--color-text)">
                                        {{ old("features.$index.type", $feature->type) === 'checkbox' ? 'Included in tiers' : 'Value per tier' }}
                                    </label>

                                    <!-- Text inputs -->
                                    <div
                                        class="text-values grid grid-cols-1 sm:grid-cols-3 gap-5 {{ old("features.$index.type", $feature->type) === 'checkbox' ? 'hidden' : '' }}">
                                        <div>
                                            <span class="block text-xs text-gray-500 mb-1.5 font-medium">Small Tier</span>
                                            <input type="text" name="features[{{ $index }}][small_value]"
                                                value="{{ old("features.$index.small_value", $feature->small_value) }}"
                                                class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                                placeholder="e.g. 5 GB, Basic, 1 Website">
                                        </div>
                                        <div>
                                            <span class="block text-xs text-gray-500 mb-1.5 font-medium">Medium Tier</span>
                                            <input type="text" name="features[{{ $index }}][medium_value]"
                                                value="{{ old("features.$index.medium_value", $feature->medium_value) }}"
                                                class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                                placeholder="e.g. 20 GB, Standard, 5 Websites">
                                        </div>
                                        <div>
                                            <span class="block text-xs text-gray-500 mb-1.5 font-medium">Large Tier</span>
                                            <input type="text" name="features[{{ $index }}][large_value]"
                                                value="{{ old("features.$index.large_value", $feature->large_value) }}"
                                                class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                                placeholder="e.g. Unlimited, Premium, Unlimited Websites">
                                        </div>
                                    </div>

                                    <!-- Checkboxes – same style as dynamic ones -->
                                    <!-- Checkboxes -->
                                    <div
                                        class="checkbox-values grid grid-cols-1 sm:grid-cols-3 gap-5 {{ old("features.$index.type", $feature->type) !== 'checkbox' ? 'hidden' : '' }}">

                                        <!-- Small -->
                                        <label
                                            class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                            <input type="hidden" name="features[{{ $index }}][small_value]"
                                                value="0">
                                            <input type="checkbox" name="features[{{ $index }}][small_value]"
                                                value="1"
                                                class="w-5 h-5 rounded border-gray-300 text-(--color-primary) focus:ring-(--color-primary)"
                                                {{ old("features.$index.small_value", $feature->small_value) == '1' ? 'checked' : '' }}>
                                            <span class="text-sm font-medium text-(--color-text)">Small Tier</span>
                                        </label>

                                        <!-- Medium -->
                                        <label
                                            class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                            <input type="hidden" name="features[{{ $index }}][medium_value]"
                                                value="0">
                                            <input type="checkbox" name="features[{{ $index }}][medium_value]"
                                                value="1"
                                                class="w-5 h-5 rounded border-gray-300 text-(--color-primary) focus:ring-(--color-primary)"
                                                {{ old("features.$index.medium_value", $feature->medium_value) == '1' ? 'checked' : '' }}>
                                            <span class="text-sm font-medium text-(--color-text)">Medium Tier</span>
                                        </label>

                                        <!-- Large -->
                                        <label
                                            class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                            <input type="hidden" name="features[{{ $index }}][large_value]"
                                                value="0">
                                            <input type="checkbox" name="features[{{ $index }}][large_value]"
                                                value="1"
                                                class="w-5 h-5 rounded border-gray-300 text-(--color-primary) focus:ring-(--color-primary)"
                                                {{ old("features.$index.large_value", $feature->large_value) == '1' ? 'checked' : '' }}>
                                            <span class="text-sm font-medium text-(--color-text)">Large Tier</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Remove -->
                                <button type="button"
                                    class="remove-feature-btn absolute top-5 right-5 text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fa-solid fa-trash-can text-xl"></i>
                                </button>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- Submit -->
                <div class="sm:px-6 sm:py-6 px-3 py-3 border-t mt-10">
                    <button type="submit"
                        class="bg-(--color-secondary) cursor-pointer px-6 py-3 text-white rounded-md hover:bg-(--color-primary) font-semibold">
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
                const $row = $(this).closest('.feature-row');
                const $textContainer = $row.find('.text-values');
                const $checkboxContainer = $row.find('.checkbox-values');
                const $label = $row.find('.value-container > label:first');

                if ($(this).val() === 'checkbox') {
                    $textContainer.addClass('hidden');
                    $checkboxContainer.removeClass('hidden');
                    $label.text('Included in tiers');
                } else {
                    $textContainer.removeClass('hidden');
                    $checkboxContainer.addClass('hidden');
                    $label.text('Value per tier');
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
                            <input type="text" name="features[\${featureIndex}][feature]"
                                   class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) outline-none px-4 py-2.5 text-base"
                                   placeholder="e.g. Custom Domain, Priority Support, SEO Optimization" required>
                        </div>

                        <div class="w-full sm:w-64">
                            <label class="block mb-2 text-sm font-medium text-(--color-text)">Display Type</label>
                            <select name="features[\${featureIndex}][type]" class="feature-type-select rounded-lg w-full border border-gray-300 focus:border-(--color-primary) outline-none px-4 py-2.5 text-base">
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
                                <input type="text" name="features[\${featureIndex}][small_value]"
                                       class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                       placeholder="e.g. 5 GB, Basic, 1 Website">
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500 mb-1.5 font-medium">Medium Tier</span>
                                <input type="text" name="features[\${featureIndex}][medium_value]"
                                       class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                       placeholder="e.g. 20 GB, Standard, 5 Websites">
                            </div>
                            <div>
                                <span class="block text-xs text-gray-500 mb-1.5 font-medium">Large Tier</span>
                                <input type="text" name="features[\${featureIndex}][large_value]"
                                       class="rounded-lg w-full border border-gray-300 focus:border-(--color-primary) px-4 py-2.5 text-sm"
                                       placeholder="e.g. Unlimited, Premium, Unlimited Websites">
                            </div>
                        </div>

                        <!-- Checkboxes (hidden by default) -->
                        <div class="checkbox-values hidden grid grid-cols-1 sm:grid-cols-3 gap-5">

                            <label class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                <input type="hidden" name="features[\${featureIndex}][small_value]" value="0">
                                <input type="checkbox" name="features[\${featureIndex}][small_value]" value="1"
                                       class="w-5 h-5 rounded border-gray-300 text-(--color-primary) focus:ring-(--color-primary)">
                                <span class="text-sm font-medium text-(--color-text)">Small Tier</span>
                            </label>

                            <label class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                <input type="hidden" name="features[\${featureIndex}][medium_value]" value="0">
                                <input type="checkbox" name="features[\${featureIndex}][medium_value]" value="1"
                                       class="w-5 h-5 rounded border-gray-300 text-(--color-primary) focus:ring-(--color-primary)">
                                <span class="text-sm font-medium text-(--color-text)">Medium Tier</span>
                            </label>

                            <label class="feature-checkbox-label flex items-center gap-3 cursor-pointer select-none py-2 px-3 rounded-md hover:bg-(--color-primary-100)/50 transition-colors">
                                <input type="hidden" name="features[\${featureIndex}][large_value]" value="0">
                                <input type="checkbox" name="features[\${featureIndex}][large_value]" value="1"
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
