  <div class="section flex lg:flex-row flex-col gap-3">
      <div class="sub-section flex-1 ">
          <h2 class="test text-2xl sm:text-3xl font-bold mb-2">{{ $company->tagline }}</h2>
          <p class="line-clamp-5 mb-2 text-sm md:text-base">{!! $company->about !!}</p>
          <div
              class="grid [&>span]:border-2 [&>span]:border-(--color-border) [&>span]:bg-(--color-surface) [&>span]:rounded-md gap-4 overflow-hidden md:grid-cols-3 grid-cols-2 mt-4 ">
              <span class="md:px-5 md:py-3 px-2 py-2 detail-bx">
                  <i class="fa-solid fa-tag mb-2"></i>
                  <p class="text-(--color-text-muted) font-medium text-sm ">Min Project Size</p>
                  <p class="text-nowrap md:text-xl text-lg font-semibold">${{ $company->details->min_project_size }}
                  </p>
              </span>
              <span class="md:px-5 md:py-3 px-2 py-2 detail-bx">
                  <i class="fa-solid fa-clock mb-2"></i>
                  <p class="text-(--color-text-muted) font-medium text-sm ">Hourly rate</p>
                  <p class="text-nowrap md:text-xl text-lg font-semibold">${{ $company->details->hourly_rate }}</p>
              </span>
              <span class="md:px-5 md:py-3 px-2 py-2 detail-bx">
                  <i class="fa-solid fa-users mb-2"></i>
                  <p class="text-(--color-text-muted) font-medium text-sm ">Employees</p>
                  <p class="text-nowrap md:text-xl text-lg font-semibold">{{ $company->details->employees }} </p>
              </span>

              <span class="md:px-5 md:py-3 px-2 py-2 detail-bx">
                  <i class="fa-solid fa-flag mb-2"></i>
                  <p class="text-(--color-text-muted) font-medium text-sm ">Year founded</p>
                  <p class="text-nowrap md:text-xl text-lg font-semibold">{{ $company->details->founded }} </p>
              </span>
              <span class="md:px-5 md:py-3 px-2 py-2 detail-bx">
                  <i class="fa-solid fa-globe mb-2"></i>
                  <p class="text-(--color-text-muted) font-medium text-sm ">Languages</p>
                  <p class="text-nowrap md:text-xl text-lg font-semibold"> {{ $company->details->total_languages }}
                  </p>
              </span>
              <span class="md:px-5 md:py-3 px-2 py-2 detail-bx">
                  <i class="fa-regular fa-calendar mb-2"></i>
                  <p class="text-(--color-text-muted) font-medium text-sm ">Years In Business</p>
                  <p class="text-nowrap md:text-xl text-lg font-semibold">
                      {{ $company->details->years_in_business }}+ </p>
              </span>
          </div>
      </div>
      <div class="sub-section flex-[.9] bg-(--color-surface) lg:px-4 lg:py-4 py-2 border-2 border-(--color-border) rounded-md">
          <div id="myChart" class="w-full"></div>
      </div>
  </div>
