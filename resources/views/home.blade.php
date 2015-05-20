@extends('app')
@section('content')
<div class="container">
	<div class="row">
		@if(Auth::check())
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<div class="list-group col-md-2">
			  	<a href="#" class="list-group-item active">
			    	Catagory
			  	</a>
			  	@foreach($categories as $category)
			  		<a href="{{url('/home/')}}/{{$category->id}}" class="list-group-item">{{$category->name}}</a>
			  	@endforeach
			</div>
			<div class="col-md-10">
				@include('template.post')
			</div>
		@else
			@include('template.home')
		@endif
	</div>
</div>
@endsection
<script src="{{asset('/public/js/jquery-2.1.4.min.js')}}"></script>
@if(Auth::check())
	<script type="text/javascript">
		url_image_auth = "{{Session::get('url_image_auth')}}";
		username = "{{Auth::user()->name}}";
	</script>
	<script src="{{asset('/public/js/home.js')}}"></script>
@endif
