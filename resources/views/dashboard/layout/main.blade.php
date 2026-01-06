{{-- Info: Header --}}
@include('dashboard.partials.head')

<div class="dashboard-container">
    {{-- * Sidebar --}}
    @include('dashboard.partials.sidebar')
    {{-- ! Main --}}
    <main class="dashboard-main ">
        @include('dashboard.partials.mainHeader')

        {{-- ! Content --}}
        <div class="dashboard-content relative">
            <div class="dashboard-view ">
                @include('badgeAlert')
                @yield('content')
            </div>
        </div>
    </main>
</div>


{{-- Info: Footer --}}
@include('dashboard.partials.footer')
