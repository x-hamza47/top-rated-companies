<header class="w-full border-b-2 border-lime-700 fixed z-9999 bg-(--color-background)">
    <div class="mx-auto flex items-center justify-between h-20 px-4 md:px-10">
        <div class="w-16 h-16 shrink-0 mr-7">
            <img class="w-full h-full object-contain" src="{{ asset('images/logo-new.png') }}" alt="Logo">
        </div>
        <nav class="navbar">
            <a href="{{ route('home.index') }}"
                class="nav-link flex items-center gap-2 {{ Route::is('home.index') ? 'active' : '' }}">
                <i class="fa-solid fa-house text-xl nav-icon"></i>
                <span>Home</span>
            </a>

            @foreach ($navCategories as $category)
                <div class="relative group menu-item w-max dropdown-container">
                    <button class="nav-link flex items-center justify-between w-full gap-2">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid {{ $category->icon }} text-xl nav-icon"></i>
                            <span>{{ $category->name }}</span>
                        </div>

                        <i
                            class="fa-solid fa-chevron-down nav-icon text-white text-lg transition-transform duration-300"></i>
                    </button>
                    @if ($category->services->count())
                        <div class="menu-dropdown">
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
            <a href="{{ route('insights.list') }}" class="nav-link flex items-center gap-2">
                <i class="fa-solid fa-blog text-xl nav-icon"></i>
                <span>Blogs</span>
            </a>
            @guest
                <div class="flex items-center xl:ml-auto justify-between max-xl:px-4 max-xl:w-full"> 
                    <i class="fa-solid fa-palette nav-icon  xl:hidden!"></i>
                    <div class="theme-toggle xl:mr-2" id="theme-toggle">
                        <div class="theme-option active" data-theme="light">
                            Light
                        </div>
                        <div class="theme-option" data-theme="dark">Dark</div>
                    </div>
                </div>
            @endguest
        </nav>
        @auth
            <div class="user-menu dropdown">
                <div class="user-menu-trigger dropdown-toggle">
                    <div class="user-avatar-small">
                        <img src="{{ auth()->user()->profile_image
                            ? (Str::startsWith(auth()->user()->profile_image, 'http')
                                ? auth()->user()->profile_image
                                : asset('storage/' . auth()->user()->profile_image))
                            : asset('images/dummy.jpg') }}"
                            alt="User Avatar" />
                    </div>
                </div>
                <div class="user-menu-dropdown dropdown-menu">
                    <a href="{{ route('user.index') }}" class="user-menu-item">
                        <i class="fa-solid fa-user icon"></i>
                        <div class="flex flex-col">
                            <span>Profile</span>
                            <small class="text-(--color-muted)">{{ auth()->user()->firstName }}
                                {{ auth()->user()->lastName }}</small>
                        </div>
                    </a>
                    <!-- Theme Toggle inside dropdown -->
                    <div class="user-menu-item theme-item">
                        <i class="fa-solid fa-palette icon"></i>
                        <div class="theme-toggle" id="theme-toggle">
                            <div class="theme-option active" data-theme="light">
                                Light
                            </div>
                            <div class="theme-option" data-theme="dark">Dark</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.logout') }}" class="user-menu-item">
                        <i class="fa-solid fa-arrow-right-from-bracket icon"></i>
                        <span>Sign Out</span>
                    </a>
                </div>
            </div>
        @endauth
        @guest
            <div class="hidden xl:flex gap-2 font-semibold">
                <a class="btn-primary flex items-center gap-2 px-4 py-1 rounded-md" href="{{ route('login') }}">
                    <i class="fa-solid fa-circle-user text-lg text-white"></i> Sign In</a>
                <a class="btn-outline-primary px-4 py-1 rounded-md" href="{{ route('register.show') }}">Join</a>
            </div>
        @endguest

        <div class="block xl:hidden">
            <button id="mobile-menu-btn" class="text-(--color-text) text-2xl">
                <i id="menu-icon" class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</header>
