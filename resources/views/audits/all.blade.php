@extends('layouts.app')

@section('title', Auth::user()->name. 'Audit Trail')


@section('content')

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
            <div class="card">
                <div class="body">
                    <form method="GET" action="{{ route('trail') }}" class="row form-group">
                        <div class="col-xs-4">
                            <div class="form-line">
                                <input type="text" value="{{ isset($startDate) ? $startDate : null }}" required id="start_date" class="form-control datepicker" name="start_date" placeholder="Enter Start Date..." >
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-line">
                                <input type="text" value="{{ isset($endDate) ? $startDate : null }}" required id="end_date" class="form-control datepicker" name="end_date" placeholder="Enter End Date..." >
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <button type="submit" class="btn bg-deep-orange waves-effect col-xs-12">
                                <i class="material-icons">filter_list</i>
                                <span>Filter</span>
                            </button>
                        </div>
                        <div class="col-xs-2">
                            <a href="{{ route('trail') }}" class="btn bg-deep-orange waves-effect col-xs-12">
                                <i class="material-icons">clear</i>
                                <span>Clear</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>SMS Audit trail</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SMS Account</th>
                                    <th>Fullname</th>
                                    <th>Cellphone</th>
                                    <th>Delivery Status</th>
                                    <th>Network Carrier</th>
                                    <th>Message</th>
                                    <th>Sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$audits->isEmpty())
                                    @foreach($audits as $audit)
                                        <tr>
                                            <td>{{ $audit->id }}</td>
                                            <td>{{ $audit->account_username }}</td>
                                            <td>{{ $audit->fullname }}</td>
                                            <td>{{ $audit->cellphone }}</td>
                                            <th>{{ $audit->delivery_status }}</th>
                                            <th>{{ $audit->network_carrier }}</th>
                                            <td>{{ $audit->message }}</td>
                                            <td>{{ $audit->created_at->format("Y-m-d H:i:s") }}</td>
                                        </tr>
                                    @endforeach
                                @else 
                                <tr>
                                    <td colspan="10" class="text-center"><h3>No SMS Audit trail created yet.</h3></td>
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

    })();
    </script>
@endsection