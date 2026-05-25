@extends('dashboard.layout.main')
@section('title', 'Admin Dashboard')

@section('content')

    {{-- ! KPI Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-title">Total Companies</div>
                <div class="stat-card-icon primary">
                    <i class="fa-solid fa-building"></i>
                </div>
            </div>
            <div class="stat-card-value">{{ $totalCompanies }}</div>
            <div class="stat-card-change positive">
                <span>{{ $verifiedCompanies }} verified &bull; {{ $listedCompanies }} listed</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-title">Total Users</div>
                <div class="stat-card-icon info">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="stat-card-value">{{ $totalUsers }}</div>
            <div class="stat-card-change positive">
                <span>{{ $regularUsers }} users &bull; {{ $companyUsers }} companies</span>
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
            <div class="stat-card-change {{ $pendingReviews > 0 ? 'negative' : 'positive' }}">
                <i class="fa-solid {{ $pendingReviews > 0 ? 'fa-arrow-trend-down' : 'fa-arrow-trend-up' }}"></i>
                <span>{{ $pendingReviews }} pending verification</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-title">Inquiries</div>
                <div class="stat-card-icon warning">
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
                <div class="stat-card-title">Contact Us</div>
                <div class="stat-card-icon warning">
                    <i class="fa-solid fa-message"></i>
                </div>
            </div>
            <div class="stat-card-value">{{ $totalContacts }}</div>
            <div class="stat-card-change {{ $pendingContacts > 0 ? 'negative' : 'positive' }}">
                <i class="fa-solid {{ $pendingContacts > 0 ? 'fa-arrow-trend-down' : 'fa-arrow-trend-up' }}"></i>
                <span>{{ $pendingContacts }} pending</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card-header">
                <div class="stat-card-title">Platform Views</div>
                <div class="stat-card-icon primary">
                    <i class="fa-solid fa-eye"></i>
                </div>
            </div>
            <div class="stat-card-value">{{ number_format($totalPlatformViews) }}</div>
            <div class="stat-card-change positive">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <span>{{ number_format($todayPlatformViews) }} today</span>
            </div>
        </div>
    </div>

    {{-- ! Charts Row 1 --}}
    <div class="chart-grid">
        <div class="chart-card">
            <div class="chart-card-header">
                <h3 class="chart-card-title">New Registrations</h3>
                <p class="chart-card-subtitle">Last 30 days</p>
            </div>
            <div class="chart-container" style="overflow: hidden;">
                <div id="registrationsChart"></div>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-card-header">
                <h3 class="chart-card-title">Platform Views</h3>
                <p class="chart-card-subtitle">Last 30 days</p>
            </div>
            <div class="chart-container" style="overflow: hidden;">
                <div id="platformViewsChart"></div>
            </div>
        </div>
    </div>

    {{-- ! Charts Row 2 --}}
    <div class="chart-grid">
        <div class="chart-card">
            <div class="chart-card-header">
                <h3 class="chart-card-title">Reviews by Rating</h3>
                <p class="chart-card-subtitle">All time distribution</p>
            </div>
            <div class="chart-container" style="overflow: hidden;">
                <div id="ratingsChart"></div>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-card-header">
                <h3 class="chart-card-title">Traffic by Hour</h3>
                <p class="chart-card-subtitle">All time — peak hours across platform</p>
            </div>
            <div class="chart-container" style="overflow: hidden;">
                <div id="hoursChart"></div>
            </div>
        </div>
    </div>

    {{-- ! Charts Row 3 - Full width --}}
    <div class="chart-grid">
        <div class="chart-card" style="grid-column: 1 / -1;">
            <div class="chart-card-header">
                <h3 class="chart-card-title">Top Companies by Views</h3>
                <p class="chart-card-subtitle">All time</p>
            </div>
            <div class="chart-container" style="overflow: hidden;">
                <div id="topCompaniesChart"></div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        window.registrationDates  = @json($registrationDates);
        window.registrationCounts = @json($registrationCounts);
        window.platformViewDates  = @json($platformViewDates);
        window.platformViewCounts = @json($platformViewCounts);
        window.ratingLabels       = @json($ratingLabels);
        window.ratingCounts       = @json($ratingCounts);
        window.topCompanyLabels   = @json($topCompanyLabels);
        window.topCompanyCounts   = @json($topCompanyCounts);
        window.hourLabels         = @json($hourLabels);
        window.hourCounts         = @json($hourCounts);
    </script>
    @vite('resources/js/dashboard/admin-chart.js')
@endpush