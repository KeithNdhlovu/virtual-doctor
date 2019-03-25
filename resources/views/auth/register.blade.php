@extends('layouts.appClean')

@section('page-class', 'login-page theme-deep-orange')

@section('content')
    <div class="login-box">
        <div class="logo text-center">
            <img class="logo img" src="{{ asset('images/logos/logo_white.svg') }}" alt="Logo">
        </div>
        <div class="card">
            <div class="body">
                {!! Form::open(['route' => 'register', 'novalidate'=>'novalidate', 'id'=>'sign_up', 'role' => 'form', 'method' => 'POST'] ) !!}
                    {{ csrf_field() }}
                    <div class="msg">Please fill in the form below to create an account</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" 
                                class="form-control" 
                                name="first_name" 
                                placeholder="First Name"
                                value="{{ old('first_name') }}" 
                                required autofocus>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <label class="error">{{ $errors->first('first_name') }}</label>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" 
                                class="form-control" 
                                name="last_name" 
                                placeholder="Last Name" 
                                value="{{ old('last_name') }}" 
                                required autofocus>
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <label class="error">{{ $errors->first('last_name') }}</label>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" 
                                class="form-control" 
                                name="email" 
                                placeholder="Email Address" 
                                value="{{ old('email') }}" 
                                required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <label class="error">{{ $errors->first('email') }}</label>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">featured_video</i>
                        </span>
                        <div class="form-line">
                            <input type="text" 
                                class="form-control" 
                                name="id_number" 
                                placeholder="ID Number" 
                                value="{{ old('id_number') }}" 
                                required>
                            @if ($errors->has('id_number'))
                                <span class="help-block">
                                    <label class="error">{{ $errors->first('id_number') }}</label>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">credit_card</i>
                        </span>
                        <div class="form-line">
                            <input type="text" 
                                class="form-control" 
                                name="medical_aid_number" 
                                placeholder="Medical Aid Number" 
                                value="{{ old('medical_aid_number') }}" 
                                required>
                            @if ($errors->has('medical_aid_number'))
                                <span class="help-block">
                                    <label class="error">{{ $errors->first('medical_aid_number') }}</label>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" 
                                class="form-control" 
                                name="password" 
                                minlength="6" 
                                placeholder="Password" 
                                required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <label class="error">{{ $errors->first('password') }}</label>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" 
                                class="form-control" 
                                name="password_confirmation" 
                                minlength="6" 
                                placeholder="Confirm Password" 
                                required>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <label class="error">{{ $errors->first('password_confirmation') }}</label>
                                </span>
                            @endif
                        </div>
                    </div>
                 
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-purple waves-effect" type="submit">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{ url('/login') }}">You already have an account?</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection