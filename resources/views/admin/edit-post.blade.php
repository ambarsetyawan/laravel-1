@extends('admin.template')
@section('content')
     <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Edit Post</h2>
        </div>
    </div>
    @if (Session::has('not_found_post'))
        <div class="alert alert-danger">
            <p>{{ Session::get('not_found_post') }}</p>
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
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('admin/post/edit/') }}/{{$post->id}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Title (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{$post->title}}">
                                <p class="errors">{{$errors->first('title')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Content (<span class="require"> * </span>)</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="5" name="content">{{$post->content}}</textarea>
                                <p class="errors">{{$errors->first('content')}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Image </label>
                            <div class="col-md-6">
                                <img src="{{$post->image}}" class="" id="show_image_post">
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
                                        @if($category->id == $post->category_id)
                                            <option value="{{$category->id}}" selected="true">{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="form-control btn btn-primary">
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
                    $('#show_image_post').attr('src', e.target.result);
                    $('#show_image_post').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function(){
            check_show_image = "{{$post->image}}";
            if(check_show_image != ""){
                $('#show_image_post').show();
            }
            else
                 $('#show_image_post').hide();
            $("#image_post").change(function(){
                readURL(this);
            });
            $("#remove_image").click(function(){
                if ($(this).is(":checked"))
                    $('#show_image_post').hide();
                else
                    $('#show_image_post').show();
            })
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
