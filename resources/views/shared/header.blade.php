{{-- <header class="w-full border-b-2 border-lime-700 fixed z-50 bg-white">
    <div class="max-w-[1920px] mx-auto flex items-center justify-between h-20 px-4 md:px-10">
     
        <div class="w-20 h-20 shrink-0 mr-7">
            <img class="w-full h-full object-contain" src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>

        
        <nav class="hidden xl:flex items-center gap-1 text-gray-700 font-medium flex-1">
            <a href="#" class="transition text-nowrap hover:bg-lime-800 hover:text-white px-3 py-1 rounded-full">Development</a>
            <a href="#" class="transition text-nowrap  hover:bg-lime-800 hover:text-white px-3 py-1 rounded-full">IT Services</a>
            <a href="#" class="transition text-nowrap  hover:bg-lime-800 hover:text-white px-3 py-1 rounded-full">Marketing</a>
            <a href="#" class="transition text-nowrap  hover:bg-lime-800 hover:text-white px-3 py-1 rounded-full">Design</a>
            <a href="#" class="transition text-nowrap  hover:bg-lime-800 hover:text-white px-3 py-1 rounded-full">Business Services</a>
            <a href="#" class="transition text-nowrap  hover:bg-lime-800 hover:text-white px-3 py-1 rounded-full">Pricing & Packages</a>
            <a href="#" class="transition text-nowrap  hover:bg-lime-800 hover:text-white px-3 py-1 rounded-full">Resources</a>
        </nav>

        
        <div class="hidden xl:flex gap-2">
            <button class="bg-lime-700 text-white px-4 py-2 rounded-md hover:bg-lime-600 transition">Category</button>
            <button class="border border-lime-700 text-lime-700 px-4 py-2 rounded-md hover:bg-lime-700 hover:text-white transition">Submit Your Company</button>
        </div>

        
        <div class="block xl:hidden">
            <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

 
    <div id="mobile-menu" class="fixed top-0 right-0 h-full w-3/4 max-w-xs bg-white shadow-xl transform translate-x-full transition-transform duration-300 xl:hidden z-50 overflow-y-auto">
        
        <div class="flex justify-between items-center px-6 py-4 border-b border-lime-700">
            <div class="w-20 h-20 shrink-0">
                <img class="w-full h-full object-contain" src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            <button id="mobile-menu-close" class="text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

      
        <nav class="flex flex-col gap-4 px-6 py-6 text-gray-700 font-medium">
            <a href="#" class="hover:text-lime-700 transition text-lg hover:bg-amber-300">Development</a>
            <a href="#" class="hover:text-lime-700 transition text-lg">IT Services</a>
            <a href="#" class="hover:text-lime-700 transition text-lg">Marketing</a>
            <a href="#" class="hover:text-lime-700 transition text-lg">Design</a>
            <a href="#" class="hover:text-lime-700 transition text-lg">Business Services</a>
            <a href="#" class="hover:text-lime-700 transition text-lg">Pricing & Packages</a>
            <a href="#" class="hover:text-lime-700 transition text-lg">Resources</a>
        </nav>

        
        <div class="flex flex-col gap-3 px-6 mt-4">
            <button class="bg-lime-700 text-white px-4 py-2 rounded-md hover:bg-lime-600 transition">Category</button>
            <button class="border border-lime-700 text-lime-700 px-4 py-2 rounded-md hover:bg-lime-700 hover:text-white transition">Submit Your Company</button>
        </div>
    </div>
</header>

@push('scripts')
<script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const closeBtn = document.getElementById('mobile-menu-close');

    btn.addEventListener('click', () => {
        menu.classList.remove('translate-x-full');
    });

    closeBtn.addEventListener('click', () => {
        menu.classList.add('translate-x-full');
    });
</script>

@endpush --}}

