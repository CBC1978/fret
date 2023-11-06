<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="msapplication-TileColor" content="#0E0E0E">
<meta name="template-color" content="#0E0E0E">
<link rel="manifest" href="manifest.json" crossorigin>
<meta name="msapplication-config" content="browserconfig.xml">
<meta name="description" content="Index page">
<meta name="keywords" content="index, page">
<meta name="author" content="">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('src/dashboard/imgs/template/favicon.svg') }}">
<link href="{{ asset('src/css/style.css?version=4.1') }}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('src/js/carrier/contract.js') }}"></script>

    @yield('styles')
</head>
<body>
    @include('layouts.carrier.carrier_header')
    <main class="main">
        @include('layouts.carrier.carrier_sidebar')

        <div class="box-content">
            @yield('content')
        </div>
    </main>
</body>
<script src="{{ asset('src/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('src/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{asset('src/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('src/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('src/js/plugins/waypoints.js')}}"></script>
<script src="{{asset('src/js/plugins/magnific-popup.js')}}"></script>
<script src="{{asset('src/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('src/js/plugins/select2.min.js')}}"></script>
<script src="{{asset('src/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{asset('src/js/plugins/jquery.circliful.js')}}"></script>
<script src="{{asset('src/js/plugins/charts/index.js')}}"></script>
<script src="{{asset('src/js/plugins/charts/xy.js')}}"></script>
<script src="{{asset('src/js/plugins/charts/Animated.js')}}"></script>
<script src="{{asset('src/js/plugins/armcharts5-script.js')}}"></script>
<script src="{{asset('src/js/main.js?v=4.1')}}"></script>
<script src="{{asset('src/js/carrier/contract.js') }}"></script>
@yield('script')
</html>
