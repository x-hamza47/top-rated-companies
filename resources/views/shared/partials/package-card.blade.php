<div
    class="border border-zinc-200 rounded-2xl p-6 flex flex-col items-start max-w-md transition duration-300 hover:-translate-y-1 hover:border-lime-700">

    {{-- Package title (tier) --}}
    <h1 class="font-medium text-3xl text-slate-800 mt-1 capitalize">
        {{ ucfirst($tier) }}
    </h1>

    {{-- Service name --}}
    <p class="text-sm text-zinc-500 mt-2">
        {{ $package->service->name }}
    </p>

    {{-- Price --}}
    <h1 class="font-medium text-5xl text-slate-800 mt-6">
        ${{ number_format($package->{$tier . '_price'}, 0) }}
        <span class="text-base text-zinc-500">/ {{ $package->price_type }}</span>
    </h1>

    {{-- CTA --}}
    <button
        class="w-full border border-zinc-300/80 px-4 py-3 rounded-full cursor-pointer text-slate-600 text-sm mt-8 bg-lime-100 hover:bg-lime-700/70 hover:text-white">
        Get Started
    </button>

    {{-- Features --}}
    <div class="w-full mt-8 space-y-2.5 pb-4">
        @foreach ($package->features as $feature)
            <p class="flex items-start gap-3 text-sm text-zinc-500">
                <span
                    class="size-3 mt-1 rounded-full {{ $feature->type !== 'checkbox' ? 'bg-zinc-300' : '' }} flex items-center justify-center shrink-0">
                    @if ($feature->type === 'checkbox')
                        @if ($feature->{$tier . '_value'})
                            <i class="fa-solid fa-check text-lime-700"></i>
                        @else
                            <i class="fa-solid fa-x text-red-500"></i>
                        @endif
                    @else
                        <span class="size-1.5 rounded-full bg-lime-700">
                        </span>
                    @endif
                </span>

                {{-- Feature text --}}
                <span
                    class="{{ $feature->type === 'checkbox' && !$feature->{$tier . '_value'} ? 'line-through text-zinc-400' : '' }}">
                    {{ $feature->feature }}


                    @if ($feature->type === 'text' && $feature->{$tier . '_value'})
                        <span class="block text-xs text-zinc-400">
                            {{ $feature->{$tier . '_value'} }}
                        </span>
                    @endif
                </span>
            </p>
        @endforeach
    </div>
</div>
