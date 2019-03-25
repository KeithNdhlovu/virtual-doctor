
<div class="panel panel-primary @if('admin', true) panel-info  @endrole">
    <div class="panel-heading">

        Welcome {{ Auth::user()->name }}

        @if('admin', true)
            <span class="pull-right label label-primary" style="margin-top:4px">
            Admin Access
            </span>
        @endrole

        @if('facilitator', true)
            <span class="pull-right label label-primary" style="margin-top:4px">
            Facilitator Access
            </span>
        @endrole
            
        @if('user', true)
            <span class="pull-right label label-warning" style="margin-top:4px">
            User Access
            </span>
        @endrole

    </div>
    <div class="panel-body">
        <h2 class="lead">
            {{ trans('auth.loggedIn') }}
        </h2>

        @if('admin')
            <p>
                As an <code>Admin</code> you can basicaly do anything you want
            </p>
        @endrole
        @if('facilitator')
            <p>
                As a <code>Facilitator</code> you can basicaly do anything you want
            </p>
        @endrole
        @if('user')
            <p>
                As a <code>Normal User</code> you can only just create incidents
            </p>
        @endrole
        <p>
            This page route is protected by <code>activated</code> middleware. Only accounts with activated emails are able pass this middleware.
        </p>
        
        <hr>

        <h4>
            You have
                @if('admin')
                   Admin
                @endrole
                @if('facilitator')
                   Facilitator 
                @endrole
                @if('user')
                   User
                @endrole
            Access
        </h4>

        <hr>

        <h4>
            You have access to {{ $levelAmount }}:
            @level(6)
                <span class="label label-primary margin-half">6</span>
            @endlevel

            @level(5)
                <span class="label label-primary margin-half">5</span>
            @endlevel

            @level(4)
                <span class="label label-info margin-half">4</span>
            @endlevel

            @level(3)
                <span class="label label-success margin-half">3</span>
            @endlevel

            @level(2)
                <span class="label label-warning margin-half">2</span>
            @endlevel

            @level(1)
                <span class="label label-default margin-half">1</span>
            @endlevel
        </h4>

        @if('admin')

            <hr>

            <h4>
                You have permissions:
                @permission('view.users')
                    <span class="label label-primary margin-half margin-left-0"">
                        {{ trans('permsandroles.permissionView') }}
                    </span>
                @endpermission

                @permission('create.users')
                    <span class="label label-info margin-half margin-left-0"">
                        {{ trans('permsandroles.permissionCreate') }}
                    </span>
                @endpermission

                @permission('edit.users')
                    <span class="label label-warning margin-half margin-left-0"">
                        {{ trans('permsandroles.permissionEdit') }}
                    </span>
                @endpermission

                @permission('delete.users')
                    <span class="label label-danger margin-half margin-left-0"">
                        {{ trans('permsandroles.permissionDelete') }}
                    </span>
                @endpermission

            </h4>

        @endrole

    </div>
</div>