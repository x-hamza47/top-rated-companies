@extends('dashboard.layout.main')

@section('content')

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-title">Total Projects</div>
                    <div class="stat-card-icon primary">
                        <i class="fa-regular fa-folder"></i>
                    </div>
                </div>
                <div class="stat-card-value">12</div>
                <div class="stat-card-change positive">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <span>+2 this week</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-title">Completed Tasks</div>
                    <div class="stat-card-icon success">
                        <i class="fa-regular fa-circle-check"></i>
                    </div>
                </div>
                <div class="stat-card-value">48</div>
                <div class="stat-card-change positive">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <span>+15% from last week</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-title">Pending Tasks</div>
                    <div class="stat-card-icon warning">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                </div>
                <div class="stat-card-value">23</div>
                <div class="stat-card-change negative">
                    <i class="fa-solid fa-arrow-trend-down"></i>
                    <span>-3 from last week</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-title">Team Members</div>
                    <div class="stat-card-icon info">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div class="stat-card-value">8</div>
                <div class="stat-card-change positive">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <span>+1 new member</span>
                </div>
            </div>
        </div>
        <!-- Charts -->
        <div class="chart-grid">
            <div class="chart-card">
                <div class="chart-card-header">
                    <h3 class="chart-card-title">Project Progress</h3>
                    <p class="chart-card-subtitle">Completion rate over time</p>
                </div>
                <div class="chart-container" style="overflow: hidden;">
                    <div id="progressChart"></div>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <h3 class="chart-card-title">Task Distribution</h3>
                    <p class="chart-card-subtitle">Tasks by category</p>
                </div>
                <div class="chart-container" style="overflow: hidden;">
                    <div id="categoryChart"></div>
                </div>
            </div>
        </div>

@endsection
@push('scripts')
    <!-- ! Apexcharts Cdn -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('dashboard-assets/js/charts.js') }}"></script>
@endpush
