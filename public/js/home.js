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
	}
}
$( document ).ready(function() {
	var opt = {
		handle: '#etoggle',
		dir: "/public/images/emotions/",
		label_on: 'On Emotions',
		label_off: 'Off Emotions',
		style: 'background: #eee',
		css: 'class2'
	}
	$('.emotion').emotions(opt);
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
    $("[id^=boxecon_]").click (function(){
        var id = $(this).prop('id');
        id = id.substr(id.indexOf("_") + 1);
        if($("#tips_some_emotion_" + id).is(':hidden')){
        	$("#tips_some_emotion_" + id).show();
        }
        else
        	$("#tips_some_emotion_" + id).hide();
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