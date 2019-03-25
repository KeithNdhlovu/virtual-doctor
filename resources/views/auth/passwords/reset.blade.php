@extends('layouts.appClean')

@section('page-class', 'login-page theme-deep-orange')

@section('content')
<div class="login-box">
    <div class="logo text-center">
        <img class="logo img" src="{{ asset('images/logos/logo_white.svg') }}" alt="Homepage">
    </div>

    <div class="card">
        <div class="body">
        
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ $email or old('email') }}" required autofocus>
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

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            
                            <input id="password-confirm" type="password" placeholder="Password confirmation" class="form-control" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <label class="error">{{ $errors->first('password_confirmation') }}</label>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button class="btn btn-block bg-purple waves-effect" type="submit">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
