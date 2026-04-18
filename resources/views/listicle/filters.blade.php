<form method="GET" action="{{ route('services.companies', ['serviceSlug' => $service->slug]) }}">
    <div class="filter-section relative flex flex-wrap  gap-x-2 text-white">
        {{-- LOCATION  --}}
        <div
            class="input-wrapper focus-within:border-lime-600 flex  text-sm items-center gap-2 border border-(--color-border) p-2 rounded-full">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
                viewBox="0 0 24 24">
                <path class="fill-gray-600/50"
                    d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm1.476 14.955c.988-.405 1.757-1.211 2.116-2.216l2.408-6.739-6.672 2.387c-1.006.36-1.811 1.131-2.216 2.119l-3.065 7.494 7.429-3.045zm-.122-4.286c.551.551.551 1.446 0 1.996-.551.551-1.445.551-1.996 0-.551-.55-.551-1.445 0-1.996.551-.551 1.445-.551 1.996 0z" />
            </svg>
            <input type="text" name="location" placeholder="Location" value="{{ request('location') }}"
                class="placeholder:text-gray-400 text-(--color-text) focus outline-0 border-0 ">
        </div>
        <button id="openFilters" type="button" class="xl:hidden btn-primary text-white px-4 py-2 rounded-md">
            Filters
        </button>
        <div class="filters">
            <div class="flex justify-between items-center xl:hidden">
                <span class="text-(--color-secondary) font-bold text-lg pl-2">
                    Filters
                </span>

                <button id="closeFilters" type="button" class="p-2 rounded-md hover:bg-gray-200/20">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            {{-- ! SERVICES   --}}
            <div class="relative filter-item">
                <button type="button" class="filter-btn">Services
                    <i class="fa-solid fa-chevron-down text-xs ml-1 text-(--color-text)/70"></i>
                </button>

                <div
                    class="filter-dropdown hidden absolute top-full left-0  mt-2 bg-(--color-surface) text-(--color-text) rounded-md shadow-lg py-2 z-50 w-max border-2 border-(--color-border)">
                    <div class="px-3">
                        <input type="text" placeholder="Search services"
                            class="service-search px-3 py-1 focus:border-lime-700 outline-none w-full border border-(--color-border) rounded mb-2 ">
                    </div>
                    <div class="max-h-60 overflow-y-auto py-1 [&>label]:px-3 ">
                        @foreach ($services as $service)
                            <label
                                class="flex gap-x-5 mb-1 service-option  md:text-nowrap hover:bg-lime-600/20 cursor-pointer mt-2"
                                data-label="{{ $service->name }}">
                                <input type="checkbox" name="services[]" value="{{ $service->name }}"
                                    class="filter-checkbox accent-lime-600"
                                    {{ in_array($service->name, request()->get('services', [])) ? 'checked' : '' }}>
                                <span>{{ $service->name }}</span>
                                <span class="text-(--color-text-muted)">({{ $service->companies_count }})</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ! BUDGET  --}}
            <div class="relative filter-item">
                <button type="button" class="filter-btn">Budget
                    <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                </button>
                <div
                    class="filter-dropdown hidden absolute top-full left-0 mt-2 w-48 bg-(--color-surface)  rounded-md shadow-lg py-2 px-1 z-50 text-(--color-text) border-2 border-(--color-border)">
                    @php
                        $budgets = config('company.project_sizes');
                    @endphp
                    @foreach ($budgets as $val => $label)
                        <label class="flex justify-between items-center mb-1 px-2 py-1 rounded-md cursor-pointer">
                            <input type="radio" name="budget" value="{{ $val }}" class="filter-radio ml-2"
                                {{ request('budget') == $val ? 'checked' : '' }}>
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- ! HOURLY RATES --}}
            <div class="relative filter-item">
                <button type="button" class="filter-btn">Hourly Rates
                    <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                </button>
                <div
                    class="filter-dropdown hidden absolute top-full left-0 mt-2 w-36 font-semibold bg-(--color-surface) text-(--color-text) rounded-md shadow-lg py-2 px-1 z-50 border-2 border-(--color-border)">
                    @php
                        $hourlies = config('company.hourly_rates');
                    @endphp
                    @foreach ($hourlies as $val => $label)
                        <label class="flex justify-between items-center mb-1 px-2 py-1 rounded-md cursor-pointer">
                            <input type="radio" name="hourly" value="{{ $val }}"
                                class="filter-radio ml-2 text-gray-600"
                                {{ request('hourly') == $val ? 'checked' : '' }}>
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-lime-800 text-sm px-4 py-2 rounded-md hover:bg-lime-600 text-white">Apply
                Filters
            </button>

        </div>
        <div class="filter-overlay"></div>
    </div>

    {{-- SELECTED FILTERS CHIPS  --}}
    <div id="selected-filters" class="inline-flex flex-wrap gap-2 mt-4">
        @php
            $allChips = [];
            if (request()->get('services')) {
                $allChips = array_merge(
                    $allChips,
                    array_map(
                        fn($v) => ['name' => 'services', 'value' => $v, 'label' => $v],
                        request()->get('services'),
                    ),
                );
            }
            if (request()->get('budget')) {
                $value = request('budget');
                $allChips[] = ['name' => 'budget', 'value' => $value, 'label' => $budgets[$value] ?? $value];
            }
            if (request()->get('hourly')) {
                $value = request('hourly');
                $allChips[] = ['name' => 'hourly', 'value' => $value, 'label' => $hourlies[$value]];
            }

        @endphp

        @foreach ($allChips as $index => $chip)
            <span
                class="filter-chip text-lime-700 text-xs font-bold border-2 border-lime-800 px-3 py-1 rounded-md flex items-center gap-2 @if ($index >= 5) hidden extra-chip @endif">
                {{ $chip['label'] }}
                <span class="remove-chip cursor-pointer text-lime-700 font-bold" data-name="{{ $chip['name'] }}"
                    data-value="{{ $chip['value'] }}">&times;</span>
            </span>
        @endforeach

        @if (count($allChips) > 5)
            <span id="toggle-chips" class="cursor-pointer text-lime-500 ml-2">+{{ count($allChips) - 5 }} more</span>
        @endif
    </div>

    @if (request()->filled('services') ||
            request()->filled('budget') ||
            request()->filled('hourly') ||
            request()->filled('location'))
        <a href="{{ url()->current() }}" class="text-(--color-primary) text-xs font-semibold  mx-2 inline">Clear
            All</a>
    @endif
</form>
