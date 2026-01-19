<form method="GET" action="{{ route('services.companies', ['serviceSlug' => $service->slug]) }}">
    <div class="filter-section flex flex-wrap gap-2 text-white">

        {{-- LOCATION  --}}
        <div class="input-wrapper focus-within:border-lime-600 flex text-sm items-center gap-2 border border-gray-800/30 p-2 rounded-full">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
                viewBox="0 0 24 24">
                <path class="fill-gray-600/50"
                    d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm1.476 14.955c.988-.405 1.757-1.211 2.116-2.216l2.408-6.739-6.672 2.387c-1.006.36-1.811 1.131-2.216 2.119l-3.065 7.494 7.429-3.045zm-.122-4.286c.551.551.551 1.446 0 1.996-.551.551-1.445.551-1.996 0-.551-.55-.551-1.445 0-1.996.551-.551 1.445-.551 1.996 0z" />
            </svg>
            <input type="text" name="location" placeholder="Location" value="{{ request('location') }}"
                class="placeholder:text-gray-400 text-gray-800 focus outline-0 border-0 ">
        </div>

       {{-- SERVICES   --}}
        <div class="relative filter-item">
            <button type="button" class="filter-btn">Services
              <i class="fa-solid fa-chevron-down text-xs ml-1 text-gray-800/70"></i>
            </button>

            <div
                class="filter-dropdown hidden absolute top-full left-0 mt-2 bg-white text-gray-600 rounded-md shadow-lg py-2 z-50">
                <div class="px-3">
                    <input type="text" placeholder="Search services"
                        class="service-search px-3 py-1 focus:border-lime-700 outline-none w-full border border-gray-500/50 rounded mb-2 ">
                </div>
                <div class="max-h-60 overflow-y-auto py-1 [&>label]:px-3 ">
                    @foreach ($navCategories as $category)
                        @foreach ($category->services as $service)
                            <label
                                class="flex gap-x-5 mb-1 service-option text-nowrap hover:bg-lime-600/20 cursor-pointer mt-2"
                                data-label="{{ $service->name }}">
                                <input type="checkbox" name="services[]" value="{{ $service->name }}"
                                    class="filter-checkbox accent-lime-600"
                                    {{ in_array($service->name, request()->get('services', [])) ? 'checked' : '' }}>
                                <span>{{ $service->name }}</span>
                                {{-- <span class="text-gray-500">({{ $service->count ?? 0 }})</span> --}}
                            </label>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

         {{-- BUDGET  --}}
        <div class="relative filter-item">
            <button type="button" class="filter-btn">Budget
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>
            <div
                class="filter-dropdown hidden absolute top-full left-0 mt-2 w-48 bg-white  rounded-md shadow-lg p-2 z-50 text-gray-600">
                @php
                    $budgets = ['50k' => 'Under $50k', '100k' => '$50k - $100k', '100k+' => '$100k+'];
                @endphp
                @foreach ($budgets as $val => $label)
                    <label class="flex justify-between items-center mb-1">
                        <input type="radio" name="budget" value="{{ $val }}" class="filter-radio ml-2"
                            {{ request('budget') == $val ? 'checked' : '' }}>
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>

      {{-- HOURLY RATES --}}
        <div class="relative filter-item">
            <button type="button" class="filter-btn">Hourly Rates
              <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>
            <div
                class="filter-dropdown hidden absolute top-full left-0 mt-2 w-36 font-semibold bg-white text-gray-600 rounded-md shadow-lg text-sm py-2 z-50">
                @php
                    $hourlies = [ '<25' => '< $25', '20-50' => '$20 - $50', '50-99' => '$50 - $99', '100-149' => '$100 - $149', '150-199' => '$150 - $199', '200-300' => '$200 - $300', '300' => '$300'];
                @endphp
                @foreach ($hourlies as $val => $label)
                    <label class="flex justify-between items-center mb-1 px-4 py-1 cursor-pointer">
                        <input type="radio" name="hourly" value="{{ $val }}" class="filter-radio ml-2 text-gray-600"
                            {{ request('hourly') == $val ? 'checked' : '' }}>
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>
{{-- 
        <div class="relative filter-item">
            <button type="button" class="filter-btn">Industry
              <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>
            <div
                class="filter-dropdown hidden absolute top-full left-0 mt-2 w-56 bg-white text-black rounded-md shadow-lg p-2 z-50">
                @php $industries = ['IT', 'Finance', 'Design']; @endphp
                @foreach ($industries as $industry)
                    <label class="flex justify-between items-center mb-1 industry-option"
                        data-label="{{ $industry }}">
                        <span>{{ $industry }}</span>
                        <input type="checkbox" name="industries[]" value="{{ $industry }}"
                            class="filter-checkbox ml-2"
                            {{ in_array($industry, request()->get('industries', [])) ? 'checked' : '' }}>
                    </label>
                @endforeach
            </div>
        </div> --}}

        <button type="submit" class="bg-lime-800 text-sm px-4 py-2 rounded-md hover:bg-lime-600 text-white">Apply
            Filters</button>
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
                $allChips[] = ['name' => 'budget', 'value' => request('budget'), 'label' => request('budget')];
            }
            if (request()->get('hourly')) {
                $allChips[] = ['name' => 'hourly', 'value' => request('hourly'), 'label' => request('hourly')];
            }
            if (request()->get('industries')) {
                $allChips = array_merge(
                    $allChips,
                    array_map(
                        fn($v) => ['name' => 'industries', 'value' => $v, 'label' => $v],
                        request()->get('industries'),
                    ),
                );
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
            request()->filled('industries') ||
            request()->filled('location'))
        <a href="{{ url()->current() }}"
            class="text-lime-900 text-sm underline mx-2 inline">Clear All</a>
    @endif
</form>
