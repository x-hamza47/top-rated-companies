@extends('shared.main')
@section('content')
    {{-- ! Hero Section --}}
    <div class="section w-full max-w-[1920px] flex flex-col gap-4 p-[50px] mt-32 max-[720px]:p-5">
        <h1 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl max-w-[900px] 
           text-black font-black">
            Where <span class="text-lime-700">Businesses</span>
            Meet Their Ideal Development
            <span class="text-lime-700">Partners</span>
        </h1>

        <p class="text-black w-full leading-4 max-w-[900px] font-semibold">At topratedcompanies, we cut through market noise
            and simplify
            your
            search with curating
            credible, experienced, and dependable companies.
            Explore comprehensive profiles and choose your next partner with clarity and confidence.
        </p>
        <p class="text-black w-full max-w-[900px] font-semibold">Explore comprehensive profiles and choose your next partner
            with
            clarity and confidence.
        </p>
        <div class="flex items-start gap-2">
            <span class="flex gap-2 flex-wrap">
                <input type="text"
                    class="bg-transparent outline-1 max-[720px]:grow py-4 focus:placeholder:text-lime-500/20 font-semibold text-lime-700 placeholder:font-semibold outline-lime-700 placeholder:text-lime-700 border-0 px-3 rounded-md"
                    placeholder="Service your need">
                <input type="text"
                    class="bg-transparent outline-1 max-[720px]:grow py-4 focus:placeholder:text-lime-500/20 font-semibold text-lime-700 placeholder:font-semibold outline-lime-700 placeholder:text-lime-700 border-0 px-3 rounded-md"
                    placeholder="Where do you live">
            </span>
            <span class="bg-lime-700 px-3 hover:bg-lime-500 py-3 font-black text-lime-900 rounded-md scale-x-[-1]"><svg
                    width="30" height="30" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M37.5667 40.25L25.4917 28.175C24.5333 28.9417 23.4312 29.5486 22.1854 29.9958C20.9396 30.4431 19.6139 30.6667 18.2083 30.6667C14.7264 30.6667 11.7795 29.4608 9.36771 27.049C6.9559 24.6372 5.75 21.6903 5.75 18.2083C5.75 14.7264 6.9559 11.7795 9.36771 9.36771C11.7795 6.9559 14.7264 5.75 18.2083 5.75C21.6903 5.75 24.6372 6.9559 27.049 9.36771C29.4608 11.7795 30.6667 14.7264 30.6667 18.2083C30.6667 19.6139 30.4431 20.9396 29.9958 22.1854C29.5486 23.4312 28.9417 24.5333 28.175 25.4917L40.25 37.5667L37.5667 40.25ZM18.2083 26.8333C20.6042 26.8333 22.6406 25.9948 24.3177 24.3177C25.9948 22.6406 26.8333 20.6042 26.8333 18.2083C26.8333 15.8125 25.9948 13.776 24.3177 12.099C22.6406 10.4219 20.6042 9.58333 18.2083 9.58333C15.8125 9.58333 13.776 10.4219 12.099 12.099C10.4219 13.776 9.58333 15.8125 9.58333 18.2083C9.58333 20.6042 10.4219 22.6406 12.099 24.3177C13.776 25.9948 15.8125 26.8333 18.2083 26.8333Z"
                        class="fill-lime-200" />
                </svg>
            </span>
        </div>
        <div class="flex gap-2 flex-wrap">
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                Graphic Designs

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                Web Development

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                SEO

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                Video Editing

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                Website Designing

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
        </div>
    </div>
    {{-- ! Services Section --}}
    <div class="section flex flex-col">
        <h1 class="text-4xl font-bold">Browse <span class="text-(--accent)">Services</span></h1>
        <p class="text-()">Unfold a broad range of professional services that are tailored to different business needs. Each
            category
            highlights companies with proven capabilities, which helps you compare options and shortlist partners with
            confidence.
            Start exploring –your ideal team may be just a click away.
        </p>
        <div class="card-wrapper flex flex-wrap items-center justify-between my-4 gap-10">
            <div
                class="card w-[30%] max-[1140px]:w-[45%] max-[940px]:w-full relative rounded-md outline-2 outline-(--secondary) flex flex-col p-2 gap-2">
                <div class="card-title flex items-center gap-2">
                    <button class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path class="fill-(--primary)" stroke="white" stroke-width="1"
                                d="M24 10.935v2.131l-8 3.947v-2.23l5.64-2.783-5.64-2.79v-2.223l8 3.948zm-16 3.848l-5.64-2.783 5.64-2.79v-2.223l-8 3.948v2.131l8 3.947v-2.23zm7.047-10.783h-2.078l-4.011 16h2.073l4.016-16z" />
                        </svg>

                    </button>
                    <h2 class="text-2xl font-bold text-(--secondary)">Development</h2>
                </div>
                <div class="card-links mt-4 flex flex-col text-(--secondary) font-bold gap-1">
                    <a href="{{ route('service', ['category' => 'development', 'service' => 'mobile-app-development']) }}">Mobile
                        App Development</a>
                    <a href="{{ route('service', ['category' => 'development', 'service' => 'software-development']) }}">Software
                        Development</a>
                    <a href="{{ route('service', ['category' => 'development', 'service' => 'web-development']) }}">Web
                        Development</a>
                    <a href="{{ route('service', ['category' => 'development', 'service' => 'ar-vr']) }}">AR/VR</a>
                    <a href="{{ route('service', ['category' => 'development', 'service' => 'artificial-intelligence']) }}">Artificial
                        Intelligence</a>
                    <a
                        href="{{ route('service', ['category' => 'development', 'service' => 'blockchain']) }}">Blockchain</a>
                </div>
                <a href="{{ route('category', ['category' => 'development']) }}"
                    class="btn-secondary cursor-pointer absolute bottom-2 right-2">
                    <svg width="22" height="22" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_13_194)">
                            <path d="M14 34L34 14M34 14H14M34 14V34" stroke="white" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <filter id="filter0_d_13_194" x="-4" y="-4" width="60" height="60"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dx="2" dy="2" />
                                <feGaussianBlur stdDeviation="3" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.45 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_194" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_194"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </a>
            </div>
            <div
                class="card w-[30%] max-[1140px]:w-[45%] max-[940px]:w-full relative rounded-md outline-2 outline-(--secondary) flex flex-col p-2 gap-2">
                <div class="card-title flex items-center gap-2">
                    <button class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path class="fill-(--primary)"
                                d="M4 21.832c4.587.38 2.944-4.493 7.188-4.538l1.838 1.534c.458 5.538-6.315 6.773-9.026 3.004zm14.065-7.115c1.427-2.239 5.847-9.749 5.847-9.749.352-.623-.43-1.273-.976-.813 0 0-6.572 5.714-8.511 7.525-1.532 1.432-1.539 2.086-2.035 4.447l1.68 1.4c2.227-.915 2.868-1.039 3.995-2.81zm-11.999 3.876c.666-1.134 1.748-2.977 4.447-3.262.434-2.087.607-3.3 2.547-5.112 1.373-1.282 4.938-4.409 7.021-6.229-1-2.208-4.141-4.023-8.178-3.99-6.624.055-11.956 5.465-11.903 12.092.023 2.911 1.081 5.571 2.82 7.635 1.618.429 2.376.348 3.246-1.134zm6.952-15.835c1.102-.006 2.005.881 2.016 1.983.004 1.103-.882 2.009-1.986 2.016-1.105.009-2.008-.88-2.014-1.984-.013-1.106.876-2.006 1.984-2.015zm-5.997 2.001c1.102-.01 2.008.877 2.012 1.983.012 1.106-.88 2.005-1.98 2.016-1.106.007-2.009-.881-2.016-1.988-.009-1.103.877-2.004 1.984-2.011zm-2.003 5.998c1.106-.007 2.01.882 2.016 1.985.01 1.104-.88 2.008-1.986 2.015-1.105.008-2.005-.88-2.011-1.985-.011-1.105.879-2.004 1.981-2.015zm10.031 8.532c.021 2.239-.882 3.718-1.682 4.587l-.046.044c5.255-.591 9.062-4.304 6.266-7.889-1.373 2.047-2.534 2.442-4.538 3.258z" />
                        </svg>

                    </button>
                    <h2 class="text-2xl font-bold text-(--secondary)">Design & Production</h2>
                </div>
                <div class="card-links mt-4 flex flex-col text-(--secondary) font-bold gap-1">
                    <a href="{{ route('service', ['category' => 'design-production', 'service' => 'web-design']) }}">Web
                        Design</a>
                    <a
                        href="{{ route('service', ['category' => 'design-production', 'service' => 'user-experience-design']) }}">User
                        Experience Design</a>
                    <a href="{{ route('service', ['category' => 'design-production', 'service' => 'logo-design']) }}">Logo
                        Design</a>
                    <a href="{{ route('service', ['category' => 'design-production', 'service' => 'graphic-design']) }}">Graphic
                        Design</a>
                    <a
                        href="{{ route('service', ['category' => 'design-production', 'service' => 'design']) }}">Design</a>
                    <a href="{{ route('service', ['category' => 'design-production', 'service' => 'digital-design']) }}">Digital
                        Design</a>
                </div>
                <a href="{{ route('category', ['category' => 'design-production']) }}"
                    class="btn-secondary absolute bottom-2 right-2"><svg width="22" height="22"
                        viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_13_194)">
                            <path d="M14 34L34 14M34 14H14M34 14V34" stroke="white" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <filter id="filter0_d_13_194" x="-4" y="-4" width="60" height="60"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dx="2" dy="2" />
                                <feGaussianBlur stdDeviation="3" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.45 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_194" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_194"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </a>
            </div>
            <div
                class="card w-[30%] max-[1140px]:w-[45%] max-[940px]:w-full relative rounded-md outline-2 outline-(--secondary) flex flex-col p-2 gap-2">
                <div class="card-title flex items-center gap-2">
                    <button class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path class="fill-(--primary)"
                                d="M18.305 20.418c-.992.615-2.16.97-3.411.97-3.588 0-6.5-2.919-6.5-6.514s2.912-6.513 6.5-6.513c3.587 0 6.5 2.918 6.5 6.513 0 1.254-.354 2.425-.967 3.419l3.573 3.58-2.121 2.126-3.574-3.581zm-8.904-.436c-3.216-.19-6.025-1.903-7.716-4.427l4.349-2.511c.38.493.849.914 1.383 1.237-.015.197-.023.396-.023.596 0 1.972.762 3.766 2.007 5.105zm5.493-9.592c2.484 0 4.5 2.02 4.5 4.509 0 2.489-2.016 4.509-4.5 4.509s-4.5-2.02-4.5-4.509c0-2.489 2.016-4.509 4.5-4.509zm-1.5 6.989h-1v-2.004h1v2.004zm2 0h-1v-3.006h1v3.006zm2 0h-1v-4.96h1v4.96zm-7.894-17.367v5.013c-2.525.251-4.5 2.384-4.5 4.975 0 .787.182 1.531.507 2.194l-4.336 2.503c-.747-1.401-1.171-3-1.171-4.697 0-5.351 4.213-9.727 9.5-9.988zm4.772 7.391c-.796-1.306-2.174-2.219-3.772-2.378v-5.013c5.077.251 9.164 4.296 9.48 9.356-1.337-1.236-3.124-1.991-5.086-1.991-.209 0-.417.009-.622.026z" />
                        </svg>

                    </button>
                    <h2 class="text-2xl font-bold text-(--secondary)">Marketing</h2>
                </div>
                <div class="card-links mt-4 flex flex-col text-(--secondary) font-bold gap-1">
                    <a href="{{ route('service', ['category' => 'marketing', 'service' => 'digital-marketing']) }}">Digital
                        Marketing</a>
                    <a href="{{ route('service', ['category' => 'marketing', 'service' => 'seo']) }}">SEO</a>
                    <a href="{{ route('service', ['category' => 'marketing', 'service' => 'social-media-marketing']) }}">Social
                        Media Marketing</a>
                    <a href="{{ route('service', ['category' => 'marketing', 'service' => 'mobile-marketing']) }}">Mobile
                        Marketing</a>
                    <a href="{{ route('service', ['category' => 'marketing', 'service' => 'content-marketing']) }}">Content
                        Marketing</a>
                    <a href="{{ route('service', ['category' => 'marketing', 'service' => 'search-marketing']) }}">Search
                        Marketing</a>
                </div>
                <a href="{{ route('category', ['category' => 'marketing']) }}"
                    class="btn-secondary absolute bottom-2 right-2"><svg width="22" height="22"
                        viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_13_194)">
                            <path d="M14 34L34 14M34 14H14M34 14V34" stroke="white" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <filter id="filter0_d_13_194" x="-4" y="-4" width="60" height="60"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dx="2" dy="2" />
                                <feGaussianBlur stdDeviation="3" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.45 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_194" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_194"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </a>
            </div>
            <div
                class="card w-[30%] max-[1140px]:w-[45%] max-[940px]:w-full relative rounded-md outline-2 outline-(--secondary) flex flex-col p-2 gap-2">
                <div class="card-title flex items-center gap-2">
                    <button class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path class="fill-(--primary)"
                                d="M24 0v24h-24v-24h24zm-2 22v-16h-20v16h20zm-1-15v14h-11v-14h11zm-14 13v1h-4v-1h4zm2-2v1h-6v-1h6zm8.633-2.615c-.148.049-.308-.031-.357-.179 0 0-1.047-.352-2.291.062l.818 1.269c.085.125.025.295-.116.342l-.555.185-.117.019c-.105 0-.206-.044-.278-.125l-1.123-1.238c-.611.192-1.302-.031-1.534-.606-.053-.133-.08-.273-.08-.415 0-.41.229-.829.727-1.073 2.491-1.223 2.889-2.587 2.889-2.587-.06-.184.077-.372.269-.372.118 0 .228.075.267.193l1.66 4.167c.049.149-.031.308-.179.358zm-8.633.615v1h-6v-1h6zm-2-2.902v1h-4v-1h4zm11.814.856l-.429-.183c.187-.443.205-.959.01-1.44-.196-.482-.566-.839-1.009-1.026l.181-.431c.887.375 1.433 1.24 1.433 2.164 0 .317-.064.629-.186.916zm-.744-.315l-.419-.178c.108-.256.119-.552.005-.83-.111-.277-.326-.483-.581-.59l.178-.421c.362.153.666.445.825.84.16.394.146.815-.008 1.179zm-9.07-2.639v1h-6v-1h6zm0-1.903v1h-6v-1h6zm0-1.097h-6v-1h6v1z" />
                        </svg>

                    </button>
                    <h2 class="text-2xl font-bold text-(--secondary)">Advertising</h2>
                </div>
                <div class="card-links mt-4 flex flex-col text-(--secondary) font-bold gap-1">
                    <a
                        href="{{ route('service', ['category' => 'advertising', 'service' => 'advertising']) }}">Advertising</a>
                    <a href="{{ route('service', ['category' => 'advertising', 'service' => 'branding']) }}">Branding</a>
                    <a href="{{ route('service', ['category' => 'advertising', 'service' => 'creative']) }}">Creative</a>
                    <a href="{{ route('service', ['category' => 'advertising', 'service' => 'video-production']) }}">Video
                        Production</a>
                    <a href="{{ route('service', ['category' => 'advertising', 'service' => 'public-relations']) }}">Public
                        Relations</a>
                    <a href="{{ route('service', ['category' => 'advertising', 'service' => 'media-planning-buying']) }}">Media
                        Planning & Buying</a>
                </div>
                <a href="{{ route('category', ['category' => 'advertising']) }}"
                    class="btn-secondary absolute bottom-2 right-2"><svg width="22" height="22"
                        viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_13_194)">
                            <path d="M14 34L34 14M34 14H14M34 14V34" stroke="white" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <filter id="filter0_d_13_194" x="-4" y="-4" width="60" height="60"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dx="2" dy="2" />
                                <feGaussianBlur stdDeviation="3" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.45 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_194" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_194"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </a>
            </div>
            <div
                class="card w-[30%] max-[1140px]:w-[45%] max-[940px]:w-full relative rounded-md outline-2 outline-(--secondary) flex flex-col p-2 gap-2">
                <div class="card-title flex items-center gap-2">
                    <button class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path class="fill-(--primary)"
                                d="M22 2v20h-20v-20h20zm2-2h-24v24h24v-24zm-4 7h-8v1h8v-1zm0 5h-8v1h8v-1zm0 5h-8v1h8v-1zm-10.516-11.304l-.71-.696-2.553 2.607-1.539-1.452-.698.71 2.25 2.135 3.25-3.304zm0 5l-.71-.696-2.552 2.607-1.539-1.452-.698.709 2.249 2.136 3.25-3.304zm0 5l-.71-.696-2.552 2.607-1.539-1.452-.698.709 2.249 2.136 3.25-3.304z" />
                        </svg>

                    </button>
                    <h2 class="text-2xl font-bold text-(--secondary)">Business Services</h2>
                </div>
                <div class="card-links mt-4 flex flex-col text-(--secondary) font-bold gap-1">
                    <a href="{{ route('service', ['category' => 'business', 'service' => 'call-centers']) }}">Call
                        Centers</a>
                    <a href="{{ route('service', ['category' => 'business', 'service' => 'bpo']) }}">BPO</a>
                    <a href="{{ route('service', ['category' => 'business', 'service' => 'accounting']) }}">Accounting</a>
                    <a href="{{ route('service', ['category' => 'business', 'service' => 'commercial-real-estate']) }}">Commercial
                        Real Estate</a>
                    <a href="{{ route('service', ['category' => 'business', 'service' => 'hr-services']) }}">HR
                        Services</a>
                    <a href="{{ route('service', ['category' => 'business', 'service' => 'consulting']) }}">Consulting</a>
                </div>
                <a href="{{ route('category', ['category' => 'business']) }}"
                    class="btn-secondary absolute bottom-2 right-2"><svg width="22" height="22"
                        viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_13_194)">
                            <path d="M14 34L34 14M34 14H14M34 14V34" stroke="white" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <filter id="filter0_d_13_194" x="-4" y="-4" width="60" height="60"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dx="2" dy="2" />
                                <feGaussianBlur stdDeviation="3" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.45 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_194" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_194"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </a>
            </div>
            <div
                class="card w-[30%] max-[1140px]:w-[45%] max-[940px]:w-full relative rounded-md outline-2 outline-(--secondary) flex flex-col p-2 gap-2">
                <div class="card-title flex items-center gap-2">
                    <button class="btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                            <path class="fill-(--primary)"
                                d="M19 17c0 1.104-.896 2-2 2h-11c-1.104 0-2-.896-2-2v-11c0-1.104.896-2 2-2h11c1.104 0 2 .896 2 2v11zm-11 3v3h-1v-3h1zm4 0v3h-1v-3h1zm2 0v3h-1v-3h1zm-4 0v3h-1v-3h1zm6 0v3h-1v-3h1zm-8-20v3h-1v-3h1zm4 0v3h-1v-3h1zm2 0v3h-1v-3h1zm-4 0v3h-1v-3h1zm6 0v3h-1v-3h1zm4 15h3v1h-3v-1zm0-4h3v1h-3v-1zm0-2h3v1h-3v-1zm0 4h3v1h-3v-1zm0-6h3v1h-3v-1zm-20 8h3v1h-3v-1zm0-4h3v1h-3v-1zm0-2h3v1h-3v-1zm0 4h3v1h-3v-1zm0-6h3v1h-3v-1z" />
                        </svg>

                    </button>
                    <h2 class="text-2xl font-bold text-(--secondary)">IT Services</h2>
                </div>
                <div class="card-links mt-4 flex flex-col text-(--secondary) font-bold gap-1">
                    <a href="{{ route('service', ['category' => 'it', 'service' => 'it-services']) }}">IT
                        Services</a>
                    <a href="{{ route('service', ['category' => 'it', 'service' => 'cybersecurity']) }}">Cybersecurity</a>
                    <a href="{{ route('service', ['category' => 'it', 'service' => 'data-analytics']) }}">Data
                        Analytics</a>
                    <a href="{{ route('service', ['category' => 'it', 'service' => 'managed-it-services']) }}">Managed IT
                        Services</a>
                    <a href="{{ route('service', ['category' => 'it', 'service' => 'cloud-consulting']) }}">Cloud
                        Consulting</a>
                    <a href="{{ route('service', ['category' => 'it', 'service' => 'staff-augmentation']) }}">Staff
                        Augmentation</a>
                </div>
                <a href="{{ route('category', ['category' => 'it']) }}"
                    class="btn-secondary absolute bottom-2 right-2"><svg width="22" height="22"
                        viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_13_194)">
                            <path d="M14 34L34 14M34 14H14M34 14V34" stroke="white" stroke-width="4"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <filter id="filter0_d_13_194" x="-4" y="-4" width="60" height="60"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dx="2" dy="2" />
                                <feGaussianBlur stdDeviation="3" />
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.45 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13_194" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13_194"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    {{-- ! How it works --}}
    <div
        class="section w-full max-w-[1920px] flex justify-between max-[910px]:justify-center gap-2 items-center flex-wrap p-[50px] max-[720px]:p-5 max-[720px]:flex-col">
        <div class="card flex flex-col gap-2 w-full max-w-[400px] p-2 rounded-md">
            <h1 class="text-5xl font-bold text-lime-700">
                How It Works
            </h1>
            <p class="text-gray-950 font-semibold">
                We connect buyers and vendors by providing them with the most trusted, reliable, and insightful content
                available, helping both sides make confident and informed decisions.
            </p>
            <button class="bg-lime-700 p-2 text-center font-bold text-white rounded-md">Watch Top Companies</button>
            <button class="outline-lime-700 outline-2 p-2 text-center font-bold text-lime-700 rounded-md">Get Help</button>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/colleagues-working-project-discussing-details_114579-2817.jpg?t=st=1763479584~exp=1763483184~hmac=7af7a3602e294d4a89844615ea69929bfca37051b00c55f0a03b88aa2e794cb1&w=1060"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Define important parameters
            </h1>
            <p class="text-gray-950 font-semibold">
                Start by identifying the key parameters and requirements for your project
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">1</span>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/female-hand-typing-keyboard-laptop_1150-15742.jpg?t=st=1763480073~exp=1763483673~hmac=685bef002edd1687dd7b588d41c71d42eefee740df9863ed2b2bbd59aa93db89&w=740"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Study the options
            </h1>
            <p class="text-black font-semibold">
                Review top companies their case studies, services, and capabilities
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">2</span>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/front-view-business-man-holding-tablet_23-2150103598.jpg?t=st=1763480258~exp=1763483858~hmac=22477c833b9e10cb60d895f4a7227ad6c983d5e53dd6db0992037a41b6109d25&w=740"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Study a company’s details
            </h1>
            <p class="text-black font-semibold">
                Review each company's profile to ensure they meet your expectations and needs
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">3</span>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/business-women-signature-document_1388-90.jpg?t=st=1763480323~exp=1763483923~hmac=915ac3828db4b8560409aa372425116d7c8e1e9f43794d84e567b0d77ce15a2c&w=740"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Shortlist companies
            </h1>
            <p class="text-black font-semibold">
                Shortlist companies that fit your needs and project easily
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">4</span>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/businessman-handshaking-businesswoman-showing-respect-closeup-view-hands-shaking_1163-4679.jpg?t=st=1763480429~exp=1763484029~hmac=ac218bd01b5112f29e3aaf87f469044eb877d28328455877b031290e8dbada71&w=740"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Partner with the Best
            </h1>
            <p class="text-black font-semibold">
                Select the top company from your shortlist and start building your partnership
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">5</span>
        </div>
    </div>
    {{-- ! Insight Section --}}
    <div class="section w-full max-w-[1920px] flex flex-col gap-4 p-[50px] max-[720px]:p-5">
        <h1 class="text-4xl text-black font-black">Insights & <span class="text-lime-700">Advice</span></h1>
        <div class="flex w-full flex-wrap gap-2">
            <div class="flex flex-col justify-between grow gap-1 w-[300px] hover:bg-lime-700/50 p-2 rounded-md">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiCNVtAT_eenIcH3kok4iNFaywR8dCmmIqqg&s"
                    class="w-full h-[250px] object-cover rounded-md" alt="">
                <h2 class="text-xl text-black font-bold">How AI Reshaping Development Workflows in 2025</h2>
                <p class="text-sm font-semibold text-black">In the era of AI-driven development, Techreviewer conducts
                    online
                    surveys to track real-world trends in software engineering. We leverage our global network of top
                    software development companies to assess the impact of AI on the development workflow.</p>
                <div class="flex justify-between items-center">
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        Research


                    </span>
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        17/11/2025 by TRC
                    </span>
                </div>
            </div>
            <div class="flex flex-col justify-between grow gap-1 w-[300px] hover:bg-lime-700/50 p-2 rounded-md">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJklFQ7Zh3wQN0KEZbTz_g1iNFUD3PlqmyuA&s"
                    class="w-full h-[250px] object-cover rounded-md" alt="">
                <h2 class="text-xl text-black font-bold">Key Challenges in Medical Software Development: Navigating
                    Regulatory
                    Compliance and Data Privacy</h2>
                <p class="text-sm font-semibold text-black">Software has quietly become the foundation of modern
                    healthcare.
                    From
                    electronic medical records (EMR) systems and telemedicine apps to artificial intelligence tools that
                    now aid in diagnostics, digital technologies are changing the way healthcare is delivered and
                    managed.</p>
                <div class="flex justify-between items-center">
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        Research


                    </span>
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        17/11/2025 by TRC
                    </span>
                </div>
            </div>
            <div class="flex flex-col justify-between grow gap-1 w-[300px] hover:bg-lime-700/50 p-2 rounded-md">
                <img src="https://res.cloudinary.com/dthpnue1d/image/upload/v1736932887/How_Much_Does_AI_Software_Development_Cost_A_Budgeting_Blueprint_for_Businesses_Banner_9ae66f6c89.webp"
                    class="w-full h-[250px] object-cover rounded-md" alt="">
                <h2 class="text-xl text-black font-bold">AI in Software Development 2025: From Exploration to
                    Accountability –
                    Survey-Based Analysis</h2>
                <p class="text-sm font-semibold text-black">For the second year in a row, Techreviewer conducts an online
                    survey on
                    the role of AI in software development. We leverage our global network of software development
                    providers to capture how Artificial Intelligence adoption is evolving across teams, geographies, and
                    company sizes. </p>
                <div class="flex justify-between items-center">
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        Research


                    </span>
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        17/11/2025 by TRC
                    </span>
                </div>
            </div>
            <div class="flex flex-col justify-between grow gap-1 w-[300px] hover:bg-lime-700/50 p-2 rounded-md">
                <img src="https://img.freepik.com/free-photo/futuristic-ai-chip-circuit-board_23-2151977487.jpg?t=st=1763474986~exp=1763478586~hmac=4243c7c6de6755b36439260d4f10abb08794a89db6f46ea661771f8555bc8b74&w=1060"
                    class="w-full h-[250px] object-cover rounded-md" alt="">
                <h2 class="text-xl text-black font-bold">AI in Software Development 2025: From Exploration to
                    Accountability –
                    Survey-Based Analysis</h2>
                <p class="text-sm font-semibold text-black">For the second year in a row, Techreviewer conducts an online
                    survey on
                    the role of AI in software development. We leverage our global network of software development
                    providers to capture how Artificial Intelligence adoption is evolving across teams, geographies, and
                    company sizes. </p>
                <div class="flex justify-between items-center">
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        Research


                    </span>
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        17/11/2025 by TRC
                    </span>
                </div>
            </div>
        </div>

    </div>
    {{-- ! Ready --}}
    <div
        class="section w-full max-w-[1920px] items-center bg-lime-700 flex gap-4 p-[50px] max-[720px]:p-5 max-[720px]:flex-col">
        <img class="w-[150px] h-[150px] object-cover rounded-md"
            src="https://s3.amazonaws.com/cdn.designcrowd.com/blog/40-Brand-Logos-for-Creative-and-Cool-Companies/orange-electronics-company-by-ions-brandcrowd.png"
            alt="">
        <div class="flex flex-col max-[720px]:items-center">
            <h1 class="text-6xl text-white w-fit text-center font-bold">Ready to start?</h1>
            <h1 class="text-4xl text-white w-fit text-center font-bold">Create your company profile for free</h1>
            <button
                class="flex justify-center gap-2 items-center w-fit bg-lime-900 p-3 text-center font-semibold text-white rounded-md">
                Watch Top Companies
                <svg width="22" height="22" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-white" stroke-width="5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
    {{-- ! Faq Section --}}
    <div class="section w-full max-w-[1920px] flex flex-col gap-4 p-[50px] max-[720px]:p-5">
        <h1 class="text-4xl text-black font-black">Frequently asked <span class="text-lime-700">Questions</span></h1>
        <div class="flex flex-col faq-container">
            <!-- FAQ Item 1 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                What is an accordion in web design?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        class="icon transition-transform duration-300">
                        <path d="M19,13H5a1,1,0,0,1,0-2H19a1,1,0,0,1,0,2Z" class="stroke-lime-700" stroke-width="2"
                            stroke-linecap="round"></path>
                    </svg>
                </span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                An accordion is a UI component that allows users to expand and collapse sections of content, saving
                space and improving readability.
            </span>

            <!-- FAQ Item 2 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                How does JavaScript toggle the FAQ?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                JavaScript listens for click events on question elements and toggles the <code>max-height</code> of the
                black corresponding answer, while updating the icon.
            </span>

            <!-- FAQ Item 3 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                Can I use Tailwind CSS for animations?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                Yes! Tailwind supports transitions via utility classes. We use <code>transition-[max-height]</code> and
                <code>duration-500</code> for smooth effects.
            </span>

            <!-- FAQ Item 4 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                Why use scrollHeight instead of fixed height?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                <code>scrollHeight</code> dynamically calculates the full height of content, making the accordion
                responsive to any text length.
            </span>

            <!-- FAQ Item 5 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                Is this FAQ mobile-friendly?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                Absolutely! Built with Tailwind's responsive classes and flexible layout, it works perfectly on phones,
                tablets, and desktops.
            </span>

            <!-- FAQ Item 6 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                Can I add images or code blocks inside answers?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                Yes! You can include or code
            </span>

            <!-- FAQ Item 7 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                How do I customize the colors and speed?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-medium text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                Change <code>text-lime-400</code>, <code>bg-lime-900/50</code>, and <code>duration-500</code> in
                Tailwind classes. For JS speed, adjust <code>setTimeout</code> delay if needed.
            </span>
        </div>

    </div>
    {{-- <div class="w-full mb-[13000px] text-white"></div> --}}
@endsection
@push('scripts')
    {{-- <script src="{{ asset('assets/js/services.js') }}"></script> --}}
    <script src="{{ asset('assets/js/accordian.js') }}"></script>
@endpush
