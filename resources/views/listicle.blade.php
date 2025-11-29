@extends('shared.main')

@section('content')
    {{-- ! Hero Content --}}
    <div
        class="section max-[840px]:flex-col  max-w-[1920px] w-full flex justify-between gap-4 p-[50px] mt-20 max-[720px]:p-5">
        <div class="sub-section w-[55%]">
            <h1 class="text-5xl font-bold w-full">
                Top <span class="text-lime-600"> Development </span> Companies
            </h1>
            <p class="company-read tracking-wide mt-3 font-medium">A high-performing website is the backbone of your digital
                presence.
                From custom
                platforms and CMS integrations to e-commerce stores and web apps, the right development partner turns ideas
                into A high-performing website is the backbone of your digital presence. From custom
                platforms and CMS integrations to e-commerce stores and web apps, the right development partner turns ideas
                into
            </p>
        </div>
        <div class="sub-section">
            <h3 class="text-3xl text-lime-600 font-semibold text-nowrap">
                2651+ Companies
            </h3>
        </div>
    </div>

    {{-- ! Hero Section Quick Links --}}
    <div
        class="section w-full max-w-[1920px] flex flex-wrap gap-x-10 px-[50px] max-[720px]:p-5 text-lime-800 font-semibold ">
        {{-- * Link 1 --}}
        <a href="#" class="flex gap-2 hover:text-lime-500 transition">
            Mobile App Development
            <svg width="22" height="22" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 34L34 14M34 14H14M34 14V34" stroke="currentColor" stroke-width="5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        {{-- * Link 2 --}}
        <a href="#" class="flex gap-2 hover:text-lime-500 transition">
            Software Development
            <svg width="22" height="22" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 34L34 14M34 14H14M34 14V34" stroke="currentColor" stroke-width="5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        {{-- * Link 2 --}}
        <a href="#" class="flex gap-2 hover:text-lime-500 transition">
            Web Development
            <svg width="22" height="22" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 34L34 14M34 14H14M34 14V34" stroke="currentColor" stroke-width="5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        {{-- * Link 3 --}}
        <a href="#" class="flex gap-2 hover:text-lime-500 transition">
            AR/VR
            <svg width="22" height="22" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 34L34 14M34 14H14M34 14V34" stroke="currentColor" stroke-width="5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        {{-- * Link 4 --}}
        <a href="#" class="flex gap-2 hover:text-lime-500 transition">
            Artificial Intelligence
            <svg width="22" height="22" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 34L34 14M34 14H14M34 14V34" stroke="currentColor" stroke-width="5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        {{-- * Link 5 --}}
        <a href="#" class="flex gap-2 hover:text-lime-500 transition">
            Blockchain
            <svg width="22" height="22" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 34L34 14M34 14H14M34 14V34" stroke="currentColor" stroke-width="5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
    </div>

    {{-- ! Quick Search Buttons --}}
    <div class="section w-full max-w-[1920px] flex flex-wrap gap-2 p-[50px] max-[720px]:p-5 text-white my-3">
        <div class="input-wrapper flex items-center gap-2 outline-2 outline-lime-600 p-2 rounded-md">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                <path class="fill-lime-600"
                    d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm1.476 14.955c.988-.405 1.757-1.211 2.116-2.216l2.408-6.739-6.672 2.387c-1.006.36-1.811 1.131-2.216 2.119l-3.065 7.494 7.429-3.045zm-.122-4.286c.551.551.551 1.446 0 1.996-.551.551-1.445.551-1.996 0-.551-.55-.551-1.445 0-1.996.551-.551 1.445-.551 1.996 0z" />
            </svg>

            <input type="text" placeholder="Location"
                class="placeholder:text-gray-400 text-gray-950 outline-0 border-0 outline-lime-400">
        </div>
        <div class="button-wrapper">
            <button
                class="bg-lime-800 rounded-md flex justify-between items-center gap-2 px-2 py-3 hover:bg-lime-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="white"
                        d="M24 13.616v-3.232l-2.869-1.02c-.198-.687-.472-1.342-.811-1.955l1.308-2.751-2.285-2.285-2.751 1.307c-.613-.339-1.269-.613-1.955-.811l-1.021-2.869h-3.232l-1.021 2.869c-.686.198-1.342.471-1.955.811l-2.751-1.308-2.285 2.285 1.308 2.752c-.339.613-.614 1.268-.811 1.955l-2.869 1.02v3.232l2.869 1.02c.197.687.472 1.342.811 1.955l-1.308 2.751 2.285 2.286 2.751-1.308c.613.339 1.269.613 1.955.811l1.021 2.869h3.232l1.021-2.869c.687-.198 1.342-.472 1.955-.811l2.751 1.308 2.285-2.286-1.308-2.751c.339-.613.613-1.268.811-1.955l2.869-1.02zm-12 2.384c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4z" />
                </svg>
                Services
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                    <path fill="white" d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                </svg>

            </button>
        </div>
        <div class="button-wrapper">
            <button class="bg-lime-800 rounded-md flex justify-between items-center gap-2 p-3 hover:bg-lime-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="white"
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 16.947v1.053h-1v-.998c-1.035-.018-2.106-.265-3-.727l.455-1.644c.956.371 2.229.765 3.225.54 1.149-.26 1.384-1.442.114-2.011-.931-.434-3.778-.805-3.778-3.243 0-1.363 1.039-2.583 2.984-2.85v-1.067h1v1.018c.724.019 1.536.145 2.442.42l-.362 1.647c-.768-.27-1.617-.515-2.443-.465-1.489.087-1.62 1.376-.581 1.916 1.712.805 3.944 1.402 3.944 3.547.002 1.718-1.343 2.632-3 2.864z" />
                </svg>
                Budget
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                    <path fill="white" d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                </svg>

            </button>
        </div>
        <div class="button-wrapper">
            <button
                class="bg-lime-800 rounded-md flex justify-between items-center gap-2 p-3 hover:bg-lime-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="white"
                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7 14h-8v-9h2v7h6v2z" />
                </svg>
                Hourly Rates
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                    <path fill="white" d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                </svg>

            </button>
        </div>
        <div class="button-wrapper">
            <button
                class="bg-lime-800 rounded-md flex justify-between items-center gap-2 p-3 hover:bg-lime-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="white"
                        d="M13 2h2v2h1v19h1v-15l6 3v12h1v1h-24v-1h1v-11h7v11h1v-19h1v-2h2v-2h1v2zm8 21v-2h-2v2h2zm-15 0v-2h-3v2h3zm8 0v-2h-3v2h3zm-2-4v-13h-1v13h1zm9 0v-1h-2v1h2zm-18 0v-2h-1v2h1zm4 0v-2h-1v2h1zm-2 0v-2h-1v2h1zm9 0v-13h-1v13h1zm7-2v-1h-2v1h2zm-18-1v-2h-1v2h1zm2 0v-2h-1v2h1zm2 0v-2h-1v2h1zm14-1v-1h-2v1h2zm0-2.139v-1h-2v1h2z" />
                </svg>
                Industry
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                    <path fill="white" d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                </svg>

            </button>
        </div>
        <div class="button-wrapper">
            <button
                class="bg-lime-800 rounded-md flex justify-between items-center gap-2 p-3 hover:bg-lime-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="white"
                        d="M21.172 24l-7.387-7.387c-1.388.874-3.024 1.387-4.785 1.387-4.971 0-9-4.029-9-9s4.029-9 9-9 9 4.029 9 9c0 1.761-.514 3.398-1.387 4.785l7.387 7.387-2.828 2.828zm-12.172-8c3.859 0 7-3.14 7-7s-3.141-7-7-7-7 3.14-7 7 3.141 7 7 7z" />
                </svg>
            </button>
        </div>
    </div>
    {{-- ! Section Of Agencies --}}
    <div class="section w-full max-w-[1920px] flex flex-col flex-wrap gap-3 p-[50px] max-[720px]:p-5">
        <h2 class="text-4xl font-semibold ">
            List of the Best <span class="text-lime-600"> Development </span> Agencies
        </h2>
        {{-- ?? List Of Agencies --}}
        <div class="company-wrapper flex flex-col gap-4">
            @for ($i = 0; $i < 10; $i++)
            <div
                class="company outline-2 outline-gray-500/55 bg-lime-600/15 rounded-md px-6 py-5 hover:scale-[1.01] hover:outline-grap-800 hover:shadow-2xl transition-all duration-300 ">
                <div class="company-intro max-[840px]:flex-col flex justify-between">
                    <div class="flex items-center gap-2 max-[840px]:flex-col">
                        <img src="https://s3.us-east-1.amazonaws.com/cdn.designcrowd.com/blog/120-cool-logos-for-a-fresh-new-look/gaming-battle-soldier-sword-by-amcstudio-brandcrowd.png"
                            alt="" class="w-[85px] h-[85px] object-cover rounded-md">
                        <div class="name flex flex-col ml-1">
                            <div class="flex gap-2 items-center ">
                                <h4 class="text-4xl font-semibold uppercase">Inoxoft</h4>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="currentColor" class="fill-lime-800"
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                                </svg>
                                <h1 class="text-sm font-bold text-lime-800">Premier Verified</h1>
                            </div>
                            <div class="flex gap-2 items-center text-green-900">
                                <h4 class=" font-semibold text-xl">4.5</h4>
                                <div class="star-wrapper flex gap-1">
                                    {{-- ? Stars --}}
                                    <svg clip-rule="evenodd" class="w-5 h-5" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                            fill-rule="nonzero" fill="currentColor" />
                                    </svg>
                                    <svg clip-rule="evenodd" class="w-5 h-5" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                            fill-rule="nonzero" fill="currentColor" />
                                    </svg>
                                    <svg clip-rule="evenodd" class="w-5 h-5" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                            fill-rule="nonzero" fill="currentColor" />
                                    </svg>
                                    <svg clip-rule="evenodd" class="w-5 h-5" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                            fill-rule="nonzero" fill="currentColor" />
                                    </svg>
                                    <svg clip-rule="evenodd" class="w-5 h-5" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                            fill-rule="nonzero" fill="" class="fill-gray-400" />
                                    </svg>
                                    <p class="text-sm font-medium ml-1">73 Reviews</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 max-[840px]:mt-2">
                        <a
                            class="text-lime-600 h-fit rounded font-semibold border-2 border-lime-600 px-3 py-2 cursor-pointer hover:text-white hover:bg-lime-600">
                            View Profile
                        </a>
                        <a
                            class="text-lime-800 h-fit rounded font-semibold border-2 border-lime-400 bg-lime-400 px-3 py-2 cursor-pointer hover:bg-lime-600 hover:text-white hover:border-lime-600 ">
                            Visit Website
                        </a>
                        <button
                            class="text-lime-900 h-fit rounded-md font-semibold px-3 py-2 border-2 border-lime-400 bg-lime-400 cursor-pointer  hover:bg-lime-600 hover:text-white hover:border-lime-600 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 24l-7-6-7 6v-24h14v24z" />
                            </svg>
                        </button>
                    </div>

                </div>
                {{-- Info: Company Details --}}
                <div class="company-detail max-[840px]:flex-col flex lg:justify-between md:gap-15 sm:gap-5 lg:gap-25 mt-4">
                    {{-- ! Column 1 --}}
                    <div class="flex flex-col gap-7 ">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M14.101 24l-14.101-14.105v-9.895h9.855l14.145 14.101c-3.3 3.299-6.6 6.599-9.899 9.899zm-4.659-23h-8.442v8.481l13.101 13.105 8.484-8.484c-4.381-4.368-8.762-8.735-13.143-13.102zm-1.702 3.204c.975.976.975 2.56 0 3.536-.976.975-2.56.975-3.536 0-.976-.976-.976-2.56 0-3.536s2.56-.976 3.536 0zm-.708.707c.586.586.586 1.536 0 2.121-.585.586-1.535.586-2.121 0-.585-.585-.585-1.535 0-2.121.586-.585 1.536-.585 2.121 0z" />
                            </svg>
                            <p class="text-nowrap text-sm">25,000+</p>
                        </span>
                        <span class="flex items-center gap-2 ">
                            <svg class="w-5 h-5 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 11h6v1h-7v-9h1v8z" />
                            </svg>
                            <p class="text-nowrap ">$25 - $49 / hr</p>
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M10.119 16.064c2.293-.53 4.427-.994 3.394-2.946-3.147-5.941-.835-9.118 2.488-9.118 3.388 0 5.643 3.299 2.488 9.119-1.065 1.964 1.149 2.427 3.393 2.946 1.985.458 2.118 1.428 2.118 3.107l-.003.828h-1.329c0-2.089.083-2.367-1.226-2.669-1.901-.438-3.695-.852-4.351-2.304-.239-.53-.395-1.402.226-2.543 1.372-2.532 1.719-4.726.949-6.017-.902-1.517-3.617-1.509-4.512-.022-.768 1.273-.426 3.479.936 6.05.607 1.146.447 2.016.206 2.543-.66 1.445-2.472 1.863-4.39 2.305-1.252.29-1.172.588-1.172 2.657h-1.331c0-2.196-.176-3.406 2.116-3.936zm-10.117 3.936h1.329c0-1.918-.186-1.385 1.824-1.973 1.014-.295 1.91-.723 2.316-1.612.212-.463.355-1.22-.162-2.197-.952-1.798-1.219-3.374-.712-4.215.547-.909 2.27-.908 2.819.015.935 1.567-.793 3.982-1.02 4.982h1.396c.44-1 1.206-2.208 1.206-3.9 0-2.01-1.312-3.1-2.998-3.1-2.493 0-4.227 2.383-1.866 6.839.774 1.464-.826 1.812-2.545 2.209-1.49.345-1.589 1.072-1.589 2.334l.002.618z" />
                            </svg>
                            <p class="text-nowrap">50 - 249</p>
                        </span>
                        <span class="flex items-center gap-2 ">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                                <path
                                    d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602" />
                            </svg>
                            <p class="text-nowrap">Newwark, DE</p>
                        </span>
                    </div>
                    {{-- ! Column 2 --}}
                    <div class="flex flex-col gap-4 max-w-md ">
                        <div class="flex flex-col gap-2">
                            <small class="uppercase text-gray-500 font-semibold">Services Provided</small>
                            {{-- * Bar --}}
                            <div class="w-full h-4 rounded-lg overflow-hidden flex">
                                <div class="bg-lime-600" style="width:40%"></div>
                                <div class="bg-purple-500" style="width:40%"></div>
                                <div class="bg-blue-400" style="width:15%"></div>
                                <div class="bg-pink-400" style="width:5%"></div>
                            </div>

                            <div class="flex flex-col gap-2 mt-2 font-normal">
                                <div class="flex items-center gap-2">
                                    <span class="w-4 h-4 rounded bg-lime-600"></span>
                                    <strong class="text-nowrap">40% Web Development</strong>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-4 h-4 rounded bg-purple-500"></span>
                                    <strong class="text-nowrap">40% Custom Software Development</strong>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-4 h-4 rounded bg-blue-400"></span>
                                    <strong class="text-nowrap">15% E-Commerce Development</strong>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-4 h-4 rounded bg-pink-400"></span>
                                    <strong class="text-nowrap">5% AI Development</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ! Column 3 --}}
                    <div class="flex flex-col gap-2">
                        <p class="break-word line-clamp-6">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Tenetur rerum
                            ipsum, magni itaque sed
                            adipisci odio dolorem expedita placeat molestiae vitae qui? Repellendus similique placeat
                            consequatur. Commodi explicabo cupiditate consectetur. Lorem ipsum, dolor sit amet
                            consectetur
                            adipisicing elit. Tenetur rerum ipsum, magni itaque sed
                            adipisci odio dolorem expedita placeat molestiae vitae qui? Repellendus similique placeat
                            consequatur. Commodi explicabo cupiditate consectetur.
                            <span class="text-blue-500 font-medium wro">See all 26 Projects</span>
                        </p>
                    </div>

                </div>

                {{-- Info: Detail Boxes --}}
                <div class="mt-4 w-full flex text-xs gap-6 font-semibold flex-wrap">
                    <div class="button-wrapper flex-1 min-w-[300px]">
                        <button
                            class="border border-lime-800 rounded-md flex justify-between items-center gap-2 px-2 py-3 hover:bg-lime-600 transition w-full hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.873 9.81c.086-.251.127-.508.127-.763 0-.77-.379-1.514-1.055-1.982-2.152-1.492-1.868-1.117-2.68-3.544-.339-1.014-1.321-1.7-2.429-1.696-2.654.008-2.193.153-4.335-1.354-.446-.314-.974-.471-1.501-.471s-1.055.157-1.502.471c-2.154 1.515-1.687 1.362-4.335 1.354-1.107-.003-2.09.683-2.429 1.696-.812 2.433-.533 2.055-2.68 3.544-.675.469-1.054 1.212-1.054 1.982 0 .255.041.512.127.763.83 2.428.827 1.963 0 4.38-.086.251-.127.509-.127.763 0 .77.379 1.514 1.055 1.982 2.147 1.489 1.869 1.114 2.68 3.544.339 1.014 1.321 1.7 2.429 1.696 2.654-.009 2.193-.152 4.335 1.354.446.314.974.471 1.501.471s1.055-.157 1.502-.471c2.141-1.506 1.681-1.362 4.335-1.354 1.107.003 2.09-.683 2.429-1.696.812-2.428.528-2.053 2.68-3.544.675-.468 1.054-1.212 1.054-1.982 0-.254-.041-.512-.127-.763-.831-2.427-.827-1.963 0-4.38zm-7.565 1.984c.418.056.63.328.63.61 0 .323-.277.66-.844.705-.348.027-.434.312-.016.406.351.08.549.326.549.591 0 .314-.279.654-.913.771-.383.07-.421.445-.016.477.344.026.479.146.479.312 0 .466-.826 1.333-2.426 1.333-2.501.001-3.407-1.499-6.751-1.499v-4.964c1.766-.271 3.484-.817 4.344-3.802.239-.831.39-1.734 1.187-1.734 1.188 0 1.297 2.562.844 4.391.656.344 1.875.468 2.489.442.886-.036 1.136.409 1.136.745 0 .505-.416.675-.677.755-.304.094-.444.404-.015.461z"/>
                            </svg>
                            Reviewd 8 times in the past 6 months
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path 
                                    d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                            </svg>

                        </button>
                    </div>
                    <div class="button-wrapper flex-1 min-w-[300px]">
                        <button
                            class="border border-lime-800 rounded-md flex justify-between items-center gap-2 px-2 py-3 hover:bg-lime-600 transition w-full hover:text-white"">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13 2h2v2h1v19h1v-15l6 3v12h1v1h-24v-1h1v-11h7v11h1v-19h1v-2h2v-2h1v2zm8 21v-2h-2v2h2zm-15 0v-2h-3v2h3zm8 0v-2h-3v2h3zm-2-4v-13h-1v13h1zm9 0v-1h-2v1h2zm-18 0v-2h-1v2h1zm4 0v-2h-1v2h1zm-2 0v-2h-1v2h1zm9 0v-13h-1v13h1zm7-2v-1h-2v1h2zm-18-1v-2h-1v2h1zm2 0v-2h-1v2h1zm2 0v-2h-1v2h1zm14-1v-1h-2v1h2zm0-2.139v-1h-2v1h2z" fill="currentColor"/>
                            </svg>
                            Experience in 30 Industries
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path fill="currentColor"
                                    d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                            </svg>

                        </button>
                    </div>
                    <div class="button-wrapper flex-1 min-w-[300px]">
                        <button
                            class="border border-lime-800 rounded-md flex justify-between items-center gap-2 px-2 py-3 hover:bg-lime-600 transition w-full hover:text-white"">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M0 8v-2c0-1.104.896-2 2-2h18c1.104 0 2 .896 2 2v2h-22zm24 7.5c0 2.485-2.015 4.5-4.5 4.5s-4.5-2.015-4.5-4.5 2.015-4.5 4.5-4.5 4.5 2.015 4.5 4.5zm-2.156-.882l-.696-.696-2.116 2.169-.991-.94-.696.697 1.688 1.637 2.811-2.867zm-8.844.882c0 1.747.696 3.331 1.82 4.5h-12.82c-1.104 0-2-.896-2-2v-7h14.82c-1.124 1.169-1.82 2.753-1.82 4.5zm-5 .5h-5v1h5v-1zm3-2h-8v1h8v-1z" fill="currentColor"/>
                            </svg>
                            4.9 out of 5.0 rating for cost
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path fill="currentColor"
                                    d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                            </svg>

                        </button>
                    </div>
                    <div class="button-wrapper flex-1 min-w-[300px]">
                        <button
                            class="border border-lime-800 rounded-md flex justify-between items-center gap-2 px-2 py-3 hover:bg-lime-600 transition w-full hover:text-white"">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M8 24l3-9h-9l14-15-3 9h9l-14 15z"/>
                            </svg>
                            Responsive
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path fill="currentColor"
                                    d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                            </svg>

                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>

    </div>
@endsection
