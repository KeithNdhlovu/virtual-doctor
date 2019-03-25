@extends('layouts.appCleaner')

@section('page-class', '')

@section('css')
    <!-- Bootstrap Core Css -->
    <link href="{{  asset('css/landing/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{  asset('css/landing/coming-soon.css') }}" rel="stylesheet">
    <link href="{{  asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="masthead">
    <div class="masthead-bg"></div>
    <div class="container h-100">
        <div class="row h-100">
            <form id="feedback-form" role="form" method="GET" class="col-12">
                {{ csrf_field() }}
                <div class="masthead-content text-white py-5 py-md-0">
                    <div class="row">
                        <div class="col-12">
                            <p class="mb-0 mt-5 system-name">My<strong>Voice</strong></p>
                        </div>
                        <div class="col-12">
                            <p class="mb-0 mt-4 system-description">Welcome and Thank You for taking time to share your experience with us. <strong>Your voice matters.</strong></p>
                        </div>
                    </div>
                    <br/>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="info-card-top card">
                                <div class="body">
                                    <h2 class="card-inside-title">Which patient are you?</h2>
                                    <div class="demo-radio-button">
                                        <div class="form-group">
                                            <input name="group1" class="form-control" value="Walk in Patient" required type="radio" id="radio_1">
                                            <label for="radio_1">Walk in Patient</label>

                                            <input name="group1" class="form-control" value="Admitted Patient" required type="radio" id="radio_2">
                                            <label for="radio_2">Admitted Patient</label>

                                            <input name="group1" class="form-control" value="Casualty Patient" required type="radio" id="radio_3">
                                            <label for="radio_3">Casualty Patient</label>

                                            <input name="group1" class="form-control" value="Being Discharged" required type="radio" id="radio_4">
                                            <label for="radio_4">Being Discharged</label>
                                            
                                            <input name="group1" class="form-control" value="Used Patient &amp; Family Transport" required type="radio" id="radio_5">
                                            <label for="radio_5">Used Patient &amp; Family Transport</label>
                                        </div>
                                    </div>
                                    <div class="demo-switch">
                                        <h2 class="card-inside-title">Feedback?</h2>
                                        <div class="form-group">
                                            <input name="feedback_type" required value="Compliment" type="radio" id="radio_222">
                                            <label for="radio_222">Compliment</label>

                                            <input name="feedback_type" required value="Complaint" type="radio" id="radio_333">
                                            <label for="radio_333">Complaint</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="col-12 btn btn-secondary" type="submit">Click To Begin</button>
                        </div>
                        <div class="col-6">
                            <a class="col-12 btn btn-secondary disabled">Admin Login</a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <img class="landing-logo" src="{{ asset('images/logo_white.png') }}" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script type="text/javascript">
    $(function () {
        $('#feedback-form').validate({
            rules: {
                'checkbox': {
                    required: true
                },
                'gender': {
                    required: true
                }
            },
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }
        });
    });
</script>
@endsection
