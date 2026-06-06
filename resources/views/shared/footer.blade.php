<footer class="px-6 md:px-16 lg:px-24 xl:px-32 bg-zinc-900 w-full">
    <div
        class="flex flex-col md:flex-row items-start justify-between gap-10 py-10 border-b border-gray-500/30 text-gray-500">
        <div>
            <img class="w-34 md:w-32" src="{{ asset('images/logo-new.webp') }}" alt="logo" width="128"
                height="40" />
            <ul class="text-sm space-y-3 mt-6 text-gray-400">
                <li class="flex items-start gap-3 ">
                    <i class="fa-solid fa-location-dot mt-1 text-lime-600"></i>
                    <span>
                        Business Center Sharjah Publishing City Free Zone, Sharjah, UAE
                    </span>
                </li>

                <li class="flex items-center gap-3">
                    <i class="fa-solid fa-phone text-lime-600"></i>
                    <a href="tel:+971567716432" class="hover:underline">
                        +971 56 771 6432
                    </a>
                </li>

                <li class="flex items-center gap-3">
                    <i class="fa-solid fa-envelope text-lime-600"></i>
                    <a href="mailto:info@topfirmsreviewer.com" class="hover:underline">
                        info@topfirmsreviewer.com
                    </a>
                </li>
            </ul>
            <div class="flex items-center gap-3 mt-6">
                <a href="https://www.facebook.com/profile.php?id=61590606452636" target="_blank" rel="noopener noreferrer"
                    class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-zinc-800 text-gray-400 hover:bg-lime-600 hover:text-white transition-colors duration-200">
                    <i class="fa-brands fa-facebook-f text-xs sm:text-base"></i>
                </a>
                {{-- <a href="#" target="_blank" rel="noopener noreferrer"
                    class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-zinc-800 text-gray-400 hover:bg-lime-600 hover:text-white transition-colors duration-200">
                    <i class="fa-brands fa-x-twitter text-xs sm:text-base"></i>
                </a> --}}
                <a href="https://www.linkedin.com/company/top-firms-reviewer/" target="_blank" rel="noopener noreferrer"
                    class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-zinc-800 text-gray-400 hover:bg-lime-600 hover:text-white transition-colors duration-200">
                    <i class="fa-brands fa-linkedin-in text-xs sm:text-base"></i>
                </a>
                <a href="#" target="_blank" rel="noopener noreferrer"
                    class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-zinc-800 text-gray-400 hover:bg-lime-600 hover:text-white transition-colors duration-200">
                    <i class="fa-brands fa-instagram text-xs sm:text-base"></i>
                </a>
            </div>
        </div>

        {{-- Quick Links --}}
        <div>
            <h3 class="font-semibold text-base text-(--color-primary-hover) md:mb-5 mb-2">Quick Links</h3>
            <ul class="text-sm space-y-2">
                <li><a href="{{ route('home.index') }}" class="hover:underline">Home</a></li>
                <li><a href="{{ route('insights.list') }}" class="hover:underline">Blogs</a></li>
                <li><a href="{{ route('contact.showForm') }}" class="hover:underline">Contact Us</a></li>
                <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                <li><a href="{{ route('register.show') }}" class="hover:underline">Register</a></li>
            </ul>
        </div>


        <div>
            <h3 class="font-semibold text-base text-(--color-primary-hover) md:mb-5 mb-2">Top Categories</h3>
            <ul class="text-sm space-y-2">
                @foreach ($navCategories->take(3) as $category)
                    <h4 class="text-white mt-3">{{ $category->name }}</h4>
                    <ul class="text-sm space-y-1">
                        @foreach ($category->services->take(3) as $service)
                            <li>
                                <a href="{{ route('services.companies', $service->slug) }}" class="hover:underline">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </ul>
        </div>

        {{-- Legal --}}
        <div>
            <h3 class="font-semibold text-base text-(--color-primary-hover) md:mb-5 mb-2">Legal</h3>
            <ul class="text-sm space-y-2">
                <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                <li><a href="{{ route('cookies') }}">Cookie Policy</a></li>
            </ul>
        </div>

    </div>

    {{-- Bottom --}}
    <div class="py-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} TopFirms. All Rights Reserved.
    </div>

    <div class="text-center text-xs text-gray-400 pb-4">
        <a href="https://hamzaamir-portfolio.web.app/" target="_blank" class="hover:underline">
            Designed & Developed by Hamza
        </a>
    </div>
</footer>
