<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>{{ config('app.name', Lang::get('titles.app')) }}</title>
    <!-- Favicon-->
    <link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="manifest.json">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{  asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{  asset('plugins/node-waves/waves.css') }}" rel="stylesheet"/>

    <!-- Animation Css -->
    <link href="{{  asset('plugins/animate-css/animate.css') }}" rel="stylesheet"/>

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

    <style>
        .disabled-form {
            opacity: 0.5;
            color: #dcdbdb;
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="@yield('page-class')">
    
    @yield('content')

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Bootstrap select -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    
    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/pages/examples/sign-in.js') }}"></script>
    

    @yield('scripts')
</body>

</html>