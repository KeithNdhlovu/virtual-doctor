@extends('layouts.app')

@section('template_title', 'Showing Users')

@section('content')
    
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        SHOWING ALL USERS
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/users/create">Create New User</a></li>
                                <li><a href="/users/deleted">Show Deleted User</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="body">

                    <div class="table-responsive users-table">
                        <table class="table table-striped table-condensed js-exportable dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="hidden-xs">Email</th>
                                    <th class="hidden-xs">First Name</th>
                                    <th class="hidden-xs">Last Name</th>
                                    <th>User Type</th>
                                    <th class="hidden-sm hidden-xs hidden-md">Created</th>
                                    <th class="hidden-sm hidden-xs hidden-md">Updated</th>
                                    <th>Actions</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    @if (Auth::user()->id === $user->id)
                                        @continue
                                    @endif
                                    
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td class="hidden-xs"><a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a></td>
                                        <td class="hidden-xs">{{$user->first_name}}</td>
                                        <td class="hidden-xs">{{$user->last_name}}</td>
                                        <td>
                                            <span class="label label-{{ $user->getRole()->color }}">{{ $user->getRole()->name }}</span>
                                        </td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$user->created_at}}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$user->updated_at}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'users/' . $user->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button('<i class="material-icons">delete</i>', array('class' => 'btn btn-danger btn-circle waves-effect waves-circle waves-float','type' => 'button','data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-circle waves-effect waves-circle waves-float" 
                                                href="{{ URL::to('users/' . $user->id) }}" 
                                                data-toggle="tooltip" title="Show">
                                                <i class="material-icons">remove_red_eye</i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-circle waves-effect waves-circle waves-float" 
                                                href="{{ URL::to('users/' . $user->id . '/edit') }}" 
                                                data-toggle="tooltip" 
                                                title="Edit">
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('scripts')
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
    <!-- <script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script> -->

    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>

    <script>
    $(function(){
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: []
        });
    })
    </script>
@endsection