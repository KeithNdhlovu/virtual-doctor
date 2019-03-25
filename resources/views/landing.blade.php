@extends('layouts.appCleaner')

@section('content')

    @include('partials.landingMenu')


    <style>
        #home {
            background-size: cover;
            -webkit-transition: background-image 1.5s linear;
            -moz-transition: background-image 1.5s linear;
            -o-transition: background-image 1.5s linear;
            -ms-transition: background-image 1.5s linear;
            transition: background-image 1.5s linear;
        }

        .subx-heading {
            font-family: sans-serif !important;
            color: white;
            font-size: 25px !important;
        }
        
    </style>
    
    <!-- home
    ================================================== -->
    <section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="images/slides/slide_1.jpg" data-position-y=center>

        <div class="overlay"></div>
        <div class="shadow-overlay"></div>

        <div class="home-content landing">

            <div class="row home-content__main">

                <img style="height: 200px;" src="{{ asset('images/logos/logo_plain.svg') }}" alt="Logo">

                <h1 class="heading">Welcome to Virtual Doctor</h1>

                <h2 class="subx-heading">
                    Appointment Scheduling for doctors and Hospitals.
                    <br>
                    Best care you can get for you and your family, in a very convenient and reliable way
                </h2>

                <div class="home-content__buttons">
                    <button data-toggle="modal" data-target="#aboutUs" class="smoothscroll btn btn--stroke">
                        More About Us
                    </button>
                </div>

            </div>

        </div> <!-- end home-content -->

    </section> <!-- end s-home -->

    <!-- Compliments Modal -->
    <div class="modal fade" id="aboutUs" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="feedback-form" role="form" class="row">
                <div class="info-card-top card">
                    <div class="body">
                        <h2 class="card-inside-title">About Us</h2>
                        <div class="demo-radio-button">
                            <div class="form-group">
                                <p>
                                    What is Lorem Ipsum?
                                    <br>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                    <br><br>
                                    It has survived not only five centuries, but also the leap into electronic typesetting, 
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of 
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing 
                                    software like Aldus PageMaker including versions of Lorem Ipsum.
                                </p>
                                <br/><br/>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="row">
                            <div class="col-6 center-align">
                                <button type="button" class="btn btn--stroke" data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <script src="{{ asset('js/landing/plugins.js') }}"></script>
    <script src="{{ asset('js/landing/main.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
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

            var i=0;
    
            var imghead = [
                'images/slides/slide_1.jpg',
                'images/slides/slide_2.jpg',
                'images/slides/slide_3.jpg',
                'images/slides/slide_4.jpg',
            ];

            function slideimg() {

                setTimeout(function () {
                    $('.parallax-slider').animate({ opacity: 0 }, 500, function () { $('.parallax-slider').attr('src', imghead[i]); });
                    $('.parallax-slider').animate({ opacity: 1 }, 500);

                    i++;
                    
                    if(i == imghead.length) { i = 0 };

                    slideimg();
                }, 6000);
            }

            slideimg();
        });
    </script>
@endsection