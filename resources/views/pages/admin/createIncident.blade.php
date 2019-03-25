@extends('layouts.app')

@section('title', Auth::user()->name ."s Homepage")

@section('content')

    {!! Form::open(['action' => 'UserController@doPostCreateIncident', 'novalidate'=>'novalidate', 'id'=>'incident-form', 'role' => 'form', 'method' => 'POST'] ) !!}
        {{ csrf_field() }}
        <div class="box">
            <div class="box-body">

                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                        <div class="card">
                            <div class="body">
                                <button type="submit" class="btn bg-green waves-effect">
                                    <i class="material-icons">verified_user</i>
                                    <span>SAVE</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header bg-red">
                                <h2>
                                    Some Errors have occured while creating your event
                                </h2>
                            </div>
                            <div class="body">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @role('user', true)
                    <!-- Hospital Detail and Event Detail section -->
                    <div class="row clearfix">

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="header bg-green"> 
                                    <h2>Hospital Detail</h2> 
                                </div> 
                                <div class="body">
                                    <div class="form-group">
                                        <label for="incident-hospital_id">Hospital </label>
                                        <select disabled id="incident-hospital_id" class="form-control show-tick" name="hospital_id">
                                            <option selected value="{{ Auth::user()->profile->organisation->id }}">{{ Auth::user()->profile->organisation->name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group field-incident-ward_id required">
                                        <label for="incident-ward_id">Ward </label>
                                        <select id="incident-ward_id" class="form-control show-tick" name="ward_id" data-live-search="true">
                                            <option value="">Select Ward ...</option>
                                            @foreach ($wards as $ward)
                                                <option  {{ (old('ward_id') === $ward->id) ? 'selected' : '' }} value="{{ $ward->id }}">{{ $ward->name }}</option>
                                            @endforeach
                                        </select>                                      
                                    </div>
                                    <div class="form-group field-incident-diagnosis">
                                        <label for="incident-diagnosis">Diagnosis</label>
                                        <select id="incident-diagnosis" class="form-control" name="diagnosis_id" data-live-search="true">
                                            <option value="">Select Diagnosis...</option>
                                            @foreach ($diagnosis as $diagn)
                                                <option  {{ (old('diagnosis_id') === $diagn->id) ? 'selected' : '' }} value="{{ $diagn->id }}">{{ $diagn->name }}</option>
                                            @endforeach  
                                        </select>                                      
                                    </div>
                                    <div class="form-group field-incident-date_of_incident">
                                        <label for="incident-date_of_incident">Date Of Event</label>
                                        <div class="form-line">
                                            <input type="text" id="incident-date_of_incident" value="{{ old('date_of_incident') }}" class="form-control datepicker" name="date_of_incident" placeholder="Enter incident date..." >
                                        </div>
                                    </div>
                                    <div class="form-group field-incident-time_of_incident">
                                        <label for="incident-time_of_incident">Time Of Event</label>
                                        <div class="form-line">
                                            <input type="text" id="incident-time_of_incident" class="form-control timepicker" value="{{ old('time_of_incident') }}" name="time_of_incident" placeholder="Time Of Event">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group field-incident-doc_name">
                                        <label for="incident-doc_name">Dr Name</label>
                                        <div class="form-line">
                                            <input type="text" id="incident-doc_name" placeholder="Dr Name" value="{{ old('doc_name') }}" class="form-control" name="doc_name" maxlength="45">
                                        </div>
                                    </div>
                                    <div class="form-group field-incident-doc_surname">
                                        <label for="incident-doc_surname">Dr Surname</label>
                                        <div class="form-line">
                                            <input type="text" id="incident-doc_surname" class="form-control" value="{{ old('doc_surname') }}" name="doc_surname" maxlength="45">
                                        </div>
                                    </div>
                                    <div class="form-group field-incident-time_notified">
                                        <label for="incident-time_notified">Time Notified</label>
                                        <div class="form-line">
                                            <input type="text" id="incident-time_notified" placeholder="Time Notified" class="form-control timepicker" value="{{ old('time_notified') }}" name="time_notified">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="header bg-red">
                                    <h2>Event Detail</h2>
                                </div>
                                <div class="body">
                                    <div class="form-group field-incident-event_type_id required">
                                        <label for="incident-event_type_id">Event Type </label>

                                        <!--@TODO when other is selected, show editable other field -->
                                        <select id="incident-event_type_id" class="form-control" name="event_type_id" data-live-search="true">
                                            <option value="">Select an Event Type ...</option>
                                            @foreach ($types as $type)
                                                <option {{ (old('event_type_id') === $type->id) ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                            <option value="-1">Other</option>
                                        </select>
                                    </div>

                                    <!-- @TODO show this only when user selected other from the top selection -->
                                    <div id="incident_type">
                                        <div class="form-group field-incident-other_event_type">
                                            <label for="incident-other_event_type">Other Event Type</label>
                                            <div class="form-line">
                                                <textarea id="incident-other_event_type" placeholder="Other Event Type ..." class="form-control" name="other_event_type" rows="3">{{ old('other_event_type') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group field-incident-category_id">
                                        <label for="incident-category_id">Event Category </label>
                                        <select id="incident-category_id" class="form-control" name="category_id" data-live-search="true">
                                            <option value="">Select an Event Category ...</option>
                                            @foreach ($categories as $category)
                                                <option {{ (old('category_id') == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            <option value="-1">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group field-incident-sub_category_id required">
                                        <label for="incident-sub_category_id">Event Sub Category </label>
                                        <div class="">
                                            <select id="incident-sub_category_id" class="form-control" name="sub_category_id"  data-live-search="true">
                                                <option value="">Select Sub Category...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- @TODO sho this only when other is selected by #incident_category_id -->
                                    <div id="classification">
                                        <div class="form-group field-incident-other_incident_category">
                                            <label for="incident-other_incident_category">Other category Description</label>
                                            <div class="form-line">
                                                <textarea id="incident-other_incident_category" placeholder="Other ..." class="form-control" name="other_incident_category" rows="3">{{ old('other_incident_category') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group field-incident-sequence_of_events">
                                        <label for="incident-sequence_of_events">Sequence of Events</label>
                                        <div class="form-line">
                                            <textarea id="incident-sequence_of_events" placeholder="Sequence of events ..." class="form-control" name="sequence_of_events" rows="3">{{ old('sequence_of_events') }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group field-incident-time_seen">
                                        <label for="incident-time_seen">Time Seen by Dr</label>
                                        <div class="form-line">
                                            <input type="text" placeholder="Time seen ..." id="incident-time_seen" value="{{ old('time_seen') }}" class="form-control timepicker" name="time_seen" >
                                        </div>
                                    </div>

                                    <div class="form-group field-incident-event_grading_id required">
                                        <label for="incident-event_grading_id">Event Grading</label>
                                        <div class="form-line">
                                            <div class="input-group input-group-md">
                                                <select disabled id="incident-event_grading_id" class="form-control" name="event_grading_id" >
                                                    <option value="">Select Event Grading...</option>
                                                    @foreach ($gradings as $grading)
                                                        <option {{ (old('event_grading_id') === $grading->id) ? 'selected' : '' }} value="{{ $grading->id }}">{{ $grading->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group field-incident-death_id required">
                                        <label for="incident-death_id">Death Occurred?</label>
                                        <select id="incident-death_id" class="form-control" name="death_id">
                                            <option value="">Select...</option>
                                            <option {{ (old('death_id') === 0 ) ? 'selected' : '' }} value="0">No</option>
                                            <option {{ (old('death_id') === 1 ) ? 'selected' : '' }} value="1">Yes</option>
                                        </select>
                                    </div>

                                    <div class="form-group field-incident-death_type_id required">
                                        <label for="incident-death_type_id">Type of Death</label>
                                        <select id="incident-death_type_id" class="form-control" name="death_type_id">
                                            <option value="">Select Death type...</option>
                                            @foreach ($deaths as $death)
                                                <option {{ (old('death_type_id') === $death->id ) ? 'selected' : '' }} value="{{ $death->id }}">{{ $death->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group field-incident-rank_id required">
                                        <label for="incident-rank_id">Staff Rank </label>
                                        <select id="incident-rank_id" class="form-control" name="rank_id">
                                            <option value="">Select a Rank ...</option>
                                            @foreach ($rankings as $ranking)
                                                <option {{ (old('rank_id') === $ranking->id ) ? 'selected' : '' }} value="{{ $ranking->id }}">{{ $ranking->name }}</option>
                                            @endforeach
                                            <option value="-1">Other</option>
                                        </select>
                                    </div>

                                    <!-- @TODO show this when -->
                                    <div id="rank">
                                        <div class="form-group field-incident-other_staff_rank">
                                            <label for="incident-other_staff_rank">Other Rank</label>
                                            <div class="form-line">
                                                <textarea id="incident-other_staff_rank" placeholder="Other ..." class="form-control" name="other_staff_rank" rows="3">{{ old('other_staff_rank') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #End Hospital and Event Detail Section-->
                @endrole

                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                        <div class="card">
                            <div class="body">
                                <button type="submit" class="btn bg-green waves-effect">
                                    <i class="material-icons">verified_user</i>
                                    <span>SAVE</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection

@section('scripts')
    
    <script src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>
    <script src="{{ asset('js/angular/ng-pickadate.js') }}"></script>
    <script src="{{ asset('js/angular/simplePagination.js') }}"></script>

    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>

    <script>
        // Controller
        var createIncidentApp = angular.module('createIncidentApp', ['ngSanitize', 'simplePagination'], function($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        });


        createIncidentApp.controller('createIncidentController', ['$scope','$http', '$window', '$filter','Pagination', function($scope, $http, $window, $filter, Pagination) {


            $scope.wrds = [
                {id: 0, name: "AICU"},
                {id: 1, name: "Casualty"},
                {id: 2, name: "General Ward"},
                {id: 3, name: "Female ward"},
                {id: 4, name: "Male Ward"},
                {id: 5, name: "Gynae ward"},
                {id: 6, name: "Labour ward"},
                {id: 7, name: "Maternity ward"},
                {id: 8, name: "Medical ward"},
                {id: 9, name: "Medical ward"},
                {id: 10, name: "NICU"},
                {id: 11, name: "Oncology"},
                {id: 12, name: "Peads ward"},
                {id: 13, name: "Peads ICU"},
                {id: 14, name: "Surginal ward"},
                {id: 15, name: "Theatre"},
                {id: 16, name: "Wellness ward"}
            ];

            
        }]);

    </script>
@endsection