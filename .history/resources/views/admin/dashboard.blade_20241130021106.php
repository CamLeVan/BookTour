@extends('layouts.admin')

@section('title', 'Dashboard | HC Travel Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="row">
        <div class="col-md-12 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="git-commit" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Sales Report</h5>
                    </div>
                </div>




                <div class="card-body">
                    <div id="chart-money" class="apex-charts"></div>
                </div>
            </div>
        </div>




        <div class="col-md-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="pie-chart" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Sales by Country</h5>
                    </div>
                </div>




                <div class="card-body">
                    <div id="sales-country" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <!-- Top Selling Products -->
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="cpu" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Top Selling Products</h5>
                    </div>
                </div>




                <!-- start card body -->
                <div class="card-body">
                    <ul class="list-group custom-group">
                        <li class="list-group-item align-items-center d-flex justify-content-between">
                            <div class="product-list">
                                <img class="avatar-md p-1 rounded-circle bg-primary-subtle img-fluid me-3"
                                    src="{{ asset('assets/images/products/shoes.jpg') }}" alt="product-image" />




                                <div class="product-body align-self-center">
                                    <h6 class="m-0 fw-semibold">Nike Shoes</h6>
                                    <p class="mb-0 mt-1 text-muted">Fashion</p>
                                </div>
                            </div>




                            <div class="product-price">
                                <h6 class="m-0 fw-semibold">$990</h6>
                                <p class="mb-0 mt-1 text-muted">10 Sold</p>
                            </div>
                        </li>




                        <li class="list-group-item align-items-center d-flex justify-content-between border-bottom">
                            <div class="product-list">
                                <img class="avatar-md p-1 rounded-circle bg-primary-subtle img-fluid me-3"
                                    src="{{ asset('assets/images/products/bags.jpg') }}" alt="product-image" />




                                <div class="product-body align-self-center">
                                    <h6 class="m-0 fw-semibold">Shoulder Bag</h6>
                                    <p class="mb-0 mt-1 text-muted">Fashion</p>
                                </div>
                            </div>




                            <div class="product-price">
                                <h6 class="m-0 fw-semibold">$650</h6>
                                <p class="mb-0 mt-1 text-muted">11 Sold</p>
                            </div>
                        </li>




                        <li class="list-group-item align-items-center d-flex justify-content-between border-bottom">
                            <div class="product-list">
                                <img class="avatar-md p-1 rounded-circle bg-primary-subtle img-fluid me-3"
                                    src="{{ asset('assets/images/products/dresses.jpg') }}" alt="product-image" />




                                <div class="product-body align-self-center">
                                    <h6 class="m-0 fw-semibold">Velvet Red Dresse</h6>
                                    <p class="mb-0 mt-1 text-muted">Fashion</p>
                                </div>
                            </div>




                            <div class="product-price">
                                <h6 class="m-0 fw-semibold">$480</h6>
                                <p class="mb-0 mt-1 text-muted">08 Sold</p>
                            </div>
                        </li>




                        <li class="list-group-item align-items-center d-flex justify-content-between border-bottom">
                            <div class="product-list">
                                <img class="avatar-md p-1 rounded-circle bg-primary-subtle img-fluid me-3"
                                    src="{{ asset('assets/images/products/headphone.jpg') }}" alt="product-image" />




                                <div class="product-body align-self-center">
                                    <h6 class="m-0 fw-semibold">Fashion dresse</h6>
                                    <p class="mb-0 mt-1 text-muted">Fashion</p>
                                </div>
                            </div>




                            <div class="product-price">
                                <h6 class="m-0 fw-semibold">$1500</h6>
                                <p class="mb-0 mt-1 text-muted">14 Sold</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- end card body -->
            </div>
        </div>




        <!-- Top Selling Products -->
        <div class="col-md-6 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                            <i data-feather="bar-chart" class="widgets-icons"></i>
                        </div>
                        <h5 class="card-title mb-0">Repeat Customer Rate</h5>
                    </div>
                </div>




                <div class="card-body">
                    <div id="repeat-customer" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Apexcharts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <!-- Widgets Init Js -->
    <script src="{{ asset('assets/js/pages/ecommerce-dashboard.init.js') }}"></script>
@endpush
