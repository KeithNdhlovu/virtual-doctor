<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>{{ config('app.name', Lang::get('titles.app')) }}</title>
    <meta name="description" content="A Clinix Health Group system where patients get to voice out either their concerns or compliments">
    <meta name="author" content="Kevin Błasczykowski">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @section('css')
      <!-- CSS
      ================================================== -->
        <link rel="stylesheet" href="{{ asset('css/landing/base.css') }}">
        <link rel="stylesheet" href="{{ asset('css/landing/vendor.css') }}">
        <link rel="stylesheet" href="{{ asset('css/landing/main.css') }}">

        <!-- Waves Effect Css -->
        <link href="{{  asset('plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet"/>
        <!-- Waves Effect Css -->
        <link href="{{  asset('plugins/node-waves/waves.css') }}" rel="stylesheet"/>
        <link href="{{  asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    @show

    <!-- script
    ================================================== -->
    <script src="{{ asset('js/landing/modernizr.js') }}"></script>
    <script src="{{ asset('js/landing/pace.min.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <style>
        .disabled-form {
            opacity: 0.5;
            color: #dcdbdb;
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>
</head>

<body id="top">

    @yield('content')

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale-pulse-out">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>


    @section('script')
      <!-- JavaScript
      ================================================== -->
      <script src="{{ asset('js/landing/jquery-3.2.1.min.js') }}"></script>
      <script src="{{ asset('js/landing/plugins.js') }}"></script>
      <script src="{{ asset('js/landing/main.js') }}"></script>
    @show
</body>

</html>