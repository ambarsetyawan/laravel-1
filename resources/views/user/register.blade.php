@extends('app')
@section('header')
    
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @if (Session::has('register_status'))
                        <?php $register_status = Session::get('register_status')?>
                        <div class="alert alert-{{$register_status['status']}}">
                            <p>{{ $register_status['message'] }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                <p class="errors">{{$errors->first('name')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                <p class="errors">{{$errors->first('email')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                                <p class="errors">{{$errors->first('password')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="checkbox" class="" name="is_owner">
                                <label class="control-label">Is Owner (Register new account for Owner)</label>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 login-socical">
                                <a href="{{ url('/user/facebookredirect') }}"><img src="{{ URL::to('/') }}/public/images/facebook.png" width="35" height="35"></a>
                                <a href="{{ url('/user/googleredirect') }}"><img src="{{ URL::to('/') }}/public/images/google.png" width="35" height="35"></a>
                                <a href="{{ url('/user/logintt') }}"><img src="{{ URL::to('/') }}/public/images/twitter.png" width="35" height="35"></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
