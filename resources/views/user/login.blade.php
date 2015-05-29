@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('error') }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                <p class="errors">{{$errors->first('email')}}</p>
                            </div>                          
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                                <p class="errors">{{$errors->first('password')}}</p>
                            </div>                          
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Login</button>

                                <a class="btn btn-link" href="{{ url('/user/forgot') }}">Forgot Your Password?</a>
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
<script src="{{asset('/public/js/jquery-2.1.4.min.js')}}"></script>