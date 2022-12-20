@extends(backpack_view('blank'))

@section('after_styles')
    <style media="screen">
        .backpack-profile-form .required::after {
            content: ' *';
            color: red;
        }
    </style>
@endsection

@php
  $breadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      trans('backpack::base.my_account') => false,
  ];
@endphp

@section('header')
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>{{ trans('backpack::base.my_account') }}</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">

        @if (session('success'))
        <div class="col-lg-8">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if ($errors->count())
        <div class="col-lg-8">
            <div class="alert alert-danger">
                <ul class="mb-1">
                    @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- USER INFO FORM --}}
        <div class="container-fluid animate__fadeInIn">
            <div class="row">
                <div class="col-md-3 p-0">
                    <div class="card card-card card-accent-primary">
                        <div class="card-header">User Info</div>
                        {{-- profile --}}
                        <div class="card-body p-0">
                            <div class="card-body card-profile p-0">
                                <div class="border-card text-center px-4 py-3">
                                    <img src="https://cicstaging.z1central.com/uploads/files/default/default-user-icon.png" class="profile-user-img img-responsive img-fluid d-block mx-auto rounded-circle img-thumbnail" alt="">
                                </div>
                                <div class="text-center">
                                    <h3>{{Auth::user()->name ?? "Vinsmoke"}}</h3>
                                </div>
                                <ul class="list-group nav-stacked">
                                    <li class="list-group-item" id="tab_info">
                                        <a id="change_user_info">
                                            <em class="nav-icon la la-user-edit la-lg mr-2"></em>
                                            Update Account Info
                                        </a>
                                    </li>
                                    <li class="list-group-item" id="tab_password">
                                        <a id="change_password">
                                            <em class="nav-icon la la-lock la-lg mr-2"></em>
                                            Change Password
                                        </a>
                                    </li>
                                    {{-- <a href="#" class="btn btn-info btn-block"><b>Change Profile</b></a> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- UPDATE INFO FORM --}}
                <div class="col-md-9">
                    <form class="form" action="{{ route('backpack.account.info.store') }}" method="post">

                        {!! csrf_field() !!}

                        <div class="card padding-10">

                            <div class="card-header" id="change_user_info">
                                {{ trans('backpack::base.update_account_info') }}
                            </div>

                            <div class="card-body backpack-profile-form bold-labels">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        @php
                                            $label = trans('backpack::base.name');
                                            $field = 'name';
                                        @endphp
                                        <label class="required">{{ $label }}</label>
                                        <input required class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        @php
                                            $label = config('backpack.base.authentication_column_name');
                                            $field = backpack_authentication_column();
                                        @endphp
                                        <label class="required">{{ $label }}</label>
                                        <input required class="form-control" type="{{ backpack_authentication_column()==backpack_email_column()?'email':'text' }}" name="{{ $field }}" value="{{ old($field) ? old($field) : $user->$field }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Profile</label>
                                        <input class="form-control-file" type="file" name="profile" onchange="preview(event)">
                                        <img src="" alt="" id="img" width="150px" style="margin-top: 20px">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.save') }}</button>
                                <a href="{{ backpack_url() }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
                            </div>
                        </div>

                    </form>
                    {{-- CHANGE PASSWORD FORM --}}
                <div class="col-md-0">
                    <form class="form" action="{{ route('backpack.account.password') }}" method="post">

                        {!! csrf_field() !!}

                        <div class="card padding-10">

                            <div class="card-header">
                                {{ trans('backpack::base.change_password') }}
                            </div>

                            <div class="card-body backpack-profile-form bold-labels">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        @php
                                            $label = trans('backpack::base.old_password');
                                            $field = 'old_password';
                                        @endphp
                                        <label class="required">{{ $label }}</label>
                                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        @php
                                            $label = trans('backpack::base.new_password');
                                            $field = 'new_password';
                                        @endphp
                                        <label class="required">{{ $label }}</label>
                                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        @php
                                            $label = trans('backpack::base.confirm_password');
                                            $field = 'confirm_password';
                                        @endphp
                                        <label class="required">{{ $label }}</label>
                                        <input autocomplete="new-password" required class="form-control" type="password" name="{{ $field }}" id="{{ $field }}" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                    <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.change_password') }}</button>
                                    <a href="{{ backpack_url() }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
                            </div>

                        </div>

                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('after_scripts')
    <script>
        $(document).ready(function(){
            $("#tab-info").click(function(){
                $("#change-info").show();
                $("#change-password").hide();
                $("#tab-password").removeClass("tab-active");
                $("#tab-info").addClass("tab-active");
            });

            $("#tab-password").click(function(){
                $("#change-info").hide();
                $("#change-password").show();
                $("#tab-info").removeClass("tab-active");
                $("#tab-password").addClass("tab-active");
            });
        });

        function preview(evt)
        {
            let img = document.getElementById('img');
            img.src = URL.createObjectURL(evt.target.files[0]);
        }
    </script>
@endpush

