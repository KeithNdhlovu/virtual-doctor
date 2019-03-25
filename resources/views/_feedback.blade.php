@extends('layouts.appCleaner')

@section('css')
    @parent
    <!-- Bootstrap Core Css -->
    <link href="{{  asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{  asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- header
    ================================================== -->
    <header class="s-header">

        <div class="header-logo">
            <a class="site-logo" href="{{ url('/') }}">
                <img class="landing" src="{{ asset('images/logo_white.png') }}" alt="Homepage">
            </a>
        </div>

        <a class="back-button" href="{{ url('/') }}">
            <span class="header-menu-text">Back</span>
        </a>
    </header> <!-- end s-header -->

    <section id="contact" class="s-contact feedback">

        <div class="overlay"></div>

        <div class="row contact-content feedback">
            
            <div class="contact-primary">  
                <br/>
                <div class="info-card-top card">
                    <div class="header f-bg-primary">
                        <h2 class="white-text" style="font-size: 2.5rem;">
                            {{ $feedbackType }} <small style="font-size: 14px;"><br/>Providing us with this information ensures that we keep in touch and provide you with prompt feedback</small>
                        </h2>
                    </div>
                    <div class="body">
                        <form novalidate id="wizard_with_validation" role="form" action="{{ action('FeedbackController@postLanding') }}" method="POST">
                            <h3>Hospital Information</h3>
                            <fieldset>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="organisation">Hospital</label>
                                            <select 
                                                id="organisation"
                                                name="organisation" 
                                                class="form-control form-line"
                                                required>
                                                    <option value="">Please Select Hospital</option>
                                                    <option value="4">CLINIX BOTSHELONG EMPILWENI PRIVATE HOSPITAL</option>
                                                    <option value="5">CLINIX ITOKOLLE VICTORIA PRIVATE HOSPITAL</option>
                                                    <option value="6">CLINIX NALEDI NKANYEZI PRIVATE HOSPITAL</option>
                                                    <option value="10">CLINIX TSHEPO THEMBA PRIVATE HOSPITAL</option>
                                                    <option value="9">DR SK MATSEKE MEMORIAL HOSPITAL</option>
                                                    <option value="8">SOLOMON STIX MOREWA MEMORIAL HOSPITAL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="ward">Ward</label>
                                            <select 
                                                id="ward" 
                                                name="ward" 
                                                class="form-control form-line">
                                                    <option value="">Please Select Ward</option>
                                                    <option value="146">ACCIDENT &amp; EMERGENCY</option>
                                                    <option value="18">ADULT INTENSIVE CARE UNIT</option>
                                                    <option value="165">GYNAE</option>
                                                    <option value="19">MATERNITY</option>
                                                    <option value="20">MEDICAL</option>
                                                    <option value="21">NEONATAL INTENSIVE CARE UNIT</option>
                                                    <option value="22">PAEDIATRICS</option>
                                                    <option value="166">PAEDS ICU</option>
                                                    <option value="167">PHARMACY</option>
                                                    <option value="132">PSYCIATRIC</option>
                                                    <option value="150">RECEPTION</option>
                                                    <option value="23">SURGICAL</option>
                                                    <option value="24">THEATRE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <label>Are you currently using your own device or a hospital provided device?</label>
                                        <div class="form-group">
                                            <input name="is_hopital_owned" class="form-control chk-col-deep-orange" value="false" required type="radio" id="radio_1">
                                            <label for="radio_1">Own</label>

                                            <input name="is_hopital_owned" class="form-control chk-col-deep-orange" value="true" required type="radio" id="radio_2">
                                            <label for="radio_2">Hospital Provided</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Areas of {{ $feedbackType }}</label><br/>
                                        <div class="form-group">
                                            <input type="checkbox" id="md_checkbox_36" class="filled-in chk-col-deep-orange">
                                            <label for="md_checkbox_36">Meals</label>

                                            <input type="checkbox" id="md_checkbox_37" class="filled-in chk-col-deep-orange">
                                            <label for="md_checkbox_37">Nursing</label>
                                                
                                            <input type="checkbox" id="md_checkbox_38" class="filled-in chk-col-deep-orange">
                                            <label for="md_checkbox_38">Doctors</label>

                                            <input type="checkbox" id="md_checkbox_39" class="filled-in chk-col-deep-orange">
                                            <label for="md_checkbox_39">Pharmacy</label>

                                            <input type="checkbox" id="md_checkbox_399" class="filled-in chk-col-deep-orange">
                                            <label for="md_checkbox_399">Cleanliness</label>
                                                
                                            <input type="checkbox" id="md_checkbox_3999" class="filled-in chk-col-deep-orange">
                                            <label for="md_checkbox_3999">General</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <h3>Contact Details & {{ $feedbackType }}</h3>
                            <fieldset>
                                <div class="row clearfix">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <select 
                                                required
                                                id="title"
                                                name="title" 
                                                class="form-control form-line">
                                                    <option value="">Select Title</option>
                                                    <option value="0">Mr</option>
                                                    <option value="1">Mrs</option>
                                                    <option value="2">Ms</option>
                                                    <option value="3">Miss</option>
                                                    <option value="4">Dr</option>
                                                    <option value="5">Prof</option>
                                                    <option value="6">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="name" class="form-label">First Name*</label>
                                            <div class="form-line">
                                                <input type="text" placeholder="First Name" required id="name" name="name" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="surname" class="form-label">Surname*</label>
                                            <div class="form-line">
                                                <input type="text" required placeholder="Surname" id="surname" name="surname" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Cellphone*</label>
                                            <div class="form-line">
                                                <input type="text" required id="email" placeholder="Cellphone"  name="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="complaint" class="form-label">{{ $feedbackType }}*</label>
                                            <div class="form-line">
                                                <textarea name="complaint" id="complaint" placeholder="Complaint"  cols="30" rows="2" class="form-control no-resize" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> <!-- end contact-primary -->
        </div> <!-- end contact-content -->
        
    </section>
@endsection

@section('script')


    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('js/landing/plugins.js') }}"></script>
    <script src="{{ asset('js/landing/main.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{  asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="{{  asset('plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{  asset('plugins/jquery-steps/jquery.steps.js') }}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{  asset('plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{  asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{  asset('js/admin.js') }}"></script>
    <script src="{{  asset('js/pages/forms/form-wizard.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{  asset('js/demo.js') }}"></script>

    <!-- Select Plugin Js -->
    <!-- <script src="{{  asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script> -->
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