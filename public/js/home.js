function emotion(post_id, id_emotion){
	arr_emotion = [
		':3',
		':v',
		'(y)',
		':D',
		':)',
		':))',
		':(',
		':((',
		':x',
		'=((',
		'B-)',
		':O)',
		'=P~',
		'@-)',
		':^o',
		'X(',
		':-h',
		':|',
		'(:|',
		'=;',
		':-?',
		'=))'
	];
	if (arr_emotion[id_emotion] != undefined){
		get_text = arr_emotion[id_emotion];
		text = document.getElementById("text_comment_" + post_id).value;
		document.getElementById("text_comment_" + post_id).value = text + " " + get_text;
		$("#text_comment_" + post_id).focus();
	}
}
$( document ).ready(function() {
	// add emotion
	var opt = {
		handle: '#etoggle',
		dir: "/public/images/emotions/",
		label_on: 'On Emotions',
		label_off: 'Off Emotions',
		style: 'background: #eee',
		css: 'class2'
	}
	$('.emotion').emotions(opt);

	// show text to comment
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

    //show tips emotion
    $("[id^=boxecon_]").click (function(e){
        var id = $(this).prop('id');
        id = id.substr(id.indexOf("_") + 1);
        if($("#tips_some_emotion_" + id).is(':hidden')){
        	$("#tips_some_emotion_" + id).show();
        }
        else
        	$("#tips_some_emotion_" + id).hide();
        e.stopPropagation();
    });

    // press enter when comment
    $("[id^=text_comment_]").keydown(function(event){    
	    if(event.keyCode==13){
	        $("[id^=sendcomment_]").click ();
	    }
	});

	// send comment
    $("[id^=sendcomment_]").click (function(){
    	var id = $(this).prop('id');
        id = id.substr(id.indexOf("_") + 1);
        content =  $("#text_comment_" + id).val();
        text = content;
        if(content != ""){
			var dataString = 'content='+content+'&post_id='+id;
			$.ajax({
				 headers: {
			        'X-XSRF-TOKEN': $('input[name="_token"]').val()
			    },	
				type: "POST",
				url : "/comment/create",
			 	data : {content: content, post_id: id, _token: $('input[name="_token"]').val()},
			 	dataType : "JSON",
			 	success : function(data){
			 		if(data == 200){
			 			$("#div_all_cmt_" + id).find(' > li:nth-last-child(1)').before('<li class="li-cmt-show emotion"><a href="#"><img src="'+url_image_auth+'" class="avatar-cmt"> '+username+'</a> ' + $("#text_comment_" + id).val() + '</li>');
			 			$("#text_comment_" + id).val("");
			 			var opt = {
							handle: '',
							dir: "/public/images/emotions/",
							label_on: 'On Emotions',
							label_off: 'Off Emotions',
							style: 'background: #eee',
							css: 'class2'
						}
						$('.emotion').emotions(opt);
			 		}
			 		else {
			 			alert("Error! Please try again!");
			 		}
				},
				error: function(data) {
			    	alert("Error! Please try again,,,!");
			   	},			 
			});
        }
    });

	// delete post
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
				url : "/post/delete",
			 	data : {post_id: id, _token: $('input[name="_token"]').val()},
			 	dataType : "JSON",
			 	success : function(data){
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

	// hide comment when list comment more than 5 item
	$(".li-cmt-hide").hide();

	// show all comment when click show more
	$("[id^=showmore_]").click (function(){
		var id = $(this).prop('id');
    	id = id.substr(id.indexOf("_") + 1);
    	if($('.li-cmt-'+id).is(':hidden')){
    		$('.li-cmt-'+id).show();
    		$('#showmore_'+id).text("Show less comments");
    	}
    	else{
    		$('#showmore_'+id).text("Show more comments");
    		$('.li-cmt-display').show();
    		$('.li-cmt-'+id).hide();
    	}
	});

	// hide "x" delete comment
	$("[id^=deletecmt_]").hide();
	
	// show delete comment when hover comment
	$("[id^=cmt_]").hover(function(){
		var id = $(this).prop('id');
    	id = id.substr(id.indexOf("_") + 1);
    	$("#deletecmt_"+id).show();
	});

	// hide delete comment when mouse over comment
	$("[id^=cmt_]").mouseleave(function(){
		var id = $(this).prop('id');
    	id = id.substr(id.indexOf("_") + 1);
    	$("[id^=deletecmt_]").hide();
	});

	//show pointer when hover delete comment
	$("[id^=deletecmt_]").hover(function(){
		$(this).css('cursor','pointer');
	});

	// delete comment
	$("[id^=deletecmt_]").click(function(){
		var delete_cmt = confirm("Do you want to delete this comment?");
		if (delete_cmt == true) {
			var id = $(this).prop('id');
        	id = id.substr(id.indexOf("_") + 1);
        	$.ajax({
				 headers: {
			        'X-XSRF-TOKEN': $('input[name="_token"]').val()
			    },	
				type: "DELETE",
				url : "/comment/delete",
			 	data : {cmt_id: id, _token: $('input[name="_token"]').val()},
			 	dataType : "JSON",
			 	success : function(data){
			 		console.log(data);
			 		if(data == 200){
			 			$("#cmt_"+id).hide();
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

	// hide tips emtion when click in body
	$('body').click(function(evt){
		$('.tips-some-emotion').hide();
	});

	// like or unlike post
	$('[id^=like_]').click(function(){
		id = $(this).prop('id');
		id = id.substr(id.indexOf("_") + 1);
		$.ajax({
			headers: {
		        'X-XSRF-TOKEN': $('input[name="_token"]').val()
		    },	
			type: "POST",
			url : "/like/likepost",
		 	data : {post_id: id, _token: $('input[name="_token"]').val()},
		 	dataType : "JSON",
		 	success : function(data){
		 		console.log(data.total_like);
 				$("#like_"+id).text(data.like);
 				if(data.total_like == "")
 					$(".total_like_"+id).hide();
 				else
 					$(".total_like_"+id).show();
 				$(".total_like_"+id).text(data.total_like);
			},
			error: function(data) {
				console.log(data);
		    	alert("Error! Please try again!");
		   	},			 
		});
	});
});