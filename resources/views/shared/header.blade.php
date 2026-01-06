<header class="w-full border-b-2 border-lime-700 fixed z-9999 bg-white">
    <div class="max-w-[1920px] mx-auto flex items-center justify-between h-20 px-4 md:px-10">

        <div class="w-20 h-20 shrink-0 mr-7">
            <img class="w-full h-full object-contain" src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>

        <nav class="hidden xl:flex items-center gap-6 text-gray-700 font-medium flex-1">
            <div class="relative group menu-item">
                <button class="nav-link">Development</button>
                <div
                    class="dropdown hidden opacity-0 translate-y-4 transition-all duration-300 absolute left-0 top-full bg-white  shadow-xl rounded-lg w-64">
                    <ul class="space-y-1">
                        <li><a class="dropdown-link"
                                href="{{ route('services.companies', 'mobile-app-development') }}">Mobile
                                App Development</a></li>
                        <li><a class="dropdown-link"
                                href="{{ route('services.companies', 'software-development') }}">Software
                                Development</a></li>
                        <li><a class="dropdown-link" href="{{ route('services.companies', 'web-development') }}">Web
                                Development</a></li>
                        <li><a class="dropdown-link" href="{{ route('services.companies', 'ar-vr') }}">AR/VR</a>
                        </li>
                        <li><a class="dropdown-link"
                                href="{{ route('services.companies', 'artificial-intelligence') }}">Artificial
                                Intelligence</a></li>
                        <li><a class="dropdown-link"
                                href="{{ route('services.companies', 'blockchain') }}">Blockchain</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="relative group menu-item">
                <button class="nav-link">IT Services</button>
                <div
                    class="dropdown hidden opacity-0 translate-y-4 transition-all duration-300 absolute left-0 top-full bg-white shadow-xl rounded-lg w-64">
                    <ul class="space-y-3">
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'it-services') }}">IT
                                Services</a></li>
                        <li><a class="dropdown-link"
                                href="{{ route('services.companies', 'cybersecurity') }}">Cybersecurity</a>
                        </li>
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'data-analytics') }}">Data
                                Analytics</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'managed-it-services') }}">Managed
                                IT
                                Services</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'cloud-consulting') }}">Cloud
                                Consulting</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'staff-augmentation') }}">Staff
                                Augmentation</a></li>
                    </ul>
                </div>
            </div>
            <div class="relative group menu-item">
                <button class="nav-link">Marketing</button>
                <div
                    class="dropdown hidden opacity-0 translate-y-4 transition-all duration-300 absolute left-0 top-full bg-white  shadow-xl rounded-lg w-64">
                    <ul class="space-y-3">
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'digital-marketing') }}">Digital
                                Marketing</a></li>
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'seo') }}">SEO</a>
                        </li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'social-media-marketing') }}">Social
                                Media Marketing</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'mobile-marketing') }}">Mobile
                                Marketing</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'content-marketing') }}">Content
                                Marketing</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'search-marketing') }}">Search
                                Marketing</a></li>
                    </ul>
                </div>
            </div>
            <div class="relative group menu-item">
                <button class="nav-link">Design</button>
                <div
                    class="dropdown hidden opacity-0 translate-y-4 transition-all duration-300 absolute left-0 top-full bg-white  shadow-xl rounded-lg w-64">
                    <ul class="space-y-3">
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'web-design') }}">Web
                                Design</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'user-experience-design') }}">User
                                Experience Design</a></li>
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'logo-design') }}">Logo
                                Design</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'graphic-design') }}">Graphic
                                Design</a></li>
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'design') }}">Design</a>
                        </li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'digital-design') }}">Digital
                                Design</a></li>
                    </ul>
                </div>
            </div>
            <div class="relative group menu-item">
                <button class="nav-link">Business</button>
                <div
                    class="dropdown hidden opacity-0 translate-y-4 transition-all duration-300 absolute left-0 top-full bg-white  shadow-xl rounded-lg w-64">
                    <ul class="space-y-3">
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'call-centers') }}">Call
                                Centers</a></li>
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'bpo') }}">BPO</a>
                        </li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'accounting') }}">Accounting</a>
                        </li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'commercial-real-estate') }}">Commercial
                                Real Estate</a></li>
                        <li> <a class="dropdown-link" href="{{ route('services.companies', 'hr-services') }}">HR
                                Services</a></li>
                        <li> <a class="dropdown-link"
                                href="{{ route('services.companies', 'consulting') }}">Consulting</a>
                        </li>
                    </ul>
                </div>
            </div>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>


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
            <div class="mobile-menu-item">
                <button
                    class="mobile-drop w-full text-left flex justify-between items-center py-2 px-3 rounded hover:bg-lime-50">
                    Development <span class="transform transition-transform"><svg
                            class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg></span>
                </button>
                <ul
                    class="mobile-submenu max-h-0 overflow-hidden transition-all duration-300 flex flex-col pl-4 space-y-2  text-gray-500">
                    <li class="my-2"><a class="mobile-link"
                            href="{{ route('services.companies', 'mobile-app-development') }}">Mobile
                            App Development</a></li>
                    <li class="my-2"><a class="mobile-link"
                            href="{{ route('services.companies', 'software-development') }}">Software
                            Development</a></li>
                    <li class="my-2"><a class="mobile-link"
                            href="{{ route('services.companies', 'web-development') }}">Web
                            Development</a></li>
                    <li class="my-2"><a class="mobile-link"
                            href="{{ route('services.companies', 'ar-vr') }}">AR/VR</a>
                    </li>
                    <li class="my-2"><a class="mobile-link"
                            href="{{ route('services.companies', 'artificial-intelligence') }}">Artificial
                            Intelligence</a></li>
                    <li class="my-2"><a class="mobile-link"
                            href="{{ route('services.companies', 'blockchain') }}">Blockchain</a>
                    </li>
                </ul>
            </div>

            <div class="mobile-menu-item">
                <button
                    class="mobile-drop w-full text-left flex justify-between items-center py-2 px-3 rounded hover:bg-lime-50">
                    IT Services <span class="transform transition-transform"><svg
                            class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg></span>
                </button>
                <ul
                    class="mobile-submenu max-h-0 overflow-hidden transition-all duration-300 flex flex-col pl-4 space-y-1 text-gray-500">
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'it-services') }}">IT
                            Services</a></li>
                    <li class="my-2"><a class="mobile-link"
                            href="{{ route('services.companies', 'cybersecurity') }}">Cybersecurity</a>
                    </li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'data-analytics') }}">Data
                            Analytics</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'managed-it-services') }}">Managed
                            IT
                            Services</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'cloud-consulting') }}">Cloud
                            Consulting</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'staff-augmentation') }}">Staff
                            Augmentation</a></li>
                </ul>
            </div>

            <div class="mobile-menu-item">
                <button
                    class="mobile-drop w-full text-left flex justify-between items-center py-2 px-3 rounded hover:bg-lime-50">
                    Marketing <span class="transform transition-transform"><svg
                            class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg></span>
                </button>
                <ul
                    class="mobile-submenu max-h-0 overflow-hidden transition-all duration-300 flex flex-col pl-4 space-y-1  text-gray-500">
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'digital-marketing') }}">Digital
                            Marketing</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'seo') }}">SEO</a>
                    </li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'social-media-marketing') }}">Social
                            Media Marketing</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'mobile-marketing') }}">Mobile
                            Marketing</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'content-marketing') }}">Content
                            Marketing</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'search-marketing') }}">Search
                            Marketing</a></li>
                </ul>
            </div>

            <div class="mobile-menu-item">
                <button
                    class="mobile-drop w-full text-left flex justify-between items-center py-2 px-3 rounded hover:bg-lime-50">
                    Design <span class="transform transition-transform"><svg
                            class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg></span>
                </button>
                <ul
                    class="mobile-submenu max-h-0 overflow-hidden transition-all duration-300 flex flex-col pl-4  text-gray-500">
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'web-design') }}">Web
                            Design</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'user-experience-design') }}">User
                            Experience Design</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'logo-design') }}">Logo
                            Design</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'graphic-design') }}">Graphic
                            Design</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'design') }}">Design</a>
                    </li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'digital-design') }}">Digital
                            Design</a></li>
                </ul>
            </div>
            <div class="mobile-menu-item">
                <button
                    class="mobile-drop w-full text-left flex justify-between items-center py-2 px-3 rounded hover:bg-lime-50">
                    Business <span class="transform transition-transform"><svg
                            class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg></span>
                </button>
                <ul
                    class="mobile-submenu max-h-0 overflow-hidden transition-all duration-300 flex flex-col pl-4  text-gray-500">
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'call-centers') }}">Call
                            Centers</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'bpo') }}">BPO</a>
                    </li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'accounting') }}">Accounting</a>
                    </li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'commercial-real-estate') }}">Commercial
                            Real Estate</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'hr-services') }}">HR
                            Services</a></li>
                    <li class="my-2"> <a class="mobile-link"
                            href="{{ route('services.companies', 'consulting') }}">Consulting</a>
                    </li>
                </ul>
            </div>

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

