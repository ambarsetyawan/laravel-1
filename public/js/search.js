$(document).ready(function(){
	// search function
	$('#search').click(function(){
		keyword = $("#text_search").val();
		window.location.href = current_url + "?keyword=" + keyword;
	})
});
function search(){
	keyword = $("#text_search").val();
	window.location.href = current_url + "?keyword=" + keyword;
}