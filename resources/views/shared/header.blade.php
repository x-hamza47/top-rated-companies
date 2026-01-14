<header class="w-full border-b-2 border-lime-700 fixed z-9999 bg-white">
    <div class="max-w-[1920px] mx-auto flex items-center justify-between h-20 px-4 md:px-10">

        <div class="w-20 h-20 shrink-0 mr-7">
            <img class="w-full h-full object-contain" src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>

        <nav class="hidden xl:flex items-center gap-6 text-gray-700 font-medium flex-1">
            @foreach ($navCategories as $category)
                <div class="relative group menu-item">
                    <button class="nav-link">{{ $category->name }}</button>
                    @if ($category->services->count())
                        <div
                            class="dropdown hidden opacity-0 translate-y-4 transition-all duration-300 absolute left-0 top-full bg-white  shadow-xl rounded-lg w-64">
                            <ul class="space-y-1">
                                @foreach ($category->services as $service)
                                    <li><a class="dropdown-link"
                                            href="{{ route('services.companies', $service->slug) }}">{{ $service->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
            <a href="{{ url('/plans') }}" class="nav-link">Pricing & Packages</a>
            <a href="#" class="nav-link">Resources</a>
        </nav>
        @auth
            <div class="hidden xl:flex gap-2">
                <a class="btn-primary" href="{{ route('dashboard.index') }}">Dashboard</a>
            </div>
        @endauth

        @guest
            <div class="hidden xl:flex gap-2">
                <a class="btn-primary" href="{{ route('login') }}">Sign In</a>
                <a class="btn-outline" href="{{ route('register.show') }}">Register</a>
            </div>
        @endguest

        <div class="block xl:hidden">
            <button id="mobile-menu-btn" class="text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>


    {{-- !Mobile Menu --}}
    <div id="mobile-menu"
        class="fixed top-0 right-0 h-full w-3/4 max-w-xs bg-white shadow-xl transform translate-x-full transition-transform duration-300 xl:hidden z-50 overflow-y-auto">
        <div class="flex justify-between items-center px-6 py-4 border-b border-lime-700">
            <div class="w-20 h-20 shrink-0">
                <img class="w-full h-full object-contain" src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            <button id="mobile-menu-close" class="text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex flex-col gap-1 px-6 py-6 text-gray-700 font-medium">
            @foreach ($navCategories as $category)
                <div class="mobile-menu-item">
                    <button
                        class="mobile-drop w-full text-left flex justify-between items-center py-2 px-3 rounded hover:bg-lime-50">
                        {{ $category->name }} <span class="transform transition-transform"><svg
                                class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg></span>
                    </button>
                    @if ($category->services->count())
                        <ul
                            class="mobile-submenu max-h-0 overflow-hidden transition-all duration-300 flex flex-col pl-4 space-y-2  text-gray-500">
                            @foreach ($category->services as $service)
                                <li class="my-2"><a class="mobile-link"
                                        href="{{ route('services.companies', $service->slug) }}">{{ $service->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
          

            <a class="mobile-link py-2 px-3 rounded hover:bg-lime-50">Pricing & Packages</a>
            <a class="mobile-link py-2 px-3 rounded hover:bg-lime-50">Resources</a>
        </nav>

        @auth
            <div class="flex flex-col gap-3 px-6 mt-4 mb-10">
                <a class="btn-primary" href="{{ route('dashboard.index') }}">Dashboard</a>
            </div>
        @endauth
        @guest
            <div class="flex justify-center items-center gap-3 px-6 mt-4 mb-10">
                <a class="btn-primary" href="{{ route('login') }}">Sign In</a>
                <a class="btn-outline" href="{{ route('register.show') }}">Register</a>
            </div>
        @endguest
    </div>
</header>

@push('scripts')
    <script>
        const menuItems = document.querySelectorAll(".menu-item");

        menuItems.forEach(item => {
            const btn = item.querySelector(".nav-link");
            const dropdown = item.querySelector(".dropdown");
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                menuItems.forEach(other => {
                    const otherDropdown = other.querySelector(".dropdown");
                    const otherBtn = other.querySelector(".nav-link");
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.add("hidden");
                        otherDropdown.classList.remove("opacity-100", "translate-y-0");
                        otherBtn.classList.remove("active");
                    }
                });


                const isOpen = !dropdown.classList.contains("hidden");
                dropdown.classList.toggle("hidden");
                dropdown.classList.toggle("opacity-100");
                dropdown.classList.toggle("translate-y-0");
                btn.classList.toggle("active", !isOpen);
            });
        });

        const mobileBtn = document.getElementById("mobile-menu-btn");
        const mobileMenu = document.getElementById("mobile-menu");
        const mobileClose = document.getElementById("mobile-menu-close");

        mobileBtn.addEventListener("click", () => {
            mobileMenu.classList.remove("translate-x-full");
        });

        mobileClose.addEventListener("click", () => {
            mobileMenu.classList.add("translate-x-full");
        });


        const mobileItems = document.querySelectorAll(".mobile-menu-item");
        mobileItems.forEach(item => {
            const btn = item.querySelector(".mobile-drop");
            const submenu = item.querySelector(".mobile-submenu");
            const arrow = btn.querySelector("span");

            btn.addEventListener("click", () => {

                mobileItems.forEach(other => {
                    if (other !== item) {
                        const otherSub = other.querySelector(".mobile-submenu");
                        const otherArrow = other.querySelector("span");
                        const otherBtn = other.querySelector(".mobile-drop");

                        otherSub.style.maxHeight = null;
                        otherArrow.classList.remove("rotate-180");
                        otherBtn.classList.remove("active");
                    }
                });


                if (submenu.style.maxHeight && submenu.style.maxHeight !== "0px") {
                    submenu.style.maxHeight = null;
                    arrow.classList.remove("rotate-180");
                    btn.classList.remove("active");
                } else {
                    submenu.style.maxHeight = submenu.scrollHeight + "px";
                    arrow.classList.add("rotate-180");
                    btn.classList.add("active");
                }
            });
        });

        document.addEventListener("click", (e) => {
            const isClickInside = [...menuItems].some(item => item.contains(e.target));
            if (!isClickInside) {
                menuItems.forEach(item => {
                    const dropdown = item.querySelector(".dropdown");
                    const btn = item.querySelector(".nav-link");
                    dropdown.classList.add("hidden");
                    dropdown.classList.remove("opacity-100", "translate-y-0");
                    btn.classList.remove("active");
                });
            }
        });
    </script>
@endpush

