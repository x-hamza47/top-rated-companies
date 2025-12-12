<div class="section md:pt-32  pt-25 pb-20 flex items-center flex-wrap gap-y-6 lg:flex-row flex-col text-white">
    <div class="flex flex-col items-center lg:items-start gap-4 lg:text-start text-center flex-1 ">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl max-w-[900px] font-bold ">
            Where <span class="text-lime-700">Businesses</span>
            Meet Their Ideal Development
            <span class="text-lime-700">Partners</span>
        </h1>
        <p class="w-full md:leading-6 leading-5 max-w-[900px] font-semibold text-gray-300 md:text-base text-sm">At
            topratedcompanies, we cut through market
            noise
            and simplify
            your
            search with curating
            credible, experienced, and dependable companies.
            Explore comprehensive profiles and choose your next partner with clarity and confidence.
        </p>
        <p class=" w-full max-w-[900px] font-semibold text-gray-300 md:text-base text-sm">Explore comprehensive profiles
            and choose your next
            partner
            with
            clarity and confidence.
        </p>
        {{-- !Search Box --}}
        <div class="flex items-center md:w-4/5 lg:w-4/5 w-full bg-white rounded-md md:h-11 h-9 py-0.5 px-0.5">
            <div class="flex flex-col flex-1 h-full relative">
                <div
                    class="flex flex-1 items-center md:px-3 px-1 gap-2 bg-white border-gray-500/30 h-full rounded-md overflow-hidden">
                    <input type="text" placeholder="Service you need"
                        class="peer w-full h-full outline-none text-gray-700 placeholder-gray-500 md:text-sm text-xs">
                    <i class="fa-solid fa-chevron-down  text-gray-400 text-[10px] sm:text-base"></i>
                    <div
                        class="absolute top-full left-0 right-0 mt-1.5 py-2 bg-white border border-gray-500/30 rounded-md overflow-hidden opacity-0 invisible transition-all duration-200 peer-focus:opacity-100 peer-focus:visible z-40 shadow text-start max-h-[200px] overflow-y-auto w-full">
                        <h5 class="text-xs pb-2 text-gray-900/80 sm:px-4 px-2">Services <small class="text-lime-600 float-right">{{ $services->count()}}+</small></h5>
                        @forelse ($services as $service)
                            <p class="text-sm text-gray-600 py-2 hover:bg-lime-200/80 cursor-pointer sm:px-4 px-2 not-last:border-b-2 border-b-gray-500/20">
                                {{ $service->name }}
                            </p>
                        @empty
                            <p class="text-sm text-gray-600 py-1 hover:bg-lime-200/80 cursor-pointer sm:px-4 px-2 text-nowrap">
                                No service found.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
            <span class="flex-1 h-full">
                <div class="flex flex-col gap-4  w-full h-full relative">
                    <div
                        class="flex items-center md:px-3 px-1.5  bg-white border-gray-500/30 h-full rounded-md overflow-hidden ">
                        <input type="text" placeholder="Where do u live"
                            class="peer w-full h-full outline-none text-gray-700 placeholder-gray-500 md:text-sm text-xs">
                        <i class="fa-solid fa-chevron-down  text-gray-400 text-[10px] sm:text-base"></i>

                        <div
                            class="absolute top-full left-0 right-0 mt-1.5 py-2 bg-white border border-gray-500/30 rounded-md overflow-hidden opacity-0 invisible transition-all duration-200 peer-focus:opacity-100 peer-focus:visible z-40 shadow text-start max-h-[200px] overflow-y-auto w-full">
                            <h5 class="text-xs pb-2 text-gray-800/80 sm:px-4 px-2">Search Result</h5>
                            <p class="text-sm text-gray-600 py-1 hover:bg-lime-200/80 cursor-pointer sm:px-4 px-2">India
                            </p>
                            <p class="text-sm text-gray-600 py-1 hover:bg-lime-200/80 cursor-pointer sm:px-4 px-2">
                                Indonesia</p>
                            <p class="text-sm text-gray-600 py-1 hover:bg-lime-200/80 cursor-pointer sm:px-4 px-2">Iran
                            </p>
                        </div>
                    </div>
                </div>
            </span>

            <button
                class="bg-lime-700 md:px-3 px-2 hover:bg-lime-600 rounded-md text-sm md:text-lg h-full scale-x-[-1] flex items-center cursor-pointer active:shadow-[inset_0_0_20px_rgba(0,0,0,0.3)]">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <div class="flex gap-2 md:justify-start justify-center flex-wrap">
            <a href="{{ route('services.companies', ['serviceSlug' => 'graphic-design']) }}"
                class="bg-lime-950 text-gray-300 flex justify-center hover:bg-lime-900 items-center gap-1 text-sm px-2.5 py-1.5 font-medium rounded-md cursor-pointer">
                <i class="fa-solid fa-palette  "></i>
                <small>Graphic Designs</small>
            </a>
            <a href="{{ route('services.companies', ['serviceSlug' => 'web-development']) }}"
                class="bg-lime-950 text-gray-300 flex justify-center hover:bg-lime-900 items-center gap-2 text-sm px-2.5 py-1.5 font-medium rounded-md cursor-pointer">

                <i class="fa-solid fa-code  "></i>
                <small>Web Development</small>

            </a>
            <a href="{{ route('services.companies', ['serviceSlug' => 'seo']) }}"
                class="bg-lime-950 text-gray-300 flex justify-center hover:bg-lime-900 items-center gap-2 text-sm px-2.5 py-1.5 font-medium rounded-md cursor-pointer">


                <i class="fa-solid fa-chart-line  "></i>
                <small>SEO</small>

            </a>
            <a href="{{ route('services.companies', ['serviceSlug' => 'video-production']) }}"
                class="bg-lime-950 text-gray-300 flex justify-center hover:bg-lime-900 items-center gap-2 text-sm px-2.5 py-1.5 font-medium rounded-md cursor-pointer">


                <i class="fa-solid fa-film  "></i>
                <small>Video Editing</small>
            </a>
            <a href="{{ route('services.companies', ['serviceSlug' => 'web-design']) }}"
                class="bg-lime-950 text-gray-300 flex justify-center hover:bg-lime-900 items-center gap-2 text-sm px-2.5 py-1.5 font-medium rounded-md cursor-pointer">


                <i class="fa-solid fa-paintbrush  "></i>
                <small>Website Designing</small>

            </a>
        </div>
    </div>
    {{-- ! Hero Image --}}
    <div class="flex-2/5 min-w-[200px] max-w-[500px] ">
        <img src="{{ asset('images/illustration.png') }}" alt="Team Meeting illustration"
            class="w-full h-full drop-shadow-[0_50px_20px_rgba(0,0,0,1)] hover:drop-shadow-transparent hover:scale-[0.99]">
    </div>
</div>
