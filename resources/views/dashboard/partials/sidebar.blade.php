@php
    function isActive($routeName) {
        return request()->routeIs($routeName) ? 'active' : '';
    }
@endphp

<aside class="dashboard-sidebar" id="dashboardSidebar">
    <div class="dashboard-brand">
        <button class="dashboard-sidebar-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <a class="logo">My Dashboard</a>
    </div>
    {{-- ! Navbar --}}
    <nav class="sidebar-nav">
        <ul class="primary-nav nav-list">
            {{-- Info: Nav-Links --}}
            <li class="nav-item {{ isActive('dashboard.index') }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i class="fa-solid fa-table-columns nav-icon"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ isActive('companies.*') }}">
                <a href="{{ route('companies.index') }}" class="nav-link">
                    <i class="fa-solid fa-building nav-icon"></i>
                    <span class="nav-label">Company</span>
                </a>
            </li>
            <li class="nav-item {{ isActive('insights.*') }}">
                <a href="{{ route('insights.index') }}" class="nav-link">
                    <i class="fa-solid fa-lightbulb nav-icon"></i>
                    <span class="nav-label">Insights</span>
                </a>
            </li>
        </ul>

        {{-- Info: Secondary Links --}}
        <ul class="secondary-nav nav-list">
            <li class="nav-item {{ isActive('user.*') }}">
                <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="fa-solid fa-user nav-icon"></i>
                    <span class="nav-label">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home.index') }}" class="nav-link sidebar-back-button btn-secondary">
                    <i class="fa-solid fa-house nav-icon"></i>
                    <span class="nav-label">Back to site</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<!-- Overlay -->
<div class="dashboard-sidebar-overlay" id="dashboardSidebarOverlay"></div>
