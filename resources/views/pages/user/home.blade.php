@extends('layouts.app')

@section('title', Auth::user()->name ." s Events")

@section('content')

    @if(Session::has('reportEmailSent'))
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header bg-success">
                    <h2>
                        Your dashboard statistics have been emailed to [ {{ Auth::user()->email }} ], please check your email in a few minutes.
                    </h2>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
            <div class="card">
                <div class="body">
                    <a href="{{ route('report.print') }}" class="btn bg-green waves-effect">
                        <i class="material-icons">verified_user</i>
                        <span>Email Dashboard As PDF</span>
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    <style>
        .dashboard .col-xs-12, .col-xs-6, .col-xs-3 {
            margin: 0 !important;
        }
    </style>
    <div ng-app="dashboardApp" ng-controller="dashboardController">
        <div class="row clearfix" ng-if="isLoading">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Loading Dashboad
                            <small>Please wait while we load your dashboard information, this might take a while !</small>
                        </h2>
                    </div>
                    <div class="body text-center">
                        <div class="preloader">
                            <div class="spinner-layer pl-red">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div ng-if="!isLoading && hasErrros" class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header bg-red">
                        <h2>
                            An Unkown Error Occured while loading the dashboard, please try again later!
                            <small>Refresh and be a little patient and if the problem persists please contact Tech Support!</small>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div ng-show="!isLoading" class="row clearfix">
            <div class="col-xs-12 text-right">
                <div class="card">
                    <div class="body">
                        <div class="row dashboard">
                            <div class="col-xs-12">
                                <form action="{{ action('UserController@index') }}" method="GET" class="row">
                                    <div class="col-xs-3">
                                        <div class="form-group field-start_date text-left">
                                            <label for="start_date">Start date</label>
                                            <div class="form-line">
                                                <input type="text" id="start_date" ng-model="data.start" class="form-control datepicker" name="start_date" placeholder="Enter start date..." >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group field-end_date text-left">
                                            <label for="end_date">End date</label>
                                            <div class="form-line">
                                                <input type="text" id="end_date" ng-model="data.end" class="form-control datepicker" name="end_date" placeholder="Enter end date..." >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="{{ action('UserController@index') }}" class="btn bg-orange waves-effect">
                                            <i class="material-icons">clear</i>
                                            <span>Clear Filters</span>
                                        </a>
                                        <button type="submit" class="btn bg-green waves-effect">
                                            <i class="material-icons">view_list</i>
                                            <span>Filter by date</span>
                                        </button>
                                        <a href="{{ route('report.print') }}" class="btn bg-green waves-effect">
                                            <i class="material-icons">verified_user</i>
                                            <span>Email Dashboard As PDF</span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div ng-show="!isLoading"> 
                <!-- Basic Examples -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    My Voice Reports
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="voice-reports" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital Name</th>
                                                <th>Complaints per Hospital</th>
                                                <th>Compliments per Hospital</th>
                                                <th>Transport Complaints</th>
                                                <th>Transport Compliments</th>
                                                <th>Surveys Per Hospitals</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td><% $hospital._overallComplaints %></td>
                                                <td><% $hospital._overallCompliments %></td>
                                                <td><% $hospital._transportComplaints %></td>
                                                <td><% $hospital._transportCompliments %></td>
                                                <td><% $hospital._surveys %></td>
                                            </tr>
                                            <tr ng-repeat="$hospital in data.hospitals" ng-if="$last" style="font-weight: bold">
                                                <td>Grand Total</td>
                                                <td><% data.totalOverallComplaints %></td>
                                                <td><% data.totalOverallCompliments %></td>
                                                <td><% data.totalTransportComplaints %></td>
                                                <td><% data.totalTransportCompliments %></td>
                                                <td><% data.totalSurveys %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Basic Examples -->

                <div class="row clearfix">
                    <!-- Bar Chart -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Completed Compliments, Complaints & Survey</h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="overall_comparisons" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Bar Chart -->
                </div>

                <div class="row clearfix">
                    <!-- Bar Chart -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Users who did not take survey</h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="opt_out_users" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Bar Chart -->
                </div>

                <div class="row clearfix">
                    <!-- Line Chart -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Compliments Per Hospital</h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="pie_chart_compliments" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Line Chart -->
                    <!-- Line Chart -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Complaints Per Hospital</h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="pie_chart_complaints" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Line Chart -->
                    <!-- Line Chart -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Surveys Per Hospital</h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="pie_chart_surveys" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Line Chart -->
                    <!-- Line Chart -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Compliments & Complaints</h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="pie_chart_compliments_complaints" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Line Chart -->
                </div>

                <!-- Hospital Wards Examples -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Detailed Complaints Analysis
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Wards/Unit</th>
                                                <th ng-repeat="$hospital in data.hospitals">
                                                    <% $hospital.nick %>
                                                </th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$ward in data.wardChartData">
                                                <td><% $ward.title %></td>
                                                <td ng-repeat="$hospitalData in $ward.hospitalData"><% $hospitalData.complaints %></td>
                                                <td><% $ward.total %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Basic Examples -->

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Detailed Analysis by Departments</h2>
                            </div>
                            <div class="body" style="height: 350px;">
                                <canvas id="bar_chart_wards_comparisons" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block-header">
                    <h2>Detailed Analysis by Departments Per Hospital</h2>
                </div>
                
                <div class="row clearfix">
                    <!--  -->
                    <div id="template" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="header-text"></h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas class="body-canvas" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hospital Wards Examples -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                Survey Completed - By Hospitals & Departments
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Unit\Ward</th>
                                                <th ng-repeat="$hospital in data.hospitals"><% $hospital.nick %></th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$ward in data.wardChartData">
                                                <td><% $ward.title %></td>
                                                <td ng-repeat="$hospitalData in $ward.hospitalData"><% $hospitalData.surveys %></td>
                                                <td><% $ward.total %></td>
                                            </tr>                                                                                     
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Basic Examples -->

                <div class="block-header">
                    <h1>Questionnaire - Breakdown & Analysis</h1>
                    <h2>*** Would you recommend the selected hospital to someone else?</h2>
                </div>
                <!-- % Recomendation -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    % Recommendation
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th>No</th>
                                                <th>Yes</th>
                                                <th>% Recomendation(Yes)</th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td><% $hospital._recomendations.no %></td>
                                                <td><% $hospital._recomendations.yes %></td>
                                                <td><% $hospital._recomendations.percentageYes %> %</td>
                                                <td><% $hospital._recomendations.total %></td>
                                            </tr>                                                                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Basic Examples -->  

                <div class="block-header">
                    <h2>*** The competence and professionalism of the nursing staff?</h2>
                </div>
                <!-- % Recomendation -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Nursing
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th ng-repeat="$rating in data.ratings"><% $rating.name %></th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td ng-repeat="$_professionalism in $hospital._professionalism"><% $_professionalism.value %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# -->

                <!-- % Recomendation -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Target Rating > 90%
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th>Excellent/Good</th>
                                                <th>Total Surveys</th>
                                                <th>Achieved Target</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td><% surveyData($hospital).nursingData.goodExc %></td>
                                                <td><% surveyData($hospital).nursingData.gTotal %></td>
                                                <td><% surveyData($hospital).nursingData.percentage %> %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# -->        
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Nursing
                                </h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="nursing_bar_chart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- % Recomendation -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Cleanliness
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th ng-repeat="$rating in data.ratings"><% $rating.name %></th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td ng-repeat="$_cleanliness in $hospital._cleanliness"><% $_cleanliness.value %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# -->

                <!-- Cleanliness -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Target Rating > 90%
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th>Excellent/Good</th>
                                                <th>Total Surveys</th>
                                                <th>Achieved Target</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td><% surveyData($hospital).cleanData.goodExc %></td>
                                                <td><% surveyData($hospital).cleanData.gTotal %></td>
                                                <td><% surveyData($hospital).cleanData.percentage %> %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Cleanliness -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Cleanliness
                                </h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="cleanliness_bar_chart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- % Catering -->
                <div class="block-header">
                    <h2>*** How would you rate the quality of the food served?</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Catering
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th ng-repeat="$rating in data.ratings"><% $rating.name %></th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td ng-repeat="$_quality in $hospital._quality"><% $_quality.value %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Target Rating > 90%
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th>Excellent/Good</th>
                                                <th>Total Surveys</th>
                                                <th>Achieved Target</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td><% surveyData($hospital).cateringData.goodExc %></td>
                                                <td><% surveyData($hospital).cateringData.gTotal %></td>
                                                <td><% surveyData($hospital).cateringData.percentage %> %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Catering Bar Chart -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Catering
                                </h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="catering_bar_chart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Cleanliness -->

                <!-- Transport -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Transport
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th ng-repeat="$rating in data.ratings"><% $rating.name %></th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td ng-repeat="$_transport in $hospital._transport"><% $_transport.value %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Target Rating > 90%
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th>Excellent/Good</th>
                                                <th>Total Surveys</th>
                                                <th>Achieved Target</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td><% surveyData($hospital).transportData.goodExc %></td>
                                                <td><% surveyData($hospital).transportData.gTotal %></td>
                                                <td><% surveyData($hospital).transportData.percentage %> %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Transport Bar Chart -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Transport
                                </h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="transport_bar_chart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Transport -->

                <!-- Pharmacy -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Pharmacy
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th ng-repeat="$rating in data.ratings"><% $rating.name %></th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td ng-repeat="$_pharmacy in $hospital._pharmacy"><% $_pharmacy.value %></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Target Rating > 90%
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th>Excellent/Good</th>
                                                <th>Total Surveys</th>
                                                <th>Achieved Target</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td><% surveyData($hospital).pharmacyData.goodExc %></td>
                                                <td><% surveyData($hospital).pharmacyData.gTotal %></td>
                                                <td><% surveyData($hospital).pharmacyData.percentage %> %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pharmacy Bar Chart -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Pharmacy
                                </h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="pharmacy_bar_chart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Pharmacy -->

                <!-- FRIENDLINESS -->
                    <!-- Friendliness -->
                    <div class="row clearfix">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Friendliness
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>Hospital</th>
                                                    <th ng-repeat="$rating in data.ratings"><% $rating.name %></th>
                                                    <th>Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="$hospital in data.hospitals">
                                                    <td><% $hospital.nick %></td>
                                                    <td ng-repeat="$_friendliness in $hospital._friendliness"><% $_friendliness.value %></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Target Rating > 90%
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>Hospital</th>
                                                    <th>Excellent/Good</th>
                                                    <th>Total Surveys</th>
                                                    <th>Achieved Target</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="$hospital in data.hospitals">
                                                    <td><% $hospital.nick %></td>
                                                    <td><% surveyData($hospital).friendlinessData.goodExc %></td>
                                                    <td><% surveyData($hospital).friendlinessData.gTotal %></td>
                                                    <td><% surveyData($hospital).friendlinessData.percentage %> %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Friendliness Bar Chart -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Friendliness
                                    </h2>
                                </div>
                                <div class="body" style="height: 400px">
                                    <canvas id="friendliness_bar_chart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Friendliness -->

                <!-- END FRIENDLINESS -->

                <!-- HOSPITAL STAY -->
                    <!-- Hospital Stay -->
                    <div class="row clearfix">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Hospital Stay
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>Hospital</th>
                                                    <th ng-repeat="$rating in data.ratings"><% $rating.name %></th>
                                                    <th>Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="$hospital in data.hospitals">
                                                    <td><% $hospital.nick %></td>
                                                    <td ng-repeat="$_hospitalStay in $hospital._hospitalStay"><% $_hospitalStay.value %></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Target Rating > 90%
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>Hospital</th>
                                                    <th>Excellent/Good</th>
                                                    <th>Total Surveys</th>
                                                    <th>Achieved Target</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="$hospital in data.hospitals">
                                                    <td><% $hospital.nick %></td>
                                                    <td><% surveyData($hospital).hospitalStayData.goodExc %></td>
                                                    <td><% surveyData($hospital).hospitalStayData.gTotal %></td>
                                                    <td><% surveyData($hospital).hospitalStayData.percentage %> %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hospital Stay Bar Chart -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Hospital Stay
                                    </h2>
                                </div>
                                <div class="body" style="height: 400px">
                                    <canvas id="hospital_stay_bar_chart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Hospital Stay -->

                <!-- END HOSPITAL STAY -->

                <!-- DOCTOR CARE -->
                    <!-- Doctor Care -->
                    <div class="row clearfix">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Doctor Care
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>Hospital</th>
                                                    <th ng-repeat="$rating in data.ratings"><% $rating.name %></th>
                                                    <th>Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="$hospital in data.hospitals">
                                                    <td><% $hospital.nick %></td>
                                                    <td ng-repeat="$_doctorCare in $hospital._doctorCare"><% $_doctorCare.value %></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Target Rating > 90%
                                    </h2>
                                </div>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>Hospital</th>
                                                    <th>Excellent/Good</th>
                                                    <th>Total Surveys</th>
                                                    <th>Achieved Target</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="$hospital in data.hospitals">
                                                    <td><% $hospital.nick %></td>
                                                    <td><% surveyData($hospital).doctorCareData.goodExc %></td>
                                                    <td><% surveyData($hospital).doctorCareData.gTotal %></td>
                                                    <td><% surveyData($hospital).doctorCareData.percentage %> %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Doctor Care Bar Chart -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Doctor Care
                                    </h2>
                                </div>
                                <div class="body" style="height: 400px">
                                    <canvas id="doctor_care_bar_chart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Doctor Care -->

                <!-- END DOCTOR CARE -->

                <!-- Did you you hospital device -->
                <div class="block-header">
                    <h2>*** Did you use a hospital provided device?</h2>
                </div>
                <!-- % Recomendation -->
                <div class="row clearfix">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Hospital</th>
                                                <th>No</th>
                                                <th>Yes</th>
                                                <th>% (Yes)</th>
                                                <th>Grand Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="$hospital in data.hospitals">
                                                <td><% $hospital.nick %></td>
                                                <td><% $hospital._devices.no %></td>
                                                <td><% $hospital._devices.yes %></td>
                                                <td><% $hospital._devices.percentageYes %> %</td>
                                                <td><% $hospital._devices.total %></td>
                                            </tr>                                                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Hospital Provided Device?
                                </h2>
                            </div>
                            <div class="body" style="height: 400px">
                                <canvas id="hospital_devices_bar_chart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- #END# Basic Examples -->  
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Chart Plugins Js -->
    <script src="{{ asset('plugins/chartjs/Chart.bundle.js') }}"></script>

    <script src="{{ asset('js/pieceLabel.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>

    <script src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular/angular-sanitize.min.js') }}"></script>

    <script src="{{ asset('js/underscore/underscore.min.js') }}"></script>


    <script>
        (function () {
            
            $("#end_date, #start_date").bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm',
                clearButton: true,
                weekStart: 1
            });

            $('#end_date').bootstrapMaterialDatePicker({ weekStart : 1 });

            $('#start_date').bootstrapMaterialDatePicker({ weekStart : 1 }).on('change', function(e, date) {
                $('#end_date').bootstrapMaterialDatePicker('setMinDate', date);
            });

            // Controller
            var dashboardApp = angular.module('dashboardApp', ['ngSanitize'], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
            });

            dashboardApp.controller('dashboardController', ['$scope','$http', '$window', '$filter','$timeout' , function($scope, $http, $window, $filter, $timeout) {

                $scope.gimmeColor = function(size) {
                    var colors = [];

                    for(var i = 0; i < size; i++) {
                        var leRandomVal = Math.random() * 360 * ( i + 1 );
                        var _color = '#' + ('00000' + (leRandomVal * (1<<24)|0 ).toString(16) ).slice(-6);
                        // var _color = "hsl(" + leRandomVal.toFixed(2) + ",100%,50%)"; //Uncomment this line for HSL color generator
                        colors.push(_color);
                    }

                    if (size === 1)
                        return colors[0];

                    return colors;
                }

                $scope.surveyChartsData = function() {

                    var hospitals = $scope.data.hospitals;
                    var nursingData  = [];
                    var cateringData = [];
                    var cleanData    = [];
                    var transportData= [];
                    var pharmacyData = [];
                    var deviceData   = [];

                    var friendlinessData = [];
                    var doctorCareData   = [];
                    var hospitalStayData = [];
                    

                    for (var xx in hospitals) {
                        var hospital = hospitals[xx];

                        // Quality data
                        var goodExc = _.filter(hospital._quality, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                        goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                        var gTotal  = _.filter(hospital._quality, function(q) { return _.contains(['Grand Total'], q.name) });
                        gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                        var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                        cateringData.push({
                            percentage,
                            color: hospital.color,
                            nick: hospital.nick,
                            goodExc,
                            gTotal
                        })

                        // Catering Data
                        var goodExc = _.filter(hospital._cleanliness, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                        goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                        var gTotal  = _.filter(hospital._cleanliness, function(q) { return _.contains(['Grand Total'], q.name) });
                        gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                        var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                        cleanData.push({
                            percentage,
                            color: hospital.color,
                            nick: hospital.nick,
                            goodExc,
                            gTotal
                        })

                        // Nursing Data
                        var goodExc = _.filter(hospital._professionalism, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                        goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                        var gTotal  = _.filter(hospital._professionalism, function(q) { return _.contains(['Grand Total'], q.name) });
                        gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                        var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                        nursingData.push({
                            percentage,
                            color: hospital.color,
                            nick: hospital.nick,
                            goodExc,
                            gTotal
                        })

                        // Transport Data
                        var goodExc = _.filter(hospital._transport, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                        goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                        var gTotal  = _.filter(hospital._transport, function(q) { return _.contains(['Grand Total'], q.name) });
                        gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                        var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                        transportData.push({
                            percentage,
                            color: hospital.color,
                            nick: hospital.nick,
                            goodExc,
                            gTotal
                        })

                        // Pharmacy Data
                        var goodExc = _.filter(hospital._pharmacy, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                        goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                        var gTotal  = _.filter(hospital._pharmacy, function(q) { return _.contains(['Grand Total'], q.name) });
                        gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                        var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                        pharmacyData.push({
                            percentage,
                            color: hospital.color,
                            nick: hospital.nick,
                            goodExc,
                            gTotal
                        })

                        // Friendliness Data
                        var goodExc = _.filter(hospital._friendliness, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                        goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                        var gTotal  = _.filter(hospital._friendliness, function(q) { return _.contains(['Grand Total'], q.name) });
                        gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                        var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                        friendlinessData.push({
                            percentage,
                            color: hospital.color,
                            nick: hospital.nick,
                            goodExc,
                            gTotal
                        })

                        // Doctor Care Data
                        var goodExc = _.filter(hospital._doctorCare, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                        goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                        var gTotal  = _.filter(hospital._doctorCare, function(q) { return _.contains(['Grand Total'], q.name) });
                        gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                        var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                        doctorCareData.push({
                            percentage,
                            color: hospital.color,
                            nick: hospital.nick,
                            goodExc,
                            gTotal
                        })

                        // Hospital Stay Data
                        var goodExc = _.filter(hospital._hospitalStay, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                        goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                        var gTotal  = _.filter(hospital._hospitalStay, function(q) { return _.contains(['Grand Total'], q.name) });
                        gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                        var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                        hospitalStayData.push({
                            percentage,
                            color: hospital.color,
                            nick: hospital.nick,
                            goodExc,
                            gTotal
                        })

                        deviceData.push({
                            nick: hospital.nick,
                            color: hospital.color,
                            no: hospital._devices.no,
                            yes: hospital._devices.yes
                        })
                    }

                    return {
                        nursing: $scope.setBarData(nursingData, 'Nursing'),
                        catering: $scope.setBarData(cateringData, 'Catering'),
                        pharmacy: $scope.setBarData(pharmacyData, 'Pharmacy'),
                        transport: $scope.setBarData(transportData, 'Transport'),
                        doctorCareData: $scope.setBarData(doctorCareData, 'Doctor Care'),
                        friendlinessData: $scope.setBarData(friendlinessData, 'Friendliness'),
                        hospitalStayData: $scope.setBarData(hospitalStayData, 'Hospital Stay'),
                        cleanliness: $scope.setBarData(cleanData, 'Cleanliness'),
                        deviceData: $scope.getDevicesBarData(deviceData, 'Hospital Device')
                    }
                }

                $scope.surveyData = function (hospital) {
                    
                    var nursingData  = {};
                    var cateringData = {};
                    var cleanData    = {};
                    var transportData= {};
                    var pharmacyData = {};
                    var deviceData   = {};

                    var friendlinessData = {};
                    var doctorCareData   = {};
                    var hospitalStayData = {};


                    // Quality data
                    var goodExc = _.filter(hospital._quality, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                    goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                    var gTotal  = _.filter(hospital._quality, function(q) { return _.contains(['Grand Total'], q.name) });
                    gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                    var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                    cateringData = {
                        percentage,
                        color: hospital.color,
                        nick: hospital.nick,
                        goodExc,
                        gTotal
                    }

                    // Catering Data
                    var goodExc = _.filter(hospital._cleanliness, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                    goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                    var gTotal  = _.filter(hospital._cleanliness, function(q) { return _.contains(['Grand Total'], q.name) });
                    gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                    var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                    cleanData = {
                        percentage,
                        color: hospital.color,
                        nick: hospital.nick,
                        goodExc,
                        gTotal
                    }

                    // Nursing Data
                    var goodExc = _.filter(hospital._professionalism, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                    goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                    var gTotal  = _.filter(hospital._professionalism, function(q) { return _.contains(['Grand Total'], q.name) });
                    gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                    var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                    nursingData = {
                        percentage,
                        color: hospital.color,
                        nick: hospital.nick,
                        goodExc,
                        gTotal
                    }

                    // Transport Data
                    var goodExc = _.filter(hospital._transport, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                    goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                    var gTotal  = _.filter(hospital._transport, function(q) { return _.contains(['Grand Total'], q.name) });
                    gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                    var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                    transportData = {
                        percentage,
                        color: hospital.color,
                        nick: hospital.nick,
                        goodExc,
                        gTotal
                    }

                    // Pharmacy Data
                    var goodExc = _.filter(hospital._pharmacy, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                    goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                    var gTotal  = _.filter(hospital._pharmacy, function(q) { return _.contains(['Grand Total'], q.name) });
                    gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                    var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                    pharmacyData = {
                        percentage,
                        color: hospital.color,
                        nick: hospital.nick,
                        goodExc,
                        gTotal
                    }

                    // Friendliness Data
                    var goodExc = _.filter(hospital._friendliness, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                    goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                    var gTotal  = _.filter(hospital._friendliness, function(q) { return _.contains(['Grand Total'], q.name) });
                    gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                    var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                    friendlinessData = {
                        percentage,
                        color: hospital.color,
                        nick: hospital.nick,
                        goodExc,
                        gTotal
                    }

                    // Doctor Care Data
                    var goodExc = _.filter(hospital._doctorCare, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                    goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                    var gTotal  = _.filter(hospital._doctorCare, function(q) { return _.contains(['Grand Total'], q.name) });
                    gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                    var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                    doctorCareData = {
                        percentage,
                        color: hospital.color,
                        nick: hospital.nick,
                        goodExc,
                        gTotal
                    }

                    // Hospital Stay Data
                    var goodExc = _.filter(hospital._hospitalStay, function(q) { return _.contains(['Excellent', 'Good'], q.name) });
                    goodExc     = _.reduce(_.pluck(goodExc, 'value'), function(memo, num){ return memo + num; }, 0);
                    var gTotal  = _.filter(hospital._hospitalStay, function(q) { return _.contains(['Grand Total'], q.name) });
                    gTotal      = _.reduce(_.pluck(gTotal, 'value'), function(memo, num){ return memo + num; }, 0);
                    var percentage = goodExc > 0 ? Math.ceil((goodExc/gTotal)*100) : 0;

                    hospitalStayData = {
                        percentage,
                        color: hospital.color,
                        nick: hospital.nick,
                        goodExc,
                        gTotal
                    }

                    deviceData = {
                        nick: hospital.nick,
                        color: hospital.color,
                        no: hospital._devices.no,
                        yes: hospital._devices.yes
                    }

                    return {
                        nursingData,
                        cateringData,
                        pharmacyData,
                        transportData,
                        doctorCareData,
                        friendlinessData,
                        hospitalStayData,
                        cleanData,
                        deviceData
                    }
                }

                $scope.setBarData = function(items, type) {
                    var datasets  = [];
                    var colors = _.pluck(items, 'color');

                    var config = {
                        type: 'bar',
                        data: {
                            labels: _.pluck(items, 'nick'),
                            datasets: [{
                                label: type,
                                data: _.pluck(items, 'percentage'),
                                borderColor: colors,
                                backgroundColor: colors,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            }
                        }
                    }

                    return config;
                }

                $scope.getDevicesBarData = function (items, type) {
                    var datasets  = [];
                    var colors = _.pluck(items, 'color');

                    var config = {
                        type: 'bar',
                        data: {
                            labels: _.pluck(items, 'nick'),
                            datasets: [{
                                label: 'Yes',
                                data: _.pluck(items, 'yes'),
                                borderColor: colors,
                                backgroundColor: colors,
                                borderWidth: 1
                            },{
                                label: "No",
                                data: _.pluck(items, 'no'),
                                borderColor: colors,
                                backgroundColor: colors,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            }
                        }
                    }

                    return config;
                }

                $scope.getBarData = function () {
                    var hospitals = $scope.data.hospitals;
                    var wards     = $scope.data.wardChartData;
                    var datasets  = [];

                    for(var xx in wards) {
                        
                        var ward  = wards[xx];
                        var color = ward.color;

                        datasets.push({
                            label: ward.title,
                            data: _.pluck(ward.hospitalData, 'complaints'),
                            borderColor: color,
                            backgroundColor: color,
                            pointBorderColor: color,
                            pointBackgroundColor: color,
                            pointBorderWidth: 1
                        });
                    }


                    var config = {
                        type: 'bar',
                        data: {
                            labels: _.pluck(hospitals, 'nick'),
                            datasets: datasets
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: true
                            }
                        }
                    }

                    return config;
                }

                $scope.getComparisonsChartData = function () {
                    var hospitals = $scope.data.hospitals;
                    var colors = $scope.gimmeColor(hospitals.length);
                    
                    var config = {
                        type: 'bar',
                        data: {
                            labels: _.pluck(hospitals, 'nick'),
                            datasets: [{
                                label: "Compliments Per Hospital",
                                data: _.pluck(hospitals, '_compliments'),
                                borderColor: '#e61a58',
                                backgroundColor: '#e61a58',
                                pointBorderColor: '#e61a58',
                                pointBackgroundColor: '#e61a58',
                                pointBorderWidth: 1
                            },
                            {
                                label: "Complaints Per Hospital",
                                data: _.pluck(hospitals, '_complaints'),
                                borderColor: '#00b4ce',
                                backgroundColor: '#00b4ce',
                                pointBorderColor: '#00b4ce',
                                pointBackgroundColor: '#00b4ce',
                                pointBorderWidth: 1
                            },
                            {
                                label: "Surveys Per Hospital",
                                data: _.pluck(hospitals, '_surveys'),
                                borderColor: '#ff8d00',
                                backgroundColor: '#ff8d00',
                                pointBorderColor: '#ff8d00',
                                pointBackgroundColor: '#ff8d00',
                                pointBorderWidth: 1
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: true
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                        min: 0
                                    }
                                }]
                            }
                        }
                    }

                    return config;
                }

                $scope.getOptOutChartData = function () {
                    var hospitals = $scope.data.hospitals;
                    var colors = $scope.gimmeColor(hospitals.length);
                    
                    var config = {
                        type: 'bar',
                        data: {
                            labels: _.pluck(hospitals, 'nick'),
                            datasets: [{
                                label: "Users Who did not take survey",
                                data: _.pluck(hospitals, '_optouts'),
                                borderColor: '#e61a58',
                                backgroundColor: '#e61a58',
                                pointBorderColor: '#e61a58',
                                pointBackgroundColor: '#e61a58',
                                pointBorderWidth: 1
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true,
                                        min: 0
                                    }
                                }]
                            }
                        }
                    }

                    return config;
                }

                $scope.getComplimentsPieData = function () {
                    var hospitals = $scope.data.hospitals;
                    var colors = _.pluck(hospitals, 'color');
                    var config = {
                        type: 'pie',
                        data: {
                            datasets: [{
                                label: "Compliments Per Hospital",
                                data: _.pluck(hospitals, '_compliments'),
                                backgroundColor: colors,
                            }],
                            labels: _.pluck(hospitals, 'nick')
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: true,
                                position: 'right'
                            },
                            pieceLabel: {
                                render: function(args) {
                                    return args.value;
                                },
                                fontColor: 'white',
                                fontSize: 18
                            },
                        }
                    }

                    return config;
                }

                $scope.getComplaintsPieData = function () {
                    var hospitals = $scope.data.hospitals;
                    var colors = _.pluck(hospitals, 'color');
                    var config = {
                        type: 'pie',
                        data: {
                            datasets: [{
                                label: "Complaints Per Hospital",
                                data: _.pluck(hospitals, '_complaints'),
                                backgroundColor: colors,
                            }],
                            labels: _.pluck(hospitals, 'nick')
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: true,
                                position: 'right'
                            },
                            pieceLabel: {
                                render: function(args) {
                                    return args.value;
                                },
                                fontColor: 'white',
                                fontSize: 18
                            },
                        }
                    }

                    return config;
                }

                $scope.getPieData = function (hospital) {
                    var wards  = hospital.wards;
                    var colors = _.pluck(wards, 'color');
                    var config = {
                        type: 'pie',
                        data: {
                            datasets: [{
                                label: "Complaints Per Hospitals Wards",
                                data: _.pluck(wards, '_complaints'),
                                backgroundColor: colors,
                            }],
                            labels: _.pluck(wards, '_title')
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: true,
                                position: 'right'
                            },
                            pieceLabel: {
                                render: function(args) {
                                    return args.value;
                                },
                                fontColor: 'white',
                                fontSize: 18
                            },
                        }
                    }

                    return config;
                }

                $scope.getSurveysPieData = function () {
                    var hospitals = $scope.data.hospitals;
                    var colors = _.pluck(hospitals, 'color');
                    var config = {
                        type: 'pie',
                        data: {
                            datasets: [{
                                label: "Surveys Per Hospital",
                                data: _.pluck(hospitals, '_surveys'),
                                backgroundColor: colors,
                            }],
                            labels: _.pluck(hospitals, 'nick')
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: true,
                                position: 'right'
                            },
                            pieceLabel: {
                                render: function(args) {
                                    return args.value;
                                },
                                fontColor: 'white',
                                fontSize: 18
                            },
                        }
                    }

                    return config;
                }

                $scope.getComplimentsComplaintsPieData = function () {
                    var colors = ['#e61a58', '#00b4ce'];

                    var config = {
                        type: 'pie',
                        data: {
                            datasets: [{
                                label: "Compliments and Complaints",
                                data: [ $scope.data.totalOverallCompliments,  $scope.data.totalOverallComplaints],
                                backgroundColor: colors,
                            }],
                            labels: ['Compliments', 'Complaints']
                        },
                        options: {
                            responsive: true,
                            legend: {
                                display: true,
                                position: 'right'
                            },
                            pieceLabel: {
                                render: function(args) {
                                    return args.value;
                                },
                                fontColor: 'white',
                                fontSize: 18
                            },
                        }
                    }

                    return config;
                }

                $scope.getChartJs = function (type) {
                    var config = null;
                    var hospitals = $scope.data.hospitals;
                    var colors = _.pluck(hospitals, 'color');

                    if (type === 'line') {
                        config = {
                            type: 'line',
                            data: {
                                labels: _.pluck(hospitals, 'nick'),
                                datasets: [{
                                    label: "Accident And Emergency",
                                    data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                                    borderColor: "rgb(233, 30, 99)",
                                    pointBorderWidth: 1
                                },
                                {
                                    label: "Adult Intensive Cate Unit",
                                    data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                                    borderColor: "rgb(255, 193, 7)",
                                    pointBorderWidth: 1
                                },
                                {
                                    label: "Casualty",
                                    data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                                    borderColor: "rgb(0, 188, 212)",
                                    pointBorderWidth: 1
                                },
                                {
                                    label: "Female Ward",
                                    data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                                    borderColor: 'rgba(0, 188, 212, 0.75)',
                                    pointBorderWidth: 1
                                },
                                {
                                    label: "Male Ward",
                                    data: [Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100), Math.ceil(Math.random()*100)],
                                    borderColor: "rgb(139, 195, 74)",
                                    pointBorderWidth: 1
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                legend: {
                                    display: false
                                },
                                elements: {
                                    line: {
                                        fill: false
                                    },
                                    point:{
                                        radius: 5
                                    }                        
                                }
                            }
                        }
                    }
                    else if (type === 'bar') {
                        config = {
                            type: 'bar',
                            data: {
                                labels: _.pluck(hospitals, 'nick'),
                                datasets: [{
                                    label: "Compliments Per Hospital",
                                    data: _.pluck(hospitals, 'data'),
                                    borderColor: '#e61a58',
                                    backgroundColor: '#e61a58',
                                    pointBorderColor: '#e61a58',
                                    pointBackgroundColor: '#e61a58',
                                    pointBorderWidth: 1
                                },
                                {
                                    label: "Complaints Per Hospital",
                                    data: _.pluck(hospitals, '_complaints'),
                                    borderColor: '#00b4ce',
                                    backgroundColor: '#00b4ce',
                                    pointBorderColor: '#00b4ce',
                                    pointBackgroundColor: '#00b4ce',
                                    pointBorderWidth: 1
                                },
                                {
                                    label: "Surveys Per Hospital",
                                    data: _.pluck(hospitals, '_surveys'),
                                    borderColor: '#ff8d00',
                                    backgroundColor: '#ff8d00',
                                    pointBorderColor: '#ff8d00',
                                    pointBackgroundColor: '#ff8d00',
                                    pointBorderWidth: 1
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                legend: {
                                    display: true
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true,
                                            min: 0
                                        }
                                    }]
                                }
                            }
                        }
                    }
                    else if (type === 'radar') {
                        config = {
                            type: 'radar',
                            data: {
                                labels: _.pluck(hospitals, 'nick'),
                                datasets: [{
                                    label: "Compliments Per Hospital",
                                    data: [65, 59, 80, 81, 56, 55],
                                    borderColor: 'rgba(0, 188, 212, 0.8)',
                                    backgroundColor: 'rgba(0, 188, 212, 0.5)',
                                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                                    pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                                    pointBorderWidth: 1
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                legend: false
                            }
                        }
                    }
                    else if (type === 'pie') {
                        config = {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    label: "Surveys Per Hospital",
                                    data: [65, 59, 80, 81, 56, 55],
                                    backgroundColor: colors,
                                }],
                                labels: _.pluck(hospitals, 'nick')
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    display: true,
                                    position: 'right'
                                },
                                pieceLabel: {
                                    render: function(args) {
                                        return args.value;
                                    },
                                    fontColor: 'white',
                                    fontSize: 18
                                },
                            }
                        }
                    }
                    return config;
                }

                $scope.init = function (data) {
                    
                    $timeout(function() {

                        $scope.data = data;
                        $scope.data.surveyData = null;

                        // We clear any chart
                        Chart.helpers.each(Chart.instances, function(instance) {
                            instance.chart.controller.destroy()
                        })

                        // Overall Comparisons
                        new Chart(document.getElementById("overall_comparisons").getContext("2d"), $scope.getComparisonsChartData());
                    
                        // Users who did not take surveyss
                        new Chart(document.getElementById("opt_out_users").getContext("2d"), $scope.getOptOutChartData());

                        // Pie Chart data for [Compliments, Complaints, Surveys]
                        new Chart(document.getElementById("pie_chart_compliments").getContext("2d"), $scope.getComplimentsPieData());
                        new Chart(document.getElementById("pie_chart_complaints").getContext("2d"), $scope.getComplaintsPieData());
                        new Chart(document.getElementById("pie_chart_surveys").getContext("2d"), $scope.getSurveysPieData());
                        new Chart(document.getElementById("pie_chart_compliments_complaints").getContext("2d"), $scope.getComplimentsComplaintsPieData());

                        $scope.loadProgress = 20;
                        
                        var parent = angular.element(document.getElementById("template"));

                        _.each($scope.data.hospitals, function($hospital) {
                            var child  = parent.clone();
                            
                            child.find(".header-text").text($hospital.nick + " Complaint Analysis");
                            child.find(".body-canvas").attr('id', "pie_chart_complaints_" + $hospital.id);

                            child.insertAfter(parent.last())

                            new Chart(document.getElementById("pie_chart_complaints_" + $hospital.id).getContext("2d"), $scope.getPieData($hospital));
                        })
                        
                        parent.hide();

                        $scope.loadProgress = 25;
                        // Chart data for hospitals per wards
                        new Chart(document.getElementById("bar_chart_wards_comparisons").getContext("2d"), $scope.getBarData());

                        $scope.loadProgress = 30;
                        $timeout(function() {
                            
                            $scope.data.surveyChartsData = $scope.surveyChartsData();
                        
                    
                            $scope.loadProgress = 35;
                            // Bar Charts
                            new Chart(document.getElementById("nursing_bar_chart").getContext("2d"), $scope.data.surveyChartsData.nursing);
                            new Chart(document.getElementById("catering_bar_chart").getContext("2d"), $scope.data.surveyChartsData.catering);
                            new Chart(document.getElementById("cleanliness_bar_chart").getContext("2d"), $scope.data.surveyChartsData.cleanliness);

                            $scope.loadProgress = 45;
                            new Chart(document.getElementById("transport_bar_chart").getContext("2d"), $scope.data.surveyChartsData.transport);
                            new Chart(document.getElementById("pharmacy_bar_chart").getContext("2d"), $scope.data.surveyChartsData.pharmacy);
                            new Chart(document.getElementById("hospital_devices_bar_chart").getContext("2d"), $scope.data.surveyChartsData.deviceData);

                            $scope.loadProgress = 50;
                            // Friendliness Chart
                            new Chart(document.getElementById("friendliness_bar_chart").getContext("2d"), $scope.data.surveyChartsData.friendlinessData);
                            new Chart(document.getElementById("doctor_care_bar_chart").getContext("2d"), $scope.data.surveyChartsData.doctorCareData);

                            $scope.loadProgress = 60;
                            new Chart(document.getElementById("hospital_stay_bar_chart").getContext("2d"), $scope.data.surveyChartsData.hospitalStayData);

                            $scope.loadProgress = 70;
                            $scope.loadProgress = 80;
                            $scope.loadProgress = 90;
                            $scope.loadProgress = 100;
                        })

                        $scope.isLoading = false;
                        $scope.hasErrros = false;

                        $timeout(function (){
                            // Redraw data tables when all is done
                            $('.js-exportable').DataTable({
                                dom: 'Bfrtip',
                                ordering: false,
                                responsive: true,
                                buttons: [
                                    'copy', 'csv', 'excel', 'print',
                                    {
                                        extend: 'pdf',
                                        text: 'Pdf',
                                        orientation: 'landscape',
                                        fontSize: 9,
                                        exportOptions: {
                                            columns: ':visible',
                                        },
                                        action: function(e, dt, button, config) {

                                            // Add code to make changes to table here
                                            $('.page-loader-wrapper').fadeIn();
                                            $('.hide-on-print').hide();

                                            // Call the original action function afterwards to
                                            // continue the action.
                                            // Otherwise you're just overriding it completely.
                                            if ($.fn.dataTable.ext.buttons.pdfHtml5.available( dt, config )) {
                                                $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, button, config);
                                            }

                                            $('.page-loader-wrapper').fadeOut();
                                            $('.hide-on-print').show();
                                        }
                                    }
                                ]
                            });

                            // Update Charts to be vissible
                            Chart.helpers.each(Chart.instances, function(instance) {
                                instance.chart.controller.resize()
                            })


                            // console.log("nursingData", $scope.data)
                        })

                    });
                }

                $scope.getData = function () {
                    $scope.isLoading = true;
                    $scope.loadProgress = 20;
                    var start = '{!! $start !!}';
                    var end   = '{!! $end !!}';

                    var url = "/api/dashboard";
                    
                    if (start && end) {

                        var config = {
                            method : "POST",
                            url : "/api/dashboard",
                            data: {
                                end_date: end,
                                start_date: start,
                            }
                        }
                    } else {
                        var config = {
                            method : "POST",
                            url : "/api/dashboard"
                        }
                    }

                    $http(config)
                        .then(function (response) {

                            $scope.init(response.data);
                            $scope.hasErrros = false;
                        }, function (errr) {
                            $scope.isLoading = false;
                            $scope.hasErrros = true;
                            alert("An Unkown Error Occured while loading the dashboard, please try again later!");
                        })
                }

                $scope.getData();
            }]);
            
        })();
    </script>
@endsection