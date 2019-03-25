@extends('layouts.app')

@section('title', Auth::user()->name. 'Homepage')


@section('content')

    <!-- Dev visuals -->
    <!--@include('panels.welcome-panel')-->
    @if(Session::has('success'))
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header bg-success">
                    <h2>
                        Succesfully created your Event
                    </h2>
                </div>
                <div class="body">
                    <p>We have also sent a notification to this hospitals HODs to be aware of the recently created event, so that they can investigate</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>YOUR EVENTS</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Event Category</th>
                                    <th>Diagnosis</th>
                                    <th>Date Of Event</th>
                                    <th>Dr Name &amp; Surname</th>
                                    <th>Time Dr Notified</th>
                                    <th>Time Seen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$incidents->isEmpty())
                                    @foreach($incidents as $incident)
                                        <tr>
                                            <td>{{ $incident->id }}</td>
                                            <td>{{ $incident->eventType ? $incident->eventType->name : $incident->other_event_type }}</td>
                                            <td>{{ $incident->category ? $incident->category->name : $incident->other_event_category }}</td>
                                            <td>{{ $incident->diagnosis ? $incident->diagnosis->name : $incident->other_diagnosis }}</td>
                                            <td>{{ \Carbon\Carbon::parse($incident->event_date)->format('Y-m-d H:i') }}</td>
                                            <td>{{ $incident->doctors_fullname }}</td>
                                            <td>{{ $incident->time_notified }}</td>
                                            <td>{{ $incident->time_seen_by_doctor }}</td>
                                        </tr>
                                    @endforeach
                                @else 
                                <tr>
                                    <td colspan="10" class="text-center"><h3>No Events created yet.</h3></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>

@endsection

@section('scripts')
    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>
    
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
    
    <!-- Custom Js -->
    <script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>
    
    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>
@endsection