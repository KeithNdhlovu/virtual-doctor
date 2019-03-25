@extends('layouts.app')

@section('content')

  <div class="row clearfix">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <h2>
                  User information
              </h2>
              <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="/users">{{ trans('usersmanagement.usersBackBtn') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

              @if ($user->name)

                <div class="col-sm-5 col-xs-6 text-larger">
                  <strong>
                    {{ trans('usersmanagement.labelUserName') }}
                  </strong>
                </div>

                <div class="col-sm-7">
                  {{ $user->name }}
                </div>

                <div class="clearfix"></div>
                <div class="border-bottom"></div>

              @endif

              @if ($user->email)

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelEmail') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ HTML::mailto($user->email, $user->email) }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

              @endif

              @if ($user->first_name)

                <div class="col-sm-5 col-xs-6 text-larger">
                  <strong>
                    {{ trans('usersmanagement.labelFirstName') }}
                  </strong>
                </div>

                <div class="col-sm-7">
                  {{ $user->first_name }}
                </div>

                <div class="clearfix"></div>
                <div class="border-bottom"></div>

              @endif

              @if ($user->last_name)

                <div class="col-sm-5 col-xs-6 text-larger">
                  <strong>
                    {{ trans('usersmanagement.labelLastName') }}
                  </strong>
                </div>

                <div class="col-sm-7">
                  {{ $user->last_name }}
                </div>

                <div class="clearfix"></div>
                <div class="border-bottom"></div>

              @endif

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelRole') }}
                </strong>
              </div>

              <div class="col-sm-7">
                  <span class="label label-{{ $user->getRole()->color }}">{{ $user->getRole()->name }}</span>
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

              @if ($user->created_at)

                <div class="col-sm-5 col-xs-6 text-larger">
                  <strong>
                    {{ trans('usersmanagement.labelCreatedAt') }}
                  </strong>
                </div>

                <div class="col-sm-7">
                  {{ $user->created_at->format("Y-m-d H:i:s") }}
                </div>

                <div class="clearfix"></div>
                <div class="border-bottom"></div>

              @endif

              @if ($user->updated_at)

                <div class="col-sm-5 col-xs-6 text-larger">
                  <strong>
                    {{ trans('usersmanagement.labelUpdatedAt') }}
                  </strong>
                </div>

                <div class="col-sm-7">
                  {{ $user->updated_at->diffForHumans() }}
                </div>

                <div class="clearfix"></div>
                <div class="border-bottom"></div>

              @endif

            </div>

          </div>
      </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('scripts')

  @include('scripts.delete-modal-script')

@endsection
