@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Setting Account</div>
                <div class="panel-body">
                    @if (Session::has('setting_status'))
                        <?php $setting_status = Session::get('setting_status')?>
                        <div class="alert alert-{{$setting_status['status']}}">
                            <p>{{ $setting_status['message'] }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/user/setting') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Image</label>
                            <div class="col-md-6">
                                <img src="{{Session::get('url_image_auth')}}" class="avatar-setting" id="target">
                                <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" id="avatar_setting"/>
                                <p class="errors">{{$errors->first('image')}}</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">Name (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                <p class="errors">{{$errors->first('name')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Birthday (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control date" id="" name="birthday" value="{{ Auth::user()->birthday }}">
                                <p class="errors">{{$errors->first('birthday')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Address (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                                <p class="errors">{{$errors->first('address')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Current Password (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="current_password">
                                <p class="errors">{{$errors->first('current_password')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 control-label" href="#" id="show_change_pass">Change password</label>
                        </div>

                        <div id="change_pass">
                            <div class="form-group">
                                <label class="col-md-4 control-label">New Password (<span class="require"> * </span>)</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                    <p class="errors">{{$errors->first('password')}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Confirm New Password (<span class="require"> * </span>)</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#target').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function(){
        check = "{{old('password').old('password_confirmation')}}";
        if(check != "")
            $("#change_pass").show();
        else
            $("#change_pass").hide();
        $("#show_change_pass").click(function(){
            if($("#change_pass").is(':hidden'))
                $("#change_pass").show();
            else
                $("#change_pass").hide();
        });
        $("#avatar_setting").change(function(){
            readURL(this);
        });
    });
</script>
<style type="text/css">
    #show_change_pass{
        color: #337ab7;
        font-style: italic;
        text-decoration: underline;
    }
</style>