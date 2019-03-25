@extends('layouts.app')

@section('title', Auth::user()->name ." Update Incident")

@section('content')

    {!! Form::open(['action' => ['FacilitatorController@doPostUpdateIncident', $incident->id], 'novalidate'=>'novalidate', 'id'=>'incident-form', 'role' => 'form', 'method' => 'POST'] ) !!}
        {{ csrf_field() }}
        <div class="box"
            ng-app="updateIncidentApp"
            ng-controller="updateIncidentController">
            
            <div class="box-body">

                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                        <div class="card">
                            <div class="body">
                                <button type="submit" class="btn bg-green waves-effect">
                                    <i class="material-icons">mode_edit</i>
                                    <span>Update</span>
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
                                        <option selected>{{ $incident->organisation->name }}</option>
                                    </select>
                                </div>

                                <div class="form-group field-patient_number">
                                    <label for="patient_number">Patient Number</label>
                                    <div class="form-line">
                                        <input  type="text" id="patient_number" placeholder="Patient Name" class="form-control" value="{{ $incident->patient_number }}" name="patient_number">
                                    </div>
                                </div>
                                <div class="form-group field-patient_fullname">
                                    <label for="patient_fullname">Patient Name &amp; Surname</label>
                                    <div class="form-line">
                                        <input  type="text" id="patient_fullname" placeholder="Patient Name &amp; Surname" class="form-control" value="{{ $incident->patient_fullname }}" name="patient_fullname">
                                    </div>
                                </div>

                                <div class="form-group field-incident-ward_id required">
                                    <label for="incident-ward_id">Department </label>
                                    <select  id="incident-ward_id" 
                                        class="form-control show-tick" 
                                        name="ward_id"
                                        ng-model="eventWard" 
                                        data-live-search="true">
                                        <option value="">Select Department</option>
                                        @php
                                            $incident->ward_id = $incident->ward_id ? $incident->ward_id : -1
                                        @endphp
                                        @foreach ($wards as $ward)
                                            <option  {{ (old('ward_id') == $ward->id) || ($incident->ward_id == $ward->id) ? 'selected' : '' }} value="{{ $ward->id }}">{{ $ward->name }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>

                                <div id="incident_other_department" ng-show="(eventWard == -1)">
                                    <div class="form-group field-incident-other_department">
                                        <label for="incident-other_department">Other Department</label>
                                        <div class="form-line">
                                            <textarea id="incident-other_department" placeholder="Other Department ..." class="form-control" name="other_department" rows="3">{{ $incident->other_department }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                                                
                                <div class="form-group field-incident-diagnosis">
                                    <label for="incident-diagnosis">Diagnosis</label>
                                    <select  id="incident-diagnosis" 
                                        class="form-control show-tick" 
                                        name="diagnosis_id"
                                        ng-model="eventDiagnosis"
                                        data-live-search="true">
                                        <option value="">Select Diagnosis</option>
                                        @php
                                            $incident->diagnosis_id = $incident->diagnosis_id ? $incident->diagnosis_id : -1
                                        @endphp
                                        @foreach ($diagnosis as $diagn)
                                            <option  {{ (old('diagnosis_id') == $diagn->id) || ($incident->diagnosis_id == $diagn->id) ? 'selected="selected"' : '' }} value="{{ $diagn->id }}">{{ $diagn->name }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>
                                <div id="incident_other_diagnosis" ng-show="(eventDiagnosis == -1)">
                                    <div class="form-group field-incident-other_diagnosis">
                                        <label for="incident-other_diagnosis">Other Diagnosis</label>
                                        <div class="form-line">
                                            <textarea id="incident-other_diagnosis" placeholder="Other Diagnosis ..." class="form-control" name="other_diagnosis" rows="3">{{ $incident->other_diagnosis }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group field-incident-date_of_incident">
                                    <label for="incident-event_date">Date &amp; Time Of Event</label>
                                    <div class="form-line">
                                        <input  type="text" id="incident-date_of_incident" value="{{ $incident->event_date }}" class="form-control datetimepicker" name="event_date" placeholder="Enter incident date..." >
                                    </div>
                                </div>

                                <br>
                                <div class="form-group field-incident-doc_fullname">
                                    <label for="incident-doc_fullname">Dr Name &amp; Surname</label>
                                    <div class="form-line">
                                        <input  type="text" id="incident-doc_fullname" placeholder="Dr Name &amp; Surname" value="{{ $incident->doctors_fullname }}" class="form-control" name="doc_fullname" maxlength="45">
                                    </div>
                                </div>

                                <div class="form-group field-incident-time_notified">
                                    <label for="incident-time_notified">Time Notified</label>
                                    <div class="form-line">
                                        <input  type="text" id="incident-time_notified" placeholder="Time Notified" class="form-control timepicker" value="{{ $incident->time_notified }}" name="time_notified">
                                    </div>
                                </div>
                                <div class="form-group field-staff_fullname">
                                    <label for="staff_fullname">Staff Name &amp; Surname</label>
                                    <div class="form-line">
                                        <input  type="text" id="staff_fullname" placeholder="Staff Name &amp; Surname" class="form-control" value="{{ $incident->staff_fullname }}" name="staff_fullname">
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

                                    <select  id="incident-event_type_id" 
                                        class="form-control show-tick" 
                                        ng-model="eventType" 
                                        data-live-search="true"
                                        ng-change="updateEventype(eventType)" 
                                        name="event_type_id"
                                        ng-options="item as item.name for item in types track by item.id">
                                        <option value="">Select Event Ttype</option>
                                    </select>
                                </div>

                                <div id="incident_type" ng-show="eventType.id == -1">
                                    <div class="form-group field-incident-other_event_type">
                                        <label for="incident-other_event_type">Other Event Type</label>
                                        <div class="form-line">
                                            <textarea  id="incident-other_event_type" placeholder="Other Event Type ..." class="form-control" name="other_event_type" rows="3">{{ $incident->other_event_type }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group field-incident-category_id">
                                    <label for="incident-category_id">Event Category </label>
                                    <select  id="incident-category_id" 
                                        class="form-control show-tick"
                                        ng-model="eventCategory"
                                        name="category_id" 
                                        data-live-search="true" 
                                        ng-change="onChangeCategory(eventCategory)"
                                        ng-options="item as item.name for item in categories track by item.id">
                                        <option value="">Select Event Category</option>
                                    </select>
                                </div>

                                <div class="form-group field-incident-sub_category_id required" 
                                    ng-show="eventCategory.sub_categories.length > 0">
                                    <label for="incident-sub_category_id">Event Trigger List</label>
                                    <select id="incident-sub_category_id"
                                        class="form-control show-tick"
                                        name="sub_category_id"
                                        data-live-search="true"
                                        ng-model="trigger"
                                        ng-change="onChangeTrigger(trigger)"
                                        ng-options="item as item.name for item in eventCategory.sub_categories track by item.id">
                                        <option value="">Select Event Trigger List...</option>
                                    </select>
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
                                            <textarea  id="incident-other_event_category" placeholder="Other ..." class="form-control" name="other_event_category" rows="3">{{ $incident->other_event_category }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group field-incident-sequence_of_events">
                                    <label for="incident-sequence_of_events">Sequence of Events</label>
                                    <div class="form-line">
                                        <textarea  id="incident-sequence_of_events" placeholder="Sequence of events ..." class="form-control" name="sequence_of_events" rows="3">{{ $incident->sequence_of_events }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group field-incident-time_seen">
                                    <label for="incident-time_seen">Time Seen by Dr</label>
                                    <div class="form-line">
                                        <input type="text"  placeholder="Time seen ..." id="incident-time_seen" value="{{ $incident->time_seen_by_doctor }}" class="form-control timepicker" name="time_seen" >
                                    </div>
                                </div>

                                <div class="form-group field-incident-rank_id required">
                                    <label for="incident-rank_id">Staff Rank </label>
                                    <select  id="incident-rank_id" 
                                        ng-model="staffRank"
                                        class="form-control" 
                                        name="rank_id"
                                        ng-options="item as item.name for item in rankings track by item.id">
                                        <option value="">Select Staff Rank</option>
                                    </select>
                                </div>

                                <div id="rank" ng-show="staffRank.id == -1">
                                    <div class="form-group field-incident-other_staff_rank">
                                        <label for="incident-other_staff_rank">Other Rank</label>
                                        <div class="form-line">
                                            <textarea  id="incident-other_staff_rank" placeholder="Other ..." class="form-control" name="other_staff_rank" rows="3">{{ $incident->other_staff_rank }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #End Hospital and Event Detail Section-->

                <!-- Investigation Section -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header bg-orange">
                                <h2>Investigation</h2>
                            </div>
                            <div class="body">
                                <div class="form-group field-incident-task_factors">
                                    <label for="incident-task_factors">Task Factors</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            placeholder="Task Factors ..." 
                                            id="incident-task_factors" 
                                            class="form-control" 
                                            name="task_factors"
                                            value="{{ old('task_factors') ? old('task_factors') : $incident->task_factors }}">
                                    </div>
                                </div>

                                <div class="form-group field-incident-individual_provider_factors">
                                    <label for="incident-individual_provider_factors">Individual Provider Factors</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            placeholder="Individual Provider Factors ..." 
                                            id="incident-individual_provider_factors"  
                                            value="{{ old('individual_provider_factors') ? old('individual_provider_factors') :  $incident->individual_provider_factors }}" 
                                            class="form-control" 
                                            name="individual_provider_factors">
                                    </div>
                                </div>

                                <div class="form-group field-incident-human_factors">
                                    <label for="incident-human_factors">Human Factors</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            placeholder="Human Factors ..." 
                                            id="incident-human_factors" 
                                            class="form-control" 
                                            value="{{ old('human_factors') ? old('human_factors') : $incident->human_factors }}" 
                                            name="human_factors">
                                    </div>
                                </div>

                                <div class="form-group field-incident-team_factors">
                                    <label for="incident-team_factors">Team Factors</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            placeholder="Team Factors ..." 
                                            id="incident-team_factors" 
                                            class="form-control" 
                                            value="{{ old('team_factors') ? old('team_factors') : $incident->team_factors }}" 
                                            name="team_factors">
                                    </div>
                                </div>
                            
                                <div class="form-group field-incident-work_enviromnent_factors">
                                    <label for="incident-work_enviromnent_factors">Work Environment Factors</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            placeholder="Work Environment Factors ..." 
                                            id="incident-work_enviromnent_factors" 
                                            class="form-control" 
                                            value="{{ old('work_enviromnent_factors') ? old('work_enviromnent_factors') : $incident->work_enviromnent_factors }}" 
                                            name="work_enviromnent_factors">
                                    </div>
                                </div>

                                <div class="form-group field-incident-departmental_factors">
                                    <label for="incident-departmental_factors">Departmental Factors</label>
                                    <div class="form-line">
                                        <input type="text"  placeholder="Departmental Factors ..." 
                                            id="incident-departmental_factors" 
                                            class="form-control" 
                                            value="{{ old('departmental_factors') ? old('departmental_factors') : $incident->departmental_factors }}" 
                                            name="departmental_factors">
                                    </div>
                                </div>

                                <div class="form-group field-incident-organisational_factors">
                                    <label for="incident-organisational_factors">Organisational Factors</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            placeholder="Organisational Factors ..." 
                                            id="incident-organisational_factors" 
                                            class="form-control" 
                                            value="{{ old('organisational_factors') ? old('organisational_factors') : $incident->organisational_factors }}" 
                                            name="organisational_factors">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header bg-blue">
                                <h2>Investigation </h2>
                            </div>
                            <div class="body">
                                <div class="form-group field-incident-patient_characteristics">
                                    <label for="incident-patient_characteristics">Patient  Characteristics</label>
                                    <div class="form-line">
                                        <textarea id="incident-patient_characteristics" 
                                            placeholder="Patient  Characteristics ..." 
                                            class="form-control"
                                            name="patient_characteristics" rows="3">
                                            {{ old('patient_characteristics') ? old('patient_characteristics') : $incident->patient_characteristics }}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group field-incident-investigator">
                                    <label for="incident-investigator">Investigator</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            placeholder="Investigator ..." 
                                            id="incident-investigator" 
                                            class="form-control"  
                                            value="{{ $incident->investigator ? ($incident->investigator->first_name.' '.$incident->investigator->last_name) : (Auth::user()->first_name.' '.Auth::user()->last_name) }}" 
                                            name="investigator" 
                                            maxlength="45" 
                                            disabled>
                                    </div>
                                </div>

                                <div class="form-group field-incident-investigation_date">
                                    <label for="incident-investigation_date">Investigation Date</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            id="incident-investigation_date" 
                                            class="form-control datepicker" 
                                            value="{{ old('investigation_date') ? old('investigation_date') : $incident->investigation_date }}" 
                                            name="investigation_date" 
                                            placeholder="Enter Investigation date...">
                                    </div>
                                </div>

                                <div class="form-group field-incident-hod_comments">
                                    <label for="incident-hod_comments">HOD Comments(NSM, PM, FM &amp; HM)</label>
                                    <div class="form-line">
                                        <textarea 
                                            id="incident-hod_comments" 
                                            placeholder="HOD Comments ..." 
                                            class="form-control" 
                                            name="hod_comments" 
                                            rows="3">{{ old('hod_comments') ? old('hod_comments') : $incident->hod_comments }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group field-incident-staff_involved">
                                    <label for="incident-staff_involved">Staff Involved</label>
                                    <div class="form-line">
                                        <input id="incident-staff_involved" 
                                            placeholder="Staff Involved ..." 
                                            class="form-control" 
                                            name="staff_involved"  
                                            value='{{ $incident->user->first_name.' '.$incident->user->last_name }}'
                                            disabled/>
                                    </div>
                                </div>

                                <div class="form-group field-incident-reported_to_legal">
                                    <label for="incident-reported_to_legal">Reported To Legal Department</label>
                                    <div class="switch">
                                        <label>NO<input name="reported_to_legal" type="checkbox" ng-model="reportedToLegal"><span class="lever"></span>YES</label>
                                    </div>
                                </div>

                                <div class="form-group field-incident-date_reported" ng-show="reportedToLegal">
                                    <label for="incident-date_reported">Date reported to department</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            placeholder="Date reported to department ..." 
                                            id="incident-date_reported" 
                                            class="form-control datetimepicker" 
                                            value="{{ old('date_reported') ? old('date_reported') : $incident->time_reported }}" 
                                            name="date_reported" >
                                    </div>
                                </div>

                                <div class="form-group field-incident-event_grading">
                                    <label for="incident-event_grading">Event Grading</label>
                                    <div class="">
                                        <select id="incident-event_grading" 
                                            class="form-control"
                                            name="event_grading"
                                            ng-model="selectedGrading"
                                            ng-options="item as item.name for item in gradings track by item.id">
                                            <option value="">Select Event Grading...</option>
                                        </select>
                                        <input name="send_catastrophy_email" ng-if="(selectedGrading.name == 'Major/ Catastrophic')" ng-value="true" type="hidden" />
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <!--#END Investigation Detail Section-->

                <!-- Action Plans and Recomendations -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header bg-blue">
                                <h2>Action Plan/Recommendations</h2>
                            </div>
                            <div class="body">
                                <div id="incident_type">
                                    <div class="form-group field-incident-action_plan_recommendations">
                                        <label for="incident-action_plan_recommendations">Action Plan (Investigator &amp; HOD)</label>
                                        <div class="form-line">
                                            <textarea 
                                                id="incident-action_plan_recommendations" 
                                                placeholder="Action Plan ..." 
                                                class="form-control" 
                                                name="action_plan_recommendations" 
                                                rows="3">{{ old('action_plan_recommendations') ? old('action_plan_recommendations') : $incident->action_plan_recommendations }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group field-incident-action_plan_recommendations">
                                    <label for="incident-lessons_learned">Lessons Learnt</label>
                                    <div class="form-line">
                                        <textarea 
                                            id="incident-lessons_learned" 
                                            placeholder="Lessons Learnt" 
                                            class="form-control" 
                                            name="lessons_learned" 
                                            rows="3">{{ old('lessons_learned') ? old('lessons_learned') : $incident->lessons_learned }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header bg-green">
                                <h2>Action Plan/Recommendations </h2>
                            </div>

                            <div class="body">
                                <div class="form-group field-incident-action_date">
                                    <label for="incident-action_date">Action Date</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            id="incident-action_date" 
                                            class="form-control datepicker" 
                                            name="action_date" 
                                            value="{{ old('action_date') ? old('action_date') : $incident->action_date }}" 
                                            placeholder="Enter Action by date...">
                                    </div>
                                </div>

                                <div class="form-group field-incident-hospital_manager_date">
                                    <label for="incident-hospital_manager_date">Hospital Manager Signed Off Date</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            id="incident-hospital_manager_date" 
                                            class="form-control datepicker" 
                                            name="hospital_manager_date" 
                                            value="{{ old('hospital_manager_date') ? old('hospital_manager_date') : $incident->hospital_manager_date }}" 
                                            placeholder="Enter Hospital manager date...">
                                    </div>
                                </div>

                                <div class="form-group field-incident-event_closed_date">
                                    <label for="incident-event_closed_date">Event Closed Date and Time</label>
                                    <div class="form-line">
                                        <input type="text" 
                                            id="incident-event_closed_date"
                                            class="form-control datetimepicker" 
                                            name="event_closed_date" 
                                            value="{{ old('event_closed_date') ? old('event_closed_date') : $incident->event_closed_date }}" 
                                            placeholder="Enter Incident closed date..." >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                        <div class="card">
                            <div class="body">
                                <button type="submit" class="btn bg-green waves-effect">
                                    <i class="material-icons">mode_edit</i>
                                    <span>Update</span>
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

            //Just updating the format of event closed date
            $("#incident-event_closed_date").bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm',
                clearButton: true,
                weekStart: 1
            });

            $("#incident-event_date").bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm',
                clearButton: true,
                weekStart: 1
            });

            // Controller
            var updateIncidentApp = angular.module('updateIncidentApp', ['ngSanitize'], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });


            updateIncidentApp.controller('updateIncidentController', ['$scope','$http', '$window', '$filter','$timeout' , function($scope, $http, $window, $filter, $timeout) {
                $scope.subs          = {!! $subs !!};
                $scope.categories    = {!! $categories !!};
                $scope.types         = {!! $types !!};
                $scope.rankings      = {!! $rankings !!};
                $scope.gradings      = {!! $gradings !!};

                $scope.diagnosis     = {!! $diagnosis !!}
                $scope.eventDiagnosis = {!! $incident->diagnosis_id ? $incident->diagnosis_id : -1 !!}

                $scope.wards         = {!! $wards !!}
                $scope.eventWard     = {!! $incident->ward_id ? $incident->ward_id : -1 !!}

                $scope.categoryID    = {!! $incident->event_category ? $incident->event_category : 'null' !!}
                $scope.eventCategory = _.findWhere($scope.categories, {id: $scope.categoryID});

                $scope.eventTypeID   = {!! $incident->event_type_id ? $incident->event_type_id : 'null' !!};
                $scope.eventType     = _.findWhere($scope.types, { id: $scope.eventTypeID });

                $scope.rankID          = {!! $incident->staff_rank ? $incident->staff_rank : 'null' !!};
                $scope.staffRank       = _.findWhere($scope.rankings, {id: $scope.rankID});

                $scope.reportedToLegal = {{ $incident->reported_to_legal || old('reported_to_legal') ? 'true' : 'false' }}

                $scope.subCategoryID = {!! $incident->subCategory ? $incident->subCategory->id : 'null'  !!};
                
                $scope.deathID       = {!! $incident->type_of_death ? $incident->type_of_death : 'null' !!};
                $scope.deathTriggerID = {!! $incident->death_type_trigger_id ? $incident->death_type_trigger_id : 'null' !!};
                $scope.deathTrigger   = !_.isUndefined($scope.typeOfDeath) ? _.findWhere($scope.typeOfDeath.triggers, {id: $scope.deathTriggerID}) : [];

                $scope.gradingID      = {!! $incident->event_grading ? $incident->event_grading : 'null' !!};
                $scope.selectedGrading = _.findWhere($scope.gradings, {id: $scope.gradingID});

                $timeout(()=> {
                    $('#incident-rank_id').selectpicker('refresh');
                    $('#incident-category_id').selectpicker('refresh');
                    $('#incident-death_type_id').selectpicker('refresh');
                    $('#incident-event_type_id').selectpicker('refresh');
                    $('#incident-event_grading').selectpicker('refresh');
                    $('#incident-death_type_trigger_id').selectpicker('refresh');
                });

                $scope.subCategories = ($scope.categoryID != null) ? $scope.subs[$scope.categoryID] : [];
                $scope.selectedSubCategory = _.findWhere($scope.subCategories, {id: $scope.subCategoryID});

                $timeout(()=> $('#incident-sub_category_id').selectpicker('refresh'));
                
                $scope.onChangeCategory = category => {
                    console.log("onChangeCategory", category)
                    $timeout(()=> $('#incident-sub_category_id').selectpicker('refresh'));
                }

                $scope.updateEventype = eventType => {
                    //
                }

                $scope.onDeathChanged = _death => {

                    if (_death && _death.triggers.length > 0) {
                        _death.triggers.push({
                            id: -1,
                            name: "Other",
                            death_id: _death.id
                        })
                    }

                    $timeout(()=> {
                        $('#incident-death_type_trigger_id').selectpicker('refresh');
                    });
                };

                $scope.onChangeTrigger = (trigger) => {
                    console.log("onChangeTrigger", trigger)
                    $timeout(()=> $('#incident-death_trigger_id').selectpicker('refresh'));
                };

                $scope.onChangeCategory = category => {
                    $timeout(()=> $('#incident-sub_category_id').selectpicker('refresh'));
                }

            }]);
        })();
    </script>

@endsection