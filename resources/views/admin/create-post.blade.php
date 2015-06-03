@extends('admin.template')
@section('content')
     <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Create Post</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
                <div class="panel-body">
                    @if (Session::has('create_status'))
                        <?php $create_status = Session::get('create_status')?>
                        <div class="alert alert-{{$create_status['status']}}">
                            <p>{{ $create_status['message'] }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('admin/post/create/') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Title (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                <p class="errors">{{$errors->first('title')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Content (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="5" name="content">{{ old('content') }}</textarea>
                                <p class="errors">{{$errors->first('content')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">You can add image </label>
                            <div class="col-md-6">
                                <img src="" class="image-post" id="show_image_post">
                                <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" id="image_post"/>
                                <span class="pull-right">Remove image <input type="checkbox" name="remove_image" id="remove_image"/></span>
                                <p class="errors">{{$errors->first('image')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="sel1">Select category (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <select class="form-control" id="sel1" name="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="form-control btn btn-primary">
                                    Create a new post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#show_image_post').attr('src', e.target.result);
                    $('#show_image_post').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function(){
            $('#show_image_post').hide();
            $("#image_post").change(function(){
                readURL(this);
            });
             $("#remove_image").click(function(){
                if ($(this).is(":checked"))
                    $('#show_image_post').hide();
                else
                    $('#show_image_post').show();
            });
        });
    </script>
    <style type="text/css">
        #show_image_post{
            width: 400px;
            height: 300px;
            margin-bottom: 5px;
        }
    </style>
@endsection
