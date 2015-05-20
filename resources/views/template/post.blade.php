@if (count($posts))
	@foreach ($posts as $post)
		<div class="panel panel-default">
			<div class="heading">
				<div class="row">
					<div class="col-sm-1">
						<img src="{{$post->image}}" class="avatar-post">
					</div>
					@if(Request::is('user/profile'))
						<div class="col-md-10">
					@else
						<div class="col-md-11">
					@endif
						<span class="poster-name-title emotion"><b>{{ $post->title }}</b></span><br>
						<div class="poster-name-time">
							<a href="{{ url('/user/view')}}/{{$post->user_id}}">{{ $post->username }}</a> |
							<span> {{$post->time}}</span>
						</div>
					</div>
					@if(Request::is('user/profile'))
						<div class="col-md-1 dropdown">
							<span href="#" class="dropdown-toggle pull-right" data-toggle="dropdown" role="button" aria-expanded="false">▼</span>
							<ul class="dropdown-menu edit-post" role="menu">
								<li><a href="{{ url('/post/edit') }}/{{$post->id}}">Edit</a></li>
								<li><a href="#" id="delete_{{$post->id}}">Delete</a></li>
							</ul>
						</div>
					@endif
				</div>
			</div>
			<div class="panel-body">
				<div>
					<span class="emotion">{{ $post->content }}</span>
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
								<li class="li-cmt-show emotion"><a href="#"><img src="{{$image_user_cmt}}" class="avatar-cmt"> {{$comment->username}}</a> {{$comment->content}}</li>
							@endforeach						
						@endif
						<li class="li-cmt" id="content_cmt_{{$post->id}}">
							<img src="{{Session::get('url_image_auth')}}" class="avatar-cmt">
							<input type="text" class="text_comment" id="text_comment_{{$post->id}}">	
							<span id="boxecon_{{$post->id}}" class="box_econ"><img src="/public/images/smiles.png"></span>
							<button class="btn-primary" id="sendcomment_{{$post->id}}">Comment</button>
							<div class="tips-some-emotion emotion" id="tips_some_emotion_{{$post->id}}">
								<span onclick = "emotion({{$post->id}}, 0)">:3</span>
								<span onclick = "emotion({{$post->id}}, 1)">:v</span>
								<span onclick = "emotion({{$post->id}}, 2)">(y)</span>
								<span onclick = "emotion({{$post->id}}, 3)">:D</span>
								<span onclick = "emotion({{$post->id}}, 4)">:)</span>
								<span onclick = "emotion({{$post->id}}, 5)">:))</span>
								<span onclick = "emotion({{$post->id}}, 6)">:(</span>
								<span onclick = "emotion({{$post->id}}, 7)">:))</span>
								<span onclick = "emotion({{$post->id}}, 8)">:x</span>
								<span onclick = "emotion({{$post->id}}, 9)">=((</span>
								<span onclick = "emotion({{$post->id}}, 10)">B-)</span>
								<span onclick = "emotion({{$post->id}}, 11)">:O)</span>
								<span onclick = "emotion({{$post->id}}, 12)">=P~</span>
								<span onclick = "emotion({{$post->id}}, 13)">@-)</span>
								<span onclick = "emotion({{$post->id}}, 14)">:^o</span>
								<span onclick = "emotion({{$post->id}}, 15)">X(</span>
								<span onclick = "emotion({{$post->id}}, 16)">:-h</span>
								<span onclick = "emotion({{$post->id}}, 17)">:|</span>
								<span onclick = "emotion({{$post->id}}, 18)">(:|</span>
								<span onclick = "emotion({{$post->id}}, 19)">=;</span>
								<span onclick = "emotion({{$post->id}}, 20)">:-?</span>
								<span onclick = "emotion({{$post->id}}, 21)">=))</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>					
	@endforeach			    
@else
    There are no posts
@endif