@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="col-md-2">
            <img src="{{Session::get('url_image_auth')}}" class="avatar-user-profile">
            <ul class="user-info">
                <li>- Name: {{Auth::user()->name}}</li>
                <li>- Birthday: {{Auth::user()->birthday}}</li>
                <li>- Address: {{Auth::user()->address}}</li>
                <li>- Total posts: {{count($posts)}}</li>
                <li>- Total likes: {{$total_like}}</li>
            </ul>
        </div>
        <div class="col-md-8">
            @include('template.post')
        </div>
        <div class="list-group col-md-2">
            <a href="#" class="list-group-item active">
                Category
            </a>
            @foreach($categories as $category)
                <a href="{{url('/user/profile/')}}/{{$category->id}}" class="list-group-item">{{$category->name}}</a>
            @endforeach
        </div>
    </div>
</div>
@endsection
<script src="{{asset('/public/js/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
    url_image_auth = "{{Session::get('url_image_auth')}}";
    username = "{{Auth::user()->name}}";
</script>
<script src="{{asset('/public/js/home.js')}}"></script>