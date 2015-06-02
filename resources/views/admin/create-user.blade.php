@extends('admin.template')
@section('content')
     <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Create New User</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
                <div class="panel-body">
                    @if (Session::has('setting_status'))
                        <?php $setting_status = Session::get('setting_status')?>
                        <div class="alert alert-{{$setting_status['status']}}">
                            <p>{{ $setting_status['message'] }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('admin/user/create') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Username">
                                <p class="errors">{{$errors->first('name')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="name" placeholder="Email-address">
                                <p class="errors">{{$errors->first('name')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Birthday (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control date" id="" name="birthday" placeholder="Birthday">
                                <p class="errors">{{$errors->first('birthday')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" placeholder="Address">
                                <p class="errors">{{$errors->first('address')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                                <p class="errors">{{$errors->first('password')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm New Password (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
