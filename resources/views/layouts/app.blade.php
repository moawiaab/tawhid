<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate-css/vivify.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor/c3/c3.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">

    <!-- MAIN CSS -->

    <style>
        @font-face {
            font-family: myFirstFont;
            src: url({{ asset('Khalid-Art-Bold.ttf') }});
        }

        body {
            font-family: myFirstFont !important;
            /* color: darkgreen; */
            font-weight: bold
        }

        a {
            text-decoration: none !important
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/site.min.css') }}">
</head>

<body class="theme-cyan font-montserrat rtl light_version">

    <div id="app">
        <div id="particles-js"></div>
    </div>
    <!-- Javascript -->
    {{-- <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/bundles/vendorscripts.bundle.js"></script>


    <script src="assets/vendor/dropify/js/dropify.js"></script>

    <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/bundles/mainscripts.bundle.js"></script> --}}
    {{-- <script src="assets/js/pages/forms/dropify.js"></script> --}}

</body>

</html>
