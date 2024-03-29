@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Post</div>
                <div class="panel-body">
                    @if (Session::has('post_status'))
                        <?php $post_status = Session::get('post_status')?>
                        <div class="alert alert-{{$post_status['status']}}">
                            <p>{{ $post_status['message'] }}</p>
                        </div>
                    @endif
                    @if(isset($post))
                        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/post/edit/') }}/{{$post->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Title (<span class="require"> * </span>)</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title" value="{{$post->title}}">
                                    <p class="errors">{{$errors->first('title')}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Content (<span class="require"> * </span>)</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" rows="5" name="content">{{$post->content}}</textarea>
                                    <p class="errors">{{$errors->first('content')}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Image </label>
                                <div class="col-md-6">
                                    <img src="{{$post->image}}" class="" id="show_image_post">
                                    <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" id="image_post"/>
                                    <p class="errors">{{$errors->first('image')}}</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="sel1">Select category (<span class="require"> * </span>)</label>
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
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
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
    });
</script>
<style type="text/css">
    #show_image_post{
        width: 400px;
        height: 200px;
        margin-bottom: 5px;
    }
</style>