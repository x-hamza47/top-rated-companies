  <div class="section flex lg:flex-row flex-col gap-3">
        <div class="sub-section flex-1 ">
            <h2 class="test text-2xl sm:text-3xl font-bold mb-2">{{ $company->tagline }}</h2>
            <p class="line-clamp-5 mb-2">{{ $company->about }}</p>
            <div
                class="bg-lime-900/20 grid rounded-md overflow-hidden md:grid-cols-3 grid-cols-2 mt-4 divide-x divide-y divide-lime-900/30 md:[&>span:nth-of-type(3n)]:border-r-0 ">
                <span class="md:px-5 md:py-3 px-2 py-2">
                    <h6 class="text-lime-950 font-medium text-sm mb-2">Min Project Size</h6>
                    <span class="flex gap-x-2 items-center">
                        <svg class="md:w-6 md:h-6 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" viewBox="0 0 24 24"
                            clip-rule="evenodd">
                            <path
                                d="M14.101 24l-14.101-14.105v-9.895h9.855l14.145 14.101c-3.3 3.299-6.6 6.599-9.899 9.899zm-4.659-23h-8.442v8.481l13.101 13.105 8.484-8.484c-4.381-4.368-8.762-8.735-13.143-13.102zm-1.702 3.204c.975.976.975 2.56 0 3.536-.976.975-2.56.975-3.536 0-.976-.976-.976-2.56 0-3.536s2.56-.976 3.536 0zm-.708.707c.586.586.586 1.536 0 2.121-.585.586-1.535.586-2.121 0-.585-.585-.585-1.535 0-2.121.586-.585 1.536-.585 2.121 0z" />
                        </svg>
                        <p class="text-nowrap md:text-2xl text-lg font-semibold">{{ $company->details->min_project_size }}
                        </p>
                    </span>
                </span>

                <span class="md:px-5 md:py-3 px-2 py-2">
                    <h6 class="text-lime-950 font-medium text-sm mb-2">Hourly rate</h6>
                    <span class="flex gap-x-2 items-center">
                        <svg class="md:w-6 md:h-6 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" viewBox="0 0 24 24"
                            clip-rule="evenodd">
                            <path
                                d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 11h6v1h-7v-9h1v8z" />
                        </svg>
                        <p class="text-nowrap md:text-2xl text-lg font-semibold">{{ $company->details->hourly_rate }}</p>
                    </span>
                </span>
                <span class="md:px-5 md:py-3 px-2 py-2">
                    <h6 class="text-lime-950 font-medium text-sm mb-2">Employees</h6>
                    <span class="flex gap-x-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="md:w-6 md:h-6 w-4 h-4" viewBox="0 0 24 24">
                            <path
                                d="M10.119 16.064c2.293-.53 4.427-.994 3.394-2.946-3.147-5.941-.835-9.118 2.488-9.118 3.388 0 5.643 3.299 2.488 9.119-1.065 1.964 1.149 2.427 3.393 2.946 1.985.458 2.118 1.428 2.118 3.107l-.003.828h-1.329c0-2.089.083-2.367-1.226-2.669-1.901-.438-3.695-.852-4.351-2.304-.239-.53-.395-1.402.226-2.543 1.372-2.532 1.719-4.726.949-6.017-.902-1.517-3.617-1.509-4.512-.022-.768 1.273-.426 3.479.936 6.05.607 1.146.447 2.016.206 2.543-.66 1.445-2.472 1.863-4.39 2.305-1.252.29-1.172.588-1.172 2.657h-1.331c0-2.196-.176-3.406 2.116-3.936zm-10.117 3.936h1.329c0-1.918-.186-1.385 1.824-1.973 1.014-.295 1.91-.723 2.316-1.612.212-.463.355-1.22-.162-2.197-.952-1.798-1.219-3.374-.712-4.215.547-.909 2.27-.908 2.819.015.935 1.567-.793 3.982-1.02 4.982h1.396c.44-1 1.206-2.208 1.206-3.9 0-2.01-1.312-3.1-2.998-3.1-2.493 0-4.227 2.383-1.866 6.839.774 1.464-.826 1.812-2.545 2.209-1.49.345-1.589 1.072-1.589 2.334l.002.618z" />
                        </svg>
                        <p class="text-nowrap md:text-2xl text-lg font-semibold">{{ $company->details->employees }} </p>
                    </span>
                </span>

                <span class="md:px-5 md:py-3 px-2 py-2">
                    <h6 class="text-lime-950 font-medium text-sm mb-2">Year founded</h6>
                    <span class="flex gap-x-2 items-center">
                        <svg class="md:w-6 md:h-6 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" viewBox="0 0 24 24"
                            clip-rule="evenodd">
                            <path
                                d="M16 7.553l6 7.447h-19v9h-1v-23h20l-6 6.553zm-13-5.553v12h16.91l-5.228-6.489 5.046-5.511h-16.728z" />
                        </svg>
                        <p class="text-nowrap md:text-2xl text-lg font-semibold">{{ $company->details->founded }} </p>
                    </span>
                </span>
                <span class="md:px-5 md:py-3 px-2 py-2">
                    <h6 class="text-lime-950 font-medium text-sm mb-2">Languages</h6>
                    <span class="flex gap-x-2 items-center">
                        <svg class="md:w-6 md:h-6 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" viewBox="0 0 24 24"
                            clip-rule="evenodd">
                            <path
                                d="M24 23h-2.784l-1.07-3h-4.875l-1.077 3h-2.697l4.941-13h2.604l4.958 13zm-4.573-5.069l-1.705-4.903-1.712 4.903h3.417zm-9.252-10.804c.126-.486.201-.852.271-1.212l-2.199-.428c-.036.185-.102.533-.22 1-.742-.109-1.532-.122-2.332-.041.019-.537.052-1.063.098-1.569h2.456v-2.083h-2.161c.106-.531.198-.849.288-1.149l-2.147-.645c-.158.526-.29 1.042-.422 1.794h-2.451v2.083h2.184c-.058.673-.093 1.371-.103 2.077-2.413.886-3.437 2.575-3.437 4.107 0 1.809 1.427 3.399 3.684 3.194 2.802-.255 4.673-2.371 5.77-4.974 1.134.654 1.608 1.753 1.181 2.771-.396.941-1.561 1.838-3.785 1.792v2.242c2.469.038 4.898-.899 5.85-3.166.93-2.214-.132-4.635-2.525-5.793zm-2.892 1.531c-.349.774-.809 1.543-1.395 2.149-.09-.645-.151-1.352-.184-2.107.533-.07 1.072-.083 1.579-.042zm-3.788.724c.062.947.169 1.818.317 2.596-1.996.365-2.076-1.603-.317-2.596z" />
                        </svg>
                        <p class="text-nowrap md:text-2xl text-lg font-semibold"> {{ $company->details->total_languages }}
                        </p>
                    </span>
                </span>
                <span class="md:px-5 md:py-3 px-2 py-2">
                    <h6 class="text-lime-950 font-medium text-sm mb-2">Years In Business</h6>
                    <span class="flex gap-x-2 items-center">
                        <i class="fa-regular fa-calendar md:text-2xl text-base"></i>
                        <p class="text-nowrap md:text-2xl text-lg font-semibold">
                            {{ $company->details->years_in_business }}+ </p>
                    </span>
                </span>
            </div>
        </div>
        <div class="sub-section flex-[.8] bg-lime-400/30 lg:px-4 lg:py-2 rounded-md">
            <div id="myChart" class="w-full"></div>
        </div>
    </div>