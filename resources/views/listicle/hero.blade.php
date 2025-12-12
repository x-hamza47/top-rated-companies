  {{-- <div
        class="section max-[840px]:flex-col max-w-[1920px] w-full flex justify-between gap-4 mt-32 md:px-10 md:py-4 lg:px-12 lg:py-6 sm:px-7 sm:py-5 p-4"> --}}
  <div class="section md:pt-32 pt-25 pb-20 flex flex-col justify-between text-white gap-y-5">
      <div class="flex flex-col lg:flex-row items-center lg:items-start gap-y-4">
          <div class="flex flex-col items-center lg:items-start gap-4 lg:text-start text-center flex-1">
              <h1 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl font-bold w-full  max-w-[900px] ">
                  Top <span class="text-lime-600"> {{ $service->name }} </span> Companies
              </h1>
              <p class="md:leading-6 leading-5  font-semibold text-gray-300 md:text-base text-sm  max-w-[900px] ">
                  {{ $service->description ?? 'Explore top companies providing ' . $service->name . ' services.' }}
              </p>
          </div>
          <div class="sub-section">
              <h3 class="sm:text-4xl text-2xl  text-lime-600 font-semibold text-nowrap"
                  data-target="{{ $service->companies->count() }}" id="companyCount">
                  0+ Companies
              </h3>
          </div>
      </div>
      {{-- ! Hero Section Quick Links --}}
      <div
          class="flex flex-wrap justify-center lg:justify-start gap-x-7 gap-y-2 text-gray-300 font-semibold text-xs sm:text-base">
          @forelse ($relatedServices as $relService)
              <a href="{{ route('services.companies', $relService->slug) }}"
                  class="flex gap-2 hover:text-lime-500 transition border border-gray-300 md:px-4 md:py-2 px-2 py-1.5 rounded-full hover:border-lime-500">
                  {{ $relService->name }}
                  <svg class="md:w-5.5 md:h-5.5 w-4.5 h-4.5" viewBox="0 0 48 48" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M14 34L34 14M34 14H14M34 14V34" stroke="currentColor" stroke-width="5"
                          stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
              </a>
          @empty
              <p class="text-gray-400 italic">No related services found.</p>
          @endforelse
      </div>
  </div>
