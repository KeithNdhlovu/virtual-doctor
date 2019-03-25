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
                                    Some Errors have occured while creating your incident
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
                    <div class="row clearfix" ng-app="createIncidentApp" ng-controller="createIncidentController">

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

                                    <div class="form-group field-patient_number">
                                        <label for="patient_number">Patient Number</label>
                                        <div class="form-line">
                                            <input type="text" id="patient_number" placeholder="Patient Number" class="form-control" value="{{ old('patient_number') }}" name="patient_number">
                                        </div>
                                    </div>

                                    <div class="form-group field-patient_fullname">
                                        <label for="patient_fullname">Patient Name &amp; Surname</label>
                                        <div class="form-line">
                                            <input type="text" id="patient_fullname" placeholder="Patient Name &amp; Surname" class="form-control" value="{{ old('patient_fullname') }}" name="patient_fullname">
                                        </div>
                                    </div>

                                    <div class="form-group field-incident-ward_id required">
                                        <label for="incident-ward_id">Department </label>
                                        <select id="incident-ward_id" 
                                            class="form-control show-tick" 
                                            name="ward_id" 
                                            ng-model="eventWard"
                                            data-live-search="true">
                                            <option value="">Select Department ...</option>
                                            @foreach ($wards as $ward)
                                                <option  {{ (old('ward_id') == $ward->id) ? 'selected' : '' }} value="{{ $ward->id }}">{{ $ward->name }}</option>
                                            @endforeach
                                        </select>                  
                                    </div>

                                    <div id="incident_other_department" ng-show="(eventWard == -1)">
                                        <div class="form-group field-incident-other_department">
                                            <label for="incident-other_department">Other Department</label>
                                            <div class="form-line">
                                                <textarea id="incident-other_department" placeholder="Other Department ..." class="form-control" name="other_department" rows="3">{{ old('other_department') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group field-incident-diagnosis">
                                        <label for="incident-diagnosis">Diagnosis</label>
                                        <select id="incident-diagnosis" 
                                            class="form-control" 
                                            name="diagnosis_id" 
                                            ng-model="eventDiagnosis"
                                            data-live-search="true">
                                            <option value="">Select Diagnosis...</option>
                                            @foreach ($diagnosis as $diagn)
                                                <option  {{ (old('diagnosis_id') == $diagn->id) ? 'selected' : '' }} value="{{ $diagn->id }}">{{ $diagn->name }}</option>
                                            @endforeach  
                                        </select>                                      
                                    </div>
                                    <div id="incident_other_diagnosis" ng-show="(eventDiagnosis == -1)">
                                        <div class="form-group field-incident-other_diagnosis">
                                            <label for="incident-other_diagnosis">Other Diagnosis</label>
                                            <div class="form-line">
                                                <textarea id="incident-other_diagnosis" placeholder="Other Diagnosis ..." class="form-control" name="other_diagnosis" rows="3">{{ old('other_diagnosis') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group field-incident-event_date">
                                        <label for="incident-event_date">Date &amp; Time Of Event</label>
                                        <div class="form-line">
                                            <input type="text" id="incident-event_date" value="{{ old('event_date') }}" class="form-control datetimepicker" name="event_date" placeholder="Enter incident date..." >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group field-incident-doc_fullname">
                                        <label for="incident-doc_fullname">Dr Name &amp; Surname</label>
                                        <div class="form-line">
                                            <input type="text" id="incident-doc_fullname" ng-if="eventType.name != 'Non-Clinical'" placeholder="Dr Name &amp; Surname" value="{{ old('doc_fullname') }}" class="form-control" name="doc_fullname">
                                            <input type="text" id="incident-doc_fullname" ng-if="eventType.name == 'Non-Clinical'" placeholder="Dr Name &amp; Surname" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group field-incident-time_notified">
                                        <label for="incident-time_notified">Time Dr Notified</label>
                                        <div class="form-line">
                                            <input type="text" id="incident-time_notified" placeholder="Time Dr Notified" class="form-control timepicker" value="{{ old('time_notified') }}" name="time_notified">
                                            <input type="text" id="incident-time_notified" placeholder="Time Dr Notified" class="form-control timepicker" ng-if="eventType.name == 'Non-Clinical'" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group field-staff_fullname">
                                        <label for="staff_fullname">Staff Name &amp; Surname</label>
                                        <div class="form-line">
                                            <input type="text" id="staff_fullname" placeholder="Staff Name &amp; Surname" class="form-control" value="{{ old('staff_fullname') }}" name="staff_fullname">
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
                                        <select id="incident-event_type_id" 
                                            ng-model="eventType" 
                                            class="form-control" 
                                            name="event_type_id" 
                                            data-live-search="true"
                                            ng-change="onChangeEvent(eventType)"
                                            ng-options="item as item.name for item in types track by item.id">
                                            <option value="">Select an Event Type ...</option>
                                        </select>
                                        <input name="is_non_clinical" ng-if="(eventType.name == 'Non-Clinical')" type="hidden" />
                                    </div>

                                    <div id="incident_type" ng-show="(eventType.id == -1)">
                                        <div class="form-group field-incident-other_event_type">
                                            <label for="incident-other_event_type">Other Event Type</label>
                                            <div class="form-line">
                                                <textarea id="incident-other_event_type" placeholder="Other Event Type ..." class="form-control" name="other_event_type" rows="3">{{ old('other_event_type') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group field-incident-category_id">
                                        <label for="incident-category_id">Event Category </label>
                                        <select id="incident-category_id" 
                                                class="form-control" 
                                                ng-model="eventCategory"
                                                name="category_id" 
                                                data-live-search="true" 
                                                ng-change="onChangeCategory(eventCategory)"
                                                ng-options="item as item.name for item in categories track by item.id">
                                            <option value="">Select an Event Category ...</option>
                                        </select>
                                    </div>

                                    <div class="form-group field-incident-sub_category_id " ng-show="eventCategory.sub_categories.length > 0">
                                        <label for="incident-sub_category_id">Event Trigger List </label>
                                        <div class="">
                                            <select id="incident-sub_category_id" 
                                                selectpicker
                                                ng-model="trigger"
                                                class="form-control"
                                                name="sub_category_id" 
                                                data-live-search="true"
                                                ng-change="onChangeTrigger(trigger)"
                                                ng-options="item as item.name for item in eventCategory.sub_categories track by item.id">
                                                <option value="">Select Event Trigger List...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group field-incident-death_trigger_id " ng-show="trigger.triggers.length > 0">
                                        <label for="incident-death_trigger_id">Death Trigger List </label>
                                        <div class="">
                                            <select id="incident-death_trigger_id" 
                                                selectpicker
                                                ng-model="deathTrigger"
                                                class="form-control"
                                                name="death_trigger_id" 
                                                data-live-search="true"
                                                ng-options="item as item.name for item in trigger.triggers track by item.id">
                                                <option value="">Select Death Trigger List...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="classification" ng-show="eventCategory.id == -1">
                                        <div class="form-group field-incident-other_event_category">
                                            <label for="incident-other_event_category">Other category Description</label>
                                            <div class="form-line">
                                                <textarea id="incident-other_event_category" placeholder="Other ..." class="form-control" name="other_event_category" rows="3">{{ old('other_event_category') }}</textarea>
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
                                            <input type="text" 
                                                ng-show="eventType.name != 'Non-Clinical'" 
                                                placeholder="Time seen ..." 
                                                id="incident-time_seen" 
                                                value="{{ old('time_seen') }}" 
                                                class="form-control timepicker" 
                                                name="time_seen">
                                            <input type="text" ng-if="eventType.name == 'Non-Clinical'" disabled placeholder="Time seen ..." class="form-control">
                                        </div>
                                    </div>                               

                                    <div class="form-group field-incident-rank_id required">
                                        <label for="incident-rank_id">Staff Rank </label>
                                        <select id="incident-rank_id" 
                                            ng-model="staffRank" 
                                            class="form-control" 
                                            name="rank_id"
                                            ng-options="item as item.name for item in rankings track by item.id">
                                            <option value="">Select a Rank ...</option>
                                        </select>
                                    </div>

                                    <!-- @TODO show this when -->
                                    <div id="rank">
                                        <div class="form-group field-incident-other_staff_rank" ng-show="staffRank.id == -1">
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
    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>

    <script>
    (function () {

            $("#incident-event_date").bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm',
                clearButton: true,
                weekStart: 1
            });

            // Controller
            var createIncidentApp = angular.module('createIncidentApp', ['ngSanitize'], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });

            createIncidentApp.controller('createIncidentController', ['$scope','$http', '$window', '$filter','$timeout' , function($scope, $http, $window, $filter, $timeout) {
                $scope.subs          = {!! $subs !!};
                $scope.categories    = {!! $categories !!};
                $scope.types         = {!! $types !!};
                $scope.rankings      = {!! $rankings !!};
                
                $timeout(()=> {
                    $('#incident-rank_id').selectpicker('refresh');
                    $('#incident-event_type_id').selectpicker('refresh');
                    $('#incident-category_id').selectpicker('refresh');

                    $('#incident-death_trigger_id').selectpicker('refresh');
                });

                $scope.onChangeCategory = (category) => {
                    console.log("onChangeCategory", category)
                    $timeout(()=> $('#incident-sub_category_id').selectpicker('refresh'));
                };

                $scope.onChangeTrigger = (trigger) => {
                    console.log("onChangeTrigger", trigger)
                    $timeout(()=> $('#incident-death_trigger_id').selectpicker('refresh'));
                };

                $scope.onChangeEvent = (event) => {
                    console.log("onChangeEvent", event)
                }

            }]);
        })();
    </script>
@endsection