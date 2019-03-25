@extends('layouts.app')

@section('template_title')
  Editing User {{ $user->name }}
@endsection

@section('template_linked_css')
  <style type="text/css">
    .btn-save,
    .pw-change-container {
      display: none;
    }
  </style>
@endsection

@section('content')

    @if(Session::has('success'))
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header bg-success">
                    <h2>
                        {{ Session::get('success') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    @endif

  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
                <h2>
                    <strong>Editing User</strong>: {{ $user->name }}
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="/users/{{$user->id}}">Back To User</a></li>
                            <li><a href="/users">Back To Users</a></li>
                            <li><a href="/home">Home</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            {!! Form::model($user, array('action' => array('UsersManagementController@update', $user->id), 'method' => 'PUT')) !!}

              {!! csrf_field() !!}

              <div class="body" ng-app="updateUserApp" ng-controller="updateUserController">

                <div class="form-group {{ $errors->has('email') ? ' has-error ' : '' }}">
                  {!! Form::label('email', 'E-mail' , array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    <div class="form-line">
                      {!! Form::text('email', old('email'), array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.ph-useremail'))) !!}
                    </div>
                    @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>


                <div class="form-group {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                  {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    <div class="form-line">
                      {!! Form::text('first_name', NULL, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                    </div>
                    @if ($errors->has('first_name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('first_name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                  {!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    <div class="form-line">
                      {!! Form::text('last_name', NULL, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                      
                    </div>
                    @if ($errors->has('last_name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('last_name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('role') ? ' has-error ' : '' }}">
                  {!! Form::label('role', trans('forms.create_user_label_role'), array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    <div class="form-line">
                      <select class="form-control" name="role" id="role">
                        <option value="">{{ trans('forms.create_user_ph_role') }}</option>
                        @if ($roles->count())
                          @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $currentRole->id == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
                          @endforeach
                        @endif
                      </select>
                      
                    </div>
                    @if ($errors->has('role'))
                      <span class="help-block">
                          <strong>{{ $errors->first('role') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="pw-change-container">
                  <div class="form-group">
                    {!! Form::label('password', trans('forms.create_user_label_password'), array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                      <div class="form-line">
                        {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'))) !!}
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    {!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                      <div class="form-line">
                        {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
                        
                      </div>
                    </div>
                  </div>
                </div>
                                  
                <div class="row">
                  {!! Form::label('', '', array('class' => 'col-md-3 control-label')); !!}
                  <div class="col-md-9">
                    {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes', array('class' => 'btn btn-success btn-block margin-bottom-1 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                  </div>
                </div>
              </div>

            {!! Form::close() !!}

        </div>
      </div>
  </div>
  @include('modals.modal-save')
  @include('modals.modal-delete')

@endsection

@section('scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')

  <script src="{{ asset('js/angular/angular.min.js') }}"></script>
  <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>

    <script>
        (function () {

            // Controller
            var updateUserApp = angular.module('updateUserApp', ['ngSanitize'], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });

            updateUserApp.controller('updateUserController', ['$scope','$http', '$window', '$filter','$timeout' , function($scope, $http, $window, $filter, $timeout) {
                $scope.hospitals = [];

                $scope.hospital  = null;

                // When there is no preselected ward, we just load the list of wards on that hospital
                $scope.ward      = null;
                
                $timeout(()=> {
                    $('#hospital').selectpicker('refresh');
                    $('#ward').selectpicker('refresh');
                });

                $scope.toTitleCase = function(str) {
                    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
                }

                $scope.onChangeHospital = function() {
                  $timeout(()=> {
                      $('#hospital').selectpicker('refresh');
                      $('#ward').selectpicker('refresh');
                  });
                }

            }]);
        })();
    </script>
@endsection