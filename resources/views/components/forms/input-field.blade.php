@props([
    'name',
    'label'       => null,
    'type'        => 'text',
    'placeholder' => '',
    'icon'        => null,
    'iconType'    => 'solid',   
    'disabled' => false,
    'value'       => '',
    'readonly'    => false,
    'muted'       => false,
    'options'     => [],       
    'selected'    => null,  
])

<div {{ $attributes->only('class')->merge(['class' => 'inp-field w-full']) }}>

    @if($label)
        <label for="{{ $name }}" class="block mb-2 text-sm text-(--color-text)">{{ $label }}</label>
    @endif

    @if($type === 'textarea')
        {{ $slot }}

    @else
        <span class="relative flex items-center h-11">
            @if($icon)
                <i class="fa-{{ $iconType }} fa-{{ $icon }} absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none z-10"></i>
            @endif

            @if($type === 'select')
                <select
                    name="{{ $name }}"
                    id="{{ $name }}"
                    {{ $disabled ? 'disabled' : '' }}
                    {{ $attributes->except(['class'])->merge([]) }}
                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none  pr-4 bg-(--color-background) text-(--color-text) {{ $icon ? 'pl-10' : 'pl-4' }} {{ $errors->has($name) ? 'invalid-input' : '' }}"
                >
                    {{ $slot }}
                </select>

            @else
                <input
                    type="{{ $type }}"
                    name="{{ $name }}"
                    id="{{ $name }}"
                    placeholder="{{ $placeholder }}"
                    value="{{ old($name, $value) }}"
                    {{ $readonly ? 'readonly' : '' }}
                    {{ $attributes->except(['class'])->merge([]) }}
                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 py-3 pr-4 {{ $icon ? 'pl-10' : 'pl-4' }} {{ $muted ? 'text-(--color-muted)' : '' }} {{ $errors->has($name) ? 'invalid-input' : '' }}"
                >
            @endif
        </span>
    @endif

    @error($name)
        <span class="error">
            <i class="fa-solid fa-circle-exclamation error-icon"></i>
            <p class="error-text">{{ $message }}</p>
        </span>
    @enderror

</div>