<div class="content-wrapper" style="padding-top: 2rem;">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-3">Tổng Doanh Thu</h6>
                            <h2 class="display-6 fw-bold mb-3">
                                ${{ number_format($statistics['total_revenue'], 2) }}
                            </h2>
                            <div class="text-success">
                                <i class="mdi mdi-trending-up"></i> Tất cả thời gian
                            </div>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4">
                            <i class="mdi mdi-currency-usd text-primary fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-3">Doanh Thu Kỳ Này</h6>
                            <h2 class="display-6 fw-bold mb-3">
                                ${{ number_format($statistics['period_revenue'], 2) }}
                            </h2>
                            <div class="text-info">
                                <i class="mdi mdi-calendar"></i>
                                {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-4">
                            <i class="mdi mdi-chart-line text-info fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-3">Tổng Đơn Tour</h6>
                            <h2 class="display-6 fw-bold mb-3">
                                {{ number_format($statistics['total_bookings']) }}
                            </h2>
                            <div class="text-warning">
                                <i class="mdi mdi-cart"></i> Đã thanh toán
                            </div>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle p-4">
                            <i class="mdi mdi-receipt text-warning fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-3">Giá Trị Trung Bình</h6>
                            <h2 class="display-6 fw-bold mb-3">
                                ${{ number_format($statistics['avg_booking_value'], 2) }}
                            </h2>
                            <div class="text-danger">
                                <i class="mdi mdi-chart-areaspline"></i> Mỗi n tour
                            </div>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-circle p-4">
                            <i class="mdi mdi-chart-bar text-danger fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Biểu Đồ Doanh Thu Hôm Nay</h5>
            <div id="revenueChart" style="height: 400px;"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);
            console.log('Chart Data:', chartData);

            const options = {
                series: [{
                    name: 'Doanh thu',
                    data: chartData.map(item => parseInt(item.total))
                }],
                chart: {
                    type: 'area',
                    height: 400,
                    toolbar: {
                        show: true,
                        tools: {
                            download: true,
                            selection: true,
                            zoom: true,
                            zoomin: true,
                            zoomout: true,
                            pan: true,
                            reset: true,
                            customIcons: []
                        },
                        export: {
                            csv: {
                                filename: 'doanh-thu',
                                columnDelimiter: ',',
                                headerCategory: 'Thời gian',
                                headerValue: 'Doanh thu'
                            },
                            svg: {
                                filename: 'bieu-do-doanh-thu'
                            },
                            png: {
                                filename: 'bieu-do-doanh-thu'
                            }
                        }
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
                    categories: chartData.map(item => `${item.hour}:00`)
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            value = value / 24500;
                            if (value >= 1000000) {
                                return '$' + (value / 1000000).toFixed(1) + 'M';
                            } else if (value >= 1000) {
                                return '$' + (value / 1000).toFixed(0) + 'K';
                            }
                            return '$' + value.toFixed(0);
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return '$' + new Intl.NumberFormat('en-US').format((value / 24500).toFixed(2));
                        }
                    }
                },
                colors: ['#4CAF50'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                        stops: [0, 90, 100]
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
            chart.render();
        });
    </script>
@endpush
