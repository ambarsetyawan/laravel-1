@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<div class="list-group col-md-2">
		  	<a href="#" class="list-group-item active">
		    	Catagory
		  	</a>
		  	@foreach($categories as $category)
		  		<a href="{{url('/user/profile/')}}/{{$category->id}}" class="list-group-item">{{$category->name}}</a>
		  	@endforeach
		</div>
		<div class="col-md-10">
			@if (count($posts))
				@foreach ($posts as $post)
					<div class="panel panel-default" id="content_post_{{$post->id}}">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-1">
									<img src="{{$post->image}}" class="avatar-post">
								</div>
								<div class="col-md-10">
									<span class="poster-name-title"><b>{{ $post->title }}</b></span><br>
									<div class="poster-name-time">
										<a href="{{ url('/user/view')}}/{{$post->user_id}}">{{ $post->username }}</a> |
										<span> {{$post->time}}</span>
									</div>
								</div>
								<!-- <div class="col-md-1">
									<span class="pull-right">▼</span>
								</div> -->
								<div class="col-md-1 dropdown">
									<span href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" role="button" aria-expanded="false">▼</span>
									<ul class="dropdown-menu edit-post" role="menu">
										<li><a href="{{ url('/post/edit') }}/{{$post->id}}">Edit</a></li>
										<li><a href="#" id="delete_{{$post->id}}">Delete</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div>
								{{ $post->content }}
								<div>
									<span id="like_{{$post->id}}" class="social_activity">Like</span> . 
									<span id="share_{{$post->id}}" class="social_activity">Share</span> .
									<span id="comment_{{$post->id}}" class="social_activity">Comment</span>
								</div>
							</div>
							<div class="content-cmt">
								<ul id="div_all_cmt_{{$post->id}}">
									@if(count($post->comment))					
										@foreach ($post->comment as $comment)
											<?php					
												if(filter_var($comment->image, FILTER_VALIDATE_URL) === false)
													$image_user_cmt = URL::to('/') . "/public/images/avatar/" . $comment->image;
												else
													$image_user_cmt = $comment->image;
											?>
											<li class="li-cmt-show"><a href="#"><img src="{{$image_user_cmt}}" class="avatar-cmt"> {{$comment->username}}</a> {{$comment->content}}</li>
										@endforeach						
									@endif
									<li class="li-cmt" id="content_cmt_{{$post->id}}">
										<img src="{{Session::get('url_image_auth')}}" class="avatar-cmt">
										<input type="text" class="text_comment" id="text_comment_{{$post->id}}">	
										<button class="btn-primary" id="sendcomment_{{$post->id}}">Comment</button>
									</li>
								</ul>
							</div>
						</div>
					</div>					
				@endforeach			    
			@else
			    There are no posts
			@endif
		</div>
	</div>
</div>
@endsection
<script src="{{asset('/public/js/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
	$( document ).ready(function() {
	    $("[id^=comment_]").click (function(){
            var id = $(this).prop('id');
            id = id.substr(id.indexOf("_") + 1);
            if($("#content_cmt_" + id).is(':hidden')){
            	$("#content_cmt_" + id).show();
            	$("#text_comment_" + id).focus();
            }
            else
            	$("#content_cmt_" + id).hide();
        });
        $("[id^=text_comment_]").keydown(function(event){    
		    if(event.keyCode==13){
		        $("[id^=sendcomment_]").click ();
		    }
		});
        $("[id^=sendcomment_]").click (function(){
        	var id = $(this).prop('id');
            id = id.substr(id.indexOf("_") + 1);
            content =  $("#text_comment_" + id).val();
            if(content != ""){
				var dataString = 'content='+content+'&post_id='+id;
				$.ajax({
					 headers: {
				        'X-XSRF-TOKEN': $('input[name="_token"]').val()
				    },	
					type: "POST",
					url : "{{url('/comment/create')}}",
				 	data : {content: content, post_id: id, _token: $('input[name="_token"]').val()},
				 	dataType : "JSON",
				 	success : function(data){
				 		if(data == 200){
				 			$("#div_all_cmt_" + id).find(' > li:nth-last-child(1)').before('<li class="li-cmt-show"><a href="#"><img src="{{Session::get("url_image_auth")}}" class="avatar-cmt"> {{Auth::user()->name}}</a> ' + $("#text_comment_" + id).val() + '</li>');
				 			$("#text_comment_" + id).val("");
				 		}
				 		else {
				 			alert("Error! Please try again!");
				 		}
					},
					error: function(data) {
				    	alert("Error! Please try again!");
				   	},			 
				});
	        }
        });
		$("[id^=delete_]").click (function(){
			var delete_post = confirm("Do you want to delete this post?");
			if (delete_post == true) {
				var id = $(this).prop('id');
            	id = id.substr(id.indexOf("_") + 1);
            	$.ajax({
					 headers: {
				        'X-XSRF-TOKEN': $('input[name="_token"]').val()
				    },	
					type: "DELETE",
					url : "{{url('/post/delete')}}",
				 	data : {post_id: id, _token: $('input[name="_token"]').val()},
				 	dataType : "JSON",
				 	success : function(data){
				 		console.log(data);
				 		if(data == 200){
				 			$("#content_post_"+id).hide();
				 		}
				 		else {
				 			alert("Error! Please try again!");
				 		}
					},
					error: function(data) {
				    	alert("Error! Please try again!");
				   	},			 
				});
			}
		});
	});
</script>