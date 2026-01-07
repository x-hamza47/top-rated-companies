<!-- Header -->
<header class="dashboard-header">
    <!-- Header Content -->
    <div class="dashboard-header-content">
        <button class="dashboard-sidebar-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h1 class="dashboard-header-title" id="dashboardTitle">@yield('title', 'Dashboard')</h1>
    </div>
    <!-- Search Container -->
    <div class="search-container" id="searchContainer">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="search" class="search-input form-input" placeholder="Search projects, tasks, reports..."
            id="searchInput" />
        <button class="search-close btn" id="searchClose">
            <i class="fa-solid fa-x"></i>
        </button>
    </div>
    <div class="dashboard-header-actions">
        <!-- ! Mobile Search Button -->
        <button class="mobile-search-btn btn" id="mobileSearchBtn">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        @php
            if (Auth::user()->role === 'admin') {
                $unreadCount = Auth::user()->unreadNotifications->where('type', 'contact-message')->count();
                $link = route('contact.index');
            }
            // else {

            //     $unreadCount = Auth::user()->inquiries()->where('status', 'pending')->count();
            //     $link = route('company.inquiries.index');
            // }
        @endphp
        <div class="notification-button">
            <a href="{{ $link }}" class="notification-button cursor-pointer">
                <i class="fa-regular fa-bell"></i>
                @if ($unreadCount > 0)
                    <span
                        class="notification-badge">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>
        </div>

        <!-- User Profile -->
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
    </div>
</header>
