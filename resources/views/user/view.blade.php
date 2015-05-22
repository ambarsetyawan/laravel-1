@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		@if(Session::has('view_user_error'))
			<div class="col-md-10 col-md-offset-1">
				<div class="alert alert-danger">
					<p>{{ Session::get('view_user_error') }}</p>
				</div>
			</div>
		@else
			<div class="col-md-2">
				<img src="{{$user_info->image}}" class="avatar-user-profile">
				<ul class="user-info">
					<li>- Name: {{$user_info->name}}</li>
					<li>- Birthday: {{$user_info->birthday}}</li>
					<li>- Address: {{$user_info->address}}</li>
					<li>- Total post: {{count($posts)}}</li>
				</ul>
			</div>
			<div class="col-md-8">
				@include('template.post')
			</div>
			<div class="list-group col-md-2">
			  	<a href="#" class="list-group-item active">
			    	Catagory
			  	</a>
			  	@foreach($categories as $category)
			  		<a href="{{url('/user/view/')}}/{{$user_id}}/{{$category->id}}" class="list-group-item">{{$category->name}}</a>
			  	@endforeach
			</div>
		@endif
	</div>
</div>
@endsection
<script src="{{asset('/public/js/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
	url_image_auth = "{{Session::get('url_image_auth')}}";
	username = "{{Auth::user()->name}}";
</script>
<script src="{{asset('/public/js/home.js')}}"></script>