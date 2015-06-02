@extends('admin.template')
@section('content')
     <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Edit User</h2>
        </div>
    </div>
    @if (Session::has('not_found_user'))
        <div class="alert alert-danger">
            <p>{{ Session::get('not_found_user') }}</p>
        </div>
    @else
    <div class="row">
        <div class="col-lg-12">
                <div class="panel-body">
                    @if (Session::has('edit_status'))
                        <?php $edit_status = Session::get('edit_status')?>
                        <div class="alert alert-{{$edit_status['status']}}">
                            <p>{{ $edit_status['message'] }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('admin/user/edit/') }}/{{$user->id}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Image</label>
                            <div class="col-md-6">
                                <img src="{{Session::get('url_image_edit_user')}}" class="avatar-setting" id="target">
                                <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" id="avatar_setting"/>
                                <p class="errors">{{$errors->first('image')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Username" value="{{$user->name}}">
                                <p class="errors">{{$errors->first('name')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email-address" value="{{ $user->email }}">
                                <p class="errors">{{$errors->first('email')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Birthday</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control date" id="" name="birthday" placeholder="Birthday" value="{{ $user->birthday }}">
                                <p class="errors">{{$errors->first('birthday')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $user->address }}">
                                <p class="errors">{{$errors->first('address')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">New Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                                <p class="errors">{{$errors->first('password')}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm New Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
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
    @endif
@endsection
@section('script')
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
            $('#avatar_setting').hide();
            $('#target').click(function(){
                $('#avatar_setting').click();
            });
            $("#avatar_setting").change(function(){
                readURL(this);
            });
        });
    </script>
@endsection