<header class="w-full border-b-2 border-lime-700 fixed z-9999 bg-white">

    <nav class="navbar relative">
        <div class="flex justify-between items-center md:px-10 px-7 py-1 ">
            <a class="md:w-18 md:h-18 w-15 h-15 ">
                <img class="w-full h-full object-contain shrink-0" src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <button id="mobile-menu-btn" class="lg:hidden text-xl">☰</button>
            <div class="gap-3 hidden lg:flex lg:items-center ">
                <div class="desktop-menu flex gap-6 relative">
                    <a href="#" class="category-link" data-target="development">Development</a>
                    <a href="#" class="category-link" data-target="it_services">IT Services</a>
                    <a href="#" class="category-link" data-target="marketing">Marketing</a>
                    <a href="#" class="category-link" data-target="design">Design</a>
                    <a href="#" class="category-link">Business Services</a>
                    <a href="#" class="category-link">Pricing & Packages</a>
                    <a href="#" class="category-link">Resources</a>
                </div>

                <div class="hidden xl:flex gap-2">
                    {{-- <button
                        class="bg-lime-700 text-white px-4 py-2 rounded-md hover:bg-lime-600 transition">Category</button> --}}
                    <button
                        class="border border-lime-700 text-lime-700 px-4 py-2 rounded-md hover:bg-lime-700 hover:text-white transition">Submit
                        Your Company</button>
                </div>
            </div>
        </div>


        <div id="mobile-menu" class="lg:hidden hidden flex-col px-6 pb-4 bg-white border-t-2 border-lime-700">
            <div id="mobile-main-menu">
                <a href="#"
                    class="mobile-category py-3 flex justify-between items-center text-lime-900 font-bold text-base hover:text-lime-600"
                    data-target="development">
                    Development <span>›</span>
                </a>
                <a href="#"
                    class="mobile-category py-3 flex justify-between items-center text-lime-900 font-bold text-base hover:text-lime-600"
                    data-target="it_services">
                    IT Services <span>›</span>
                </a>
                <a href="#"
                    class="mobile-category py-3 flex justify-between items-center text-lime-900 font-bold text-base hover:text-lime-600"
                    data-target="marketing">
                    Marketing <span>›</span>
                </a>
                <a href="#"
                    class="mobile-category py-3 flex justify-between items-center text-lime-900 font-bold text-base hover:text-lime-600"
                    data-target="design">
                    Design <span>›</span>
                </a>
                <a href="#" class="py-3 block text-lime-900 font-bold text-base hover:text-lime-600">Business
                    Services</a>
                <a href="#" class="py-3 block text-lime-900 font-bold text-base hover:text-lime-600">Pricing &
                    Packages</a>
                <a href="#" class="py-3 block text-lime-900 font-bold text-base hover:text-lime-600">Resources</a>
            </div>

            {{-- Submenu Back Button + Content --}}
            <div id="mobile-submenu" class="hidden flex-col">
                <button id="back-to-main-menu" class="py-4 text-left font-bold text-lime-700 flex items-center gap-2">
                    ← Back to Menu
                </button>
                <div id="submenu-content" class="max-h-[calc(100vh-180px)]  overflow-y-auto"></div>
            </div>
        </div>


        {{-- Mega Menus --}}
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
@endpush


{{-- @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const mobileMenuBtn = document.querySelector("#mobile-menu-btn");
            const mobileMenu = document.querySelector("#mobile-menu");
            const categories = document.querySelectorAll(".category-link");
            const megaMenus = document.querySelectorAll(".mega-menu");

            mobileMenuBtn.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
            });

            categories.forEach(cat => {
                cat.addEventListener("click", (e) => {
                    e.preventDefault();
                    const targetId = cat.dataset.target;
                    megaMenus.forEach(menu => {
                        if (menu.id === targetId) {
                            menu.classList.toggle("flex");
                            menu.classList.toggle("hidden");
                        } else {
                            menu.classList.remove("flex");
                            menu.classList.add("hidden");
                        }
                    });
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
        });
    </script>
@endpush --}}
