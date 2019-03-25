@extends('layouts.app')

@section('template_title')
  Create New User
@endsection

@section('template_fastload_css')
@endsection

@section('content')

  <div class="container" ng-app="createUserApp" ng-controller="createUserController">
    <div class="row clearfix">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="header">
              <h2>CREATE NEW USER</h2>
              <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <i class="material-icons">more_vert</i>
                      </a>
                      <ul class="dropdown-menu pull-right">
                          <li><a href="/users">Back To Users</a></li>
                      </ul>
                  </li>
              </ul>
          </div>
          <div class="body">

            {!! Form::open(array('action' => 'UsersManagementController@store')) !!}

              <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                {!! Form::label('email', trans('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
                    <label class="input-group-addon" for="email"><i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('first_name', NULL, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw {{ trans('forms.create_user_icon_firstname') }}" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                {!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('last_name', NULL, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw {{ trans('forms.create_user_icon_lastname') }}" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('last_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('id_number') ? ' has-error ' : '' }}">
                {!! Form::label('id_number', 'ID Number', array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('id_number', NULL, array('id' => 'id_number', 'class' => 'form-control', 'placeholder' => "ID Number")) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('id_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id_number') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('medical_aid_number') ? ' has-error ' : '' }}">
                {!! Form::label('medical_aid_number', 'Medical Aid Number', array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('medical_aid_number', NULL, array('id' => 'medical_aid_number', 'class' => 'form-control', 'placeholder' => "Medical Aid Number")) !!}
                    <label class="input-group-addon" for="name"><i class="fa fa-fw" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('medical_aid_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('medical_aid_number') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">
                {!! Form::label('role', "User Type", array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    <select class="form-control" name="role" id="role">
                      <option value="">Select User Type</option>
                      @if ($roles->count())
                        @foreach($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->slug }}</option>
                        @endforeach
                      @endif
                    </select>
                    <label class="input-group-addon" for="name"><i class="fa fa-fw {{ trans('forms.create_user_icon_role') }}" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('role'))
                    <span class="help-block">
                        <strong>{{ $errors->first('role') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
          

              <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                {!! Form::label('password', trans('forms.create_user_label_password'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'))) !!}
                    <label class="input-group-addon" for="password"><i class="fa fa-fw {{ trans('forms.create_user_icon_password') }}" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
                {!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
                    <label class="input-group-addon" for="password_confirmation"><i class="fa fa-fw {{ trans('forms.create_user_icon_pw_confirmation') }}" aria-hidden="true"></i></label>
                  </div>
                  @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              {!! Form::button('Create User', array('class' => 'btn btn-block bg-purple waves-effect','type' => 'submit', )) !!}

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script src="{{ asset('js/angular/angular.min.js') }}"></script>
  <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>

    <script>
        (function () {

            // Controller
            var createUserApp = angular.module('createUserApp', ['ngSanitize'], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });

            createUserApp.controller('createUserController', ['$scope','$http', '$window', '$filter','$timeout' , function($scope, $http, $window, $filter, $timeout) {
                $scope.hospitals = [];


                $timeout(()=> {
                    $('#hospital').selectpicker('refresh');
                });

                $scope.toTitleCase = function(str) {
                    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
                }

                $scope.onChangeHospital = function() {
                  $timeout(()=> {
                      $('#ward').selectpicker('refresh');
                  });
                }

            }]);
        })();
    </script>
@endsection
