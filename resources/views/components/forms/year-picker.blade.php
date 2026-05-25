@props([
    'name',
    'label', 
    'value' => '',
    'icon'  => 'calendar',
])

<div class="inp-field w-full">
    <label class="block mb-2 text-sm text-(--color-text)">{{ $label }}</label>
    <span class="relative flex items-center h-11">
        <i class="fa-solid fa-{{ $icon }} absolute left-3 text-gray-400 pointer-events-none"></i>
        <select name="{{ $name }}" id="{{ $name }}"
            {{ $attributes->merge(['class' => 'rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-10 pr-4  bg-(--color-background) text-(--color-text) ' . ($errors->has($name) ? 'invalid-input' : '')]) }}>
            <option value="">Select Year</option>
            @for($year = date('Y'); $year >= 1900; $year--)
                <option value="{{ $year }}" {{ old($name, $value) == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endfor
        </select>
    </span>
    @error($name)
        <span class="error">
            <i class="fa-solid fa-circle-exclamation error-icon"></i>
            <p class="error-text">{{ $message }}</p>
        </span>
    @enderror
</div>