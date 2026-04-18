<div class="section md:pt-32  pt-25 pb-20 flex items-center flex-wrap gap-y-6 lg:flex-row flex-col text-white">
    <div class="flex flex-col items-center lg:items-start gap-4 lg:text-start text-center flex-1 ">
        <h1 class="text-3xl sm:text-4xl md:text-5xl  max-w-[900px] font-bold">
            Connect with Top-Rated Companies for <span class="text-lime-700">Development</span>,
            <span class="text-lime-700">Design</span>,
            <span class="text-lime-700">Marketing</span> & Beyond
        </h1>
        <p
            class="w-full md:leading-6 leading-5 max-w-[900px] font-semibold text-gray-300 md:text-base text-sm [&>strong]:font-bold">
            At Top Firms Reviewer, we simplify your search for credible, experienced, and dependable companies across
            <strong>development</strong>, <strong>design</strong>, <strong>marketing</strong>, <strong>SEO</strong>,
            <strong>video production</strong>, and other professional services. Explore detailed profiles, read verified
            reviews, and choose your next business partner with confidence and clarity.
        </p>
        {{-- !Search Box --}}
        <form id="serviceSearchForm" class="md:w-4/5 lg:w-4/5 w-full" action="/companies" method="GET">
            <div class="flex items-center  bg-(--color-background) rounded-md md:h-11 h-9 py-0.5 px-0.5">
                <div class="flex flex-col flex-1 h-full relative">
                    <div
                        class="flex flex-1 items-center md:px-3 px-1 gap-2 bg-(--color-background) border-gray-500/30 h-full rounded-md overflow-hidden">
                        <input type="text" placeholder="Service you need" id="serviceInput" name="q"
                            class="peer w-full h-full outline-none text-(--color-text) placeholder-gray-500 md:text-sm text-xs"
                            autocomplete="off">
                        <i class="fa-solid fa-chevron-down text-gray-400 text-[10px] sm:text-base"></i>
                        <div id="serviceDropdown"
                            class="search-dropdown absolute top-full left-0 right-0 mt-1.5 py-2 bg-(--color-background) border border-gray-500/30 rounded-md shadow max-h-[200px] overflow-y-auto hidden z-40 text-left">
                            <p class="text-xs pb-2 text-(--color-text-muted)/80 sm:px-4 px-2">Services <small
                                    class="text-lime-600 float-right">{{ $services->count() }}+</small></p>
                            @forelse ($services as $service)
                                <p class="service-item text-sm text-(--color-text) py-2 hover:bg-(--color-primary-hover)/80 cursor-pointer sm:px-4 px-2 not-last:border-b-2 border-b-gray-500/20"
                                    data-slug="{{ $service->slug }}">
                                    {{ $service->name }}
                                </p>
                            @empty
                                <p
                                    class="text-sm text-gray-600 py-1 hover:bg-lime-200/80 cursor-pointer sm:px-4 px-2 text-nowrap">
                                    No service found.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <button
                    class="bg-lime-700 md:px-3 px-2 hover:bg-lime-600 rounded-md text-sm md:text-lg h-full scale-x-[-1] flex items-center cursor-pointer active:shadow-[inset_0_0_20px_rgba(0,0,0,0.3)]">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
        <div class="flex gap-2 md:justify-start justify-center flex-wrap">
            <x-service-tag slug="graphic-design" icon="fa-palette" label="Graphic Designs" />

            <x-service-tag slug="web-development" icon="fa-code " label="Web Development" />

            <x-service-tag slug="seo" icon="fa-chart-line" label="SEO" />

            <x-service-tag slug="video-production" icon="fa-film" label="Video Editing" />

            <x-service-tag slug="web-design" icon="fa-paintbrush" label="Website Designing" />
        </div>
    </div>
    {{-- ! Hero Image --}}
    <div class="flex-2/5 min-w-[200px] max-w-[500px] ">
        <img src="{{ asset('images/illustration.png') }}"
            alt="Software development, marketing, and consulting illustration"
            class="w-full h-full drop-shadow-[0_50px_20px_rgba(0,0,0,1)] hover:drop-shadow-transparent hover:scale-[0.99]">
    </div>
</div>