{{-- <header class="w-full border-b-2 border-lime-700 fixed z-50 bg-white">

    <nav class="navbar relative">
        <div class="flex justify-between items-center px-10 py-1 ">
            <a class="w-20 h-20 ">
                <img class="w-full h-full object-contain shrink-0" src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <button id="mobile-menu-btn" class="lg:hidden text-xl">☰</button>
            <div class="gap-3 hidden lg:flex lg:items-center ">
                <div class="desktop-menu flex gap-6 relative">
                    <a class="category-link cursor-pointer" data-target="development">Development</a>
                    <a class="category-link cursor-pointer" data-target="it_services">IT Services</a>
                    <a class="category-link cursor-pointer" data-target="marketing">Marketing</a>
                    <a class="category-link cursor-pointer" data-target="design">Design</a>
                    <a class="category-link cursor-pointer">Business Services</a>
                    <a class="category-link cursor-pointer">Pricing & Packages</a>
                    <a class="category-link cursor-pointer">Resources</a>
                </div>

                <div class="hidden xl:flex gap-2">
                    <button
                        class="border border-lime-700 text-lime-700 px-4 py-2 rounded-md hover:bg-lime-700 hover:text-white transition">Submit
                        Your Company</button>
                </div>
            </div>
        </div>


        <div id="mobile-menu" class="lg:hidden hidden flex-col px-6 pb-4 bg-white border-t-2 border-lime-700">
            <div id="mobile-main-menu">
                <a
                    class="mobile-category py-3 flex justify-between items-center text-lime-900 font-bold text-base hover:text-lime-600"
                    data-target="development">
                    Development <span>›</span>
                </a>
                <a
                    class="mobile-category py-3 flex justify-between items-center text-lime-900 font-bold text-base hover:text-lime-600"
                    data-target="it_services">
                    IT Services <span>›</span>
                </a>
                <a
                    class="mobile-category py-3 flex justify-between items-center text-lime-900 font-bold text-base hover:text-lime-600"
                    data-target="marketing">
                    Marketing <span>›</span>
                </a>
                <a
                    class="mobile-category py-3 flex justify-between items-center text-lime-900 font-bold text-base hover:text-lime-600"
                    data-target="design">
                    Design <span>›</span>
                </a>
                <a class="py-3 block text-lime-900 font-bold text-base hover:text-lime-600">Business
                    Services</a>
                <a class="py-3 block text-lime-900 font-bold text-base hover:text-lime-600">Pricing &
                    Packages</a>
                <a class="py-3 block text-lime-900 font-bold text-base hover:text-lime-600">Resources</a>
            </div>

  
            <div id="mobile-submenu" class="hidden flex-col">
                <button id="back-to-main-menu" class="py-4 text-left font-bold text-lime-700 flex items-center gap-2">
                    ← Back to Menu
                </button>
                <div id="submenu-content" class="max-h-[calc(100vh-180px)]  overflow-y-auto"></div>
            </div>
        </div>



        <div class="max-w-[1000px]">
            @include('shared.partials.mega-menus')
        </div>

    </nav>

</header>


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const mobileMenuBtn = document.getElementById("mobile-menu-btn");
            const mobileMenu = document.getElementById("mobile-menu");
            const mainMenu = document.getElementById("mobile-main-menu");
            const submenu = document.getElementById("mobile-submenu");
            const submenuContent = document.getElementById("submenu-content");
            const backBtn = document.getElementById("back-to-main-menu");

            mobileMenuBtn.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
                document.body.classList.toggle("menu-open");
            });

            document.querySelectorAll(".mobile-category").forEach(link => {
                link.addEventListener("click", (e) => {
                    e.preventDefault();
                    const target = link.dataset.target;

                    const desktopMegaMenu = document.getElementById(target + "-menu");
                    if (desktopMegaMenu) {
                        submenuContent.innerHTML = desktopMegaMenu.innerHTML;
                    } else {
                        submenuContent.innerHTML =
                            "<p class='p-6 text-gray-500'>No items available</p>";
                    }

                    mainMenu.classList.add("hidden");
                    submenu.classList.remove("hidden");
                });
            });

            backBtn.addEventListener("click", () => {
                submenu.classList.add("hidden");
                mainMenu.classList.remove("hidden");
            });

            document.addEventListener("click", (e) => {
                if (!e.target.closest("nav") && !mobileMenu.classList.contains("hidden")) {
                    mobileMenu.classList.add("hidden");
                    document.body.classList.remove("menu-open");
                }
            });

            const categories = document.querySelectorAll(".category-link");
            const megaMenus = document.querySelectorAll(".mega-menu");

            categories.forEach(cat => {
                cat.addEventListener("click", () => {
                    const targetId = cat.dataset.target;
                    if (targetId) {
                        megaMenus.forEach(menu => {
                            if (menu.id === targetId + "-menu") {
                                menu.classList.remove("hidden");
                                menu.classList.add("flex");
                            } else {
                                menu.classList.add("hidden");
                                menu.classList.remove("flex");
                            }
                        });
                    }
                });
            });

            document.addEventListener("click", (e) => {
                if (!e.target.closest(".category-link") && !e.target.closest(".mega-menu")) {
                    megaMenus.forEach(menu => {
                        menu.classList.remove("flex");
                        menu.classList.add("hidden");
                    });
                }
            });
            window.addEventListener("resize", () => {
                megaMenus.forEach(menu => {
                    menu.classList.remove("flex");
                    menu.classList.add("hidden");
                });
                 submenu.classList.add("hidden");
                mainMenu.classList.remove("hidden");
                
   
            });
        });
    </script>
@endpush --}}
