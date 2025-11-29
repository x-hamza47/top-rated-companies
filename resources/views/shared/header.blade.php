<header class="w-full border-b-2 border-lime-700 fixed z-50 bg-white">
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
@endpush
