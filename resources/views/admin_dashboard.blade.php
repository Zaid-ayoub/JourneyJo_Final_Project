@extends('source.template')

@section('dashboard_active', 'active')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="@if (auth()->check() && auth()->user()->role_id == 3) col-lg-8 @else col-lg-12 @endif">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Sales
                                    <select id="salesRevenueFilter" class="form-select form-select-sm d-inline-block w-auto" onchange="applyFilter()">
                                        <option value="today" @if ($salesRevenueFilter == 'today') selected @endif>Today</option>
                                        <option value="week" @if ($salesRevenueFilter == 'week') selected @endif>Week</option>
                                        <option value="month" @if ($salesRevenueFilter == 'month') selected @endif>Month</option>
                                        <option value="year" @if ($salesRevenueFilter == 'year') selected @endif>Year</option>
                                    </select>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $salesToday }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Revenue
                                    <select id="salesRevenueFilter" class="form-select form-select-sm d-inline-block w-auto" onchange="applyFilter()">
                                        <option value="today" @if ($salesRevenueFilter == 'today') selected @endif>Today</option>
                                        <option value="week" @if ($salesRevenueFilter == 'week') selected @endif>Week</option>
                                        <option value="month" @if ($salesRevenueFilter == 'month') selected @endif>Month</option>
                                        <option value="year" @if ($salesRevenueFilter == 'year') selected @endif>Year</option>
                                    </select>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>${{ number_format($revenueToday, 2) }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Customers
                                    <select id="customersFilter" class="form-select form-select-sm d-inline-block w-auto" onchange="applyFilter()">
                                        <option value="this_year" @if ($customersFilter == 'this_year') selected @endif>This Year</option>
                                        <option value="last_year" @if ($customersFilter == 'last_year') selected @endif>Last Year</option>
                                    </select>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $customersThisYear }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Customers Card -->

                    <!-- Reports Card -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/ Last Week</span></h5>
                                <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Sales',
                                                data: @json(array_values($salesData)),
                                            }, {
                                                name: 'Revenue',
                                                data: @json(array_values($revenueData)),
                                            }, {
                                                name: 'Customers',
                                                data: @json(array_values($customersData)),
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#c77943', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                categories: @json(array_keys($salesData)),
                                                type: 'datetime',
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy'
                                                }
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->
                            </div>
                        </div>
                    </div><!-- End Reports -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns (Recent Activity) -->
            @if (auth()->check() && auth()->user()->role_id == 3)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activity <span>| Today</span></h5>
                            <div class="activity">
                                @foreach ($recentActivities as $activity)
                                    <div class="activity-item d-flex">
                                        <div class="activite-label">{{ $activity->created_at->diffForHumans() }}</div>
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                        <div class="activity-content">
                                            <p><strong>{{ $activity->user->name }}</strong> booked <strong>{{ $activity->tour->name }}</strong></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div><!-- End Right side columns -->
            @endif
        </div>
    </section>
</main><!-- End #main -->

<script>
    function applyFilter() {
        const salesRevenueFilter = document.getElementById('salesRevenueFilter').value;
        const customersFilter = document.getElementById('customersFilter').value;
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('sales_revenue_filter', salesRevenueFilter);
        urlParams.set('customers_filter', customersFilter);
        window.location.search = urlParams.toString();
    }
</script>
@endsection
