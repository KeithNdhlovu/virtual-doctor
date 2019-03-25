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
    <link href="{{  asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{  asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{  asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="{{  asset('plugins/waitme/waitMe.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{  asset('css/style.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
    
    <!-- JQuery DataTable Css -->
    <link href="{{  asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{  asset('css/themes/all-themes.css') }}" rel="stylesheet" />
    
    <style>
        .disabled-form {
            opacity: 0.5;
            color: #dcdbdb;
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>
    @yield('css')
</head>

<body class="theme-purple">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    @include('partials.topNavigation')

    <section>
        @include('partials.sideNavigation')
    </section>

    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Autosize Plugin Js -->
    <script src="{{ asset('plugins/autosize/autosize.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    
    <script src="{{ asset('js/admin.js') }}"></script>
    
    <!-- JQuery Steps -->
    <script src="{{ asset('plugins/jquery-steps/jquery.steps.js') }}"></script>

    <script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Form Wizzard -->
    <!--<script src="{{ asset('js/pages/forms/form-wizard.js') }}"></script>-->

    <!-- Bootstrap select -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <script type="text/javascript">
            $(function () {
                //Textare auto growth

                //Datetimepicker plugin
                $('.datetimepicker').bootstrapMaterialDatePicker({
                    format: 'dddd DD MMMM YYYY - HH:mm',
                    clearButton: true,
                    weekStart: 1
                });

                $('.datepicker').bootstrapMaterialDatePicker({
                    format: 'YYYY-MM-DD',
                    clearButton: true,
                    weekStart: 1,
                    time: false
                });

                $('.timepicker').bootstrapMaterialDatePicker({
                    format: 'HH:mm',
                    clearButton: true,
                    date: false
                });
            });
    </script>  
      
    @yield('scripts')
</body>

</html>