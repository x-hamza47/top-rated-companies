@extends('dashboard.layout.main')
@section('title', 'Dashboard')

@section('content')

    @if (!$company)
        {{-- ! No Company State --}}
        <div class="flex flex-col items-center justify-center py-32 gap-4 text-center">
            <i class="fa-solid fa-building text-6xl text-(--color-muted)"></i>
            <h2 class="text-2xl font-semibold">No Company Found</h2>
            <p class="text-(--color-muted) max-w-md">You don't have a company linked to your account yet. Create one to get started or claim an existing one.</p>
            <a href="{{ route('companies.create') }}" class="bg-(--color-primary) text-white px-6 py-2 rounded-lg font-semibold hover:bg-(--color-secondary) transition">
                + Create Company
            </a>
        </div>
    @else
        {{-- ! KPI Cards --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-title">Profile Views</div>
                    <div class="stat-card-icon primary">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ number_format($totalViews) }}</div>
                <div class="stat-card-change positive">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <span>{{ $todayViews }} today</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-title">Inquiries</div>
                    <div class="stat-card-icon info">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ $totalInquiries }}</div>
                <div class="stat-card-change {{ $pendingInquiries > 0 ? 'negative' : 'positive' }}">
                    <i class="fa-solid {{ $pendingInquiries > 0 ? 'fa-arrow-trend-down' : 'fa-arrow-trend-up' }}"></i>
                    <span>{{ $pendingInquiries }} pending</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-title">Total Reviews</div>
                    <div class="stat-card-icon success">
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="stat-card-value">{{ $totalReviews }}</div>
                <div class="stat-card-change positive">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <span>{{ $averageRating }}★ average rating</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-title">Status</div>
                    <div class="stat-card-icon {{ $company->verified ? 'success' : 'warning' }}">
                        <i class="fa-solid {{ $company->verified ? 'fa-circle-check' : 'fa-clock' }}"></i>
                    </div>
                </div>
                <div class="stat-card-value text-base font-semibold">
                    {{ $company->verified ? 'Verified' : 'Unverified' }}
                </div>
                <div class="stat-card-change {{ $company->is_listed ? 'positive' : 'negative' }}">
                    <i class="fa-solid {{ $company->is_listed ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"></i>
                    <span>{{ $company->is_listed ? 'Listed publicly' : 'Not listed' }}</span>
                </div>
            </div>
        </div>

        {{-- ! Charts --}}
        <div class="chart-grid">
            <div class="chart-card">
                <div class="chart-card-header">
                    <h3 class="chart-card-title">Profile Views</h3>
                    <p class="chart-card-subtitle">Last 30 days</p>
                </div>
                <div class="chart-container" style="overflow: hidden;">
                    <div id="viewsChart"></div>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-card-header">
                    <h3 class="chart-card-title">Devices</h3>
                    <p class="chart-card-subtitle">All time breakdown</p>
                </div>
                <div class="chart-container" style="overflow: hidden;">
                    <div id="devicesChart"></div>
                </div>
            </div>
        </div>

        <div class="chart-grid">
            <div class="chart-card" style="grid-column: 1 / -1;">
                <div class="chart-card-header">
                    <h3 class="chart-card-title">Traffic by Hour</h3>
                    <p class="chart-card-subtitle">All time — peak visit hours</p>
                </div>
                <div class="chart-container" style="overflow: hidden;">
                    <div id="hoursChart"></div>
                </div>
            </div>
        </div>
    @endif

@endsection

@if ($company)
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            window.viewDates    = @json($viewDates);
            window.viewCounts   = @json($viewCounts);
            window.hourLabels   = @json($hourLabels);
            window.hourCounts   = @json($hourCounts);
            window.deviceLabels = @json($deviceLabels);
            window.deviceCounts = @json($deviceCounts);
        </script>
        @vite('resources/js/dashboard/company-chart.js')
    @endpush
@endif