@extends('layouts.appClean')

@section('page-class', 'login-page theme-deep-orange')

@section('content')
<div class="login-box">
    <div class="logo text-center">
        <img class="logo img" src="{{ asset('images/logos/logo_white.svg') }}" alt="Logo">
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="msg"></div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <label class="error">{{ $errors->first('email') }}</label>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <label class="error">{{ $errors->first('password') }}</label>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="filled-in chk-col-pink">
                        <label for="remember">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-clinix-orange waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 p-t-5 text-left">
                        <a href="{{ url('/register') }}" class="text-small forgot-password text-black">Create an account</a>
                    </div>
                    <div class="col-xs-6 p-t-5 text-right">
                        <a href="{{ url('/') }}" class="text-small forgot-password text-black">Back Home</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
