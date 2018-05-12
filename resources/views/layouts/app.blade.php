<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @section('head.scripts')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Resource style -->
    <script src="{{ asset('js/modernizr.js') }}"></script> <!-- Modernizr -->
    @show
</head>
<body class="@yield('body.classes')" id="@yield('body.id')">
    @yield('body')

    @section('body.scripts')
    <script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('js/jquery.mobile.custom.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script> <!-- Resource jQuery -->
    @show
</body>
</html>