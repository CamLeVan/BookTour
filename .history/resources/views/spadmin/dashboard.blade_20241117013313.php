@extends('layouts.spadmin')

@section('title', 'Dashboard | HC Travel Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Ecommerce</h4>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="row">
        <div class="col-md-12 col-xl-8">
            <div class="card">
                <!-- ... Sales Report card content ... -->
            </div>
        </div>

        <div class="col-md-12 col-xl-4">
            <div class="card">
                <!-- ... Sales by Country card content ... -->
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Top Selling Products -->
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <!-- ... Top Selling Products card content ... -->
            </div>
        </div>

        <!-- Repeat Customer Rate -->
        <div class="col-md-6 col-xl-8">
            <div class="card">
                <!-- ... Repeat Customer Rate card content ... -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Apexcharts JS -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <!-- Widgets Init Js -->
    <script src="assets/js/pages/ecommerce-dashboard.init.js"></script>
@endpush
