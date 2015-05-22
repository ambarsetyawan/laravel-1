<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Redirect;
use Validator;
use Auth;
use Session;

class CommentController extends Controller {

	/**
	 * Create a new controller instance.
	 * 
	 * @return void
	 */
	public function __construct ()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 * 
	 * @return Response
	 */
	public function getIndex ()
	{
		$data = [
				'content' => "this is test comment",
				'post_id' => 3];
		$validator = Comment::validate($data);
		if ($validator->fails()) {
			echo "ok";
		} else
			echo "not ok";
	}

	/**
	 * Show the form for creating a new resource.
	 * 
	 * @return Response
	 */
	public function postCreate ()
	{
		$data = Input::all();
		$validator = Comment::validate($data);
		if ($validator->fails()) {
			return 404;
		} else {
			$content = Input::get('content');
			$post_id = Input::get('post_id');
			$cmt = Comment::create_cmt($content, $post_id);
			if (count($cmt)) {
				return 200;
			} else
				return 404;
		}
	}

	/**
	 * delete comment
	 * @author  Tran Van Moi
	 * @since  2015/05/20    	
	 * @return int
	 */
	public function deleteDelete ()
	{
		$data = Input::all();
		$rules = [
				'cmt_id' => 'required|exists:comments,id'];
		$validator = Validator::make($data, $rules);
		if ($validator->fails())
			return 404;
		else {
			$check_role_cmt = Comment::whereId($data['cmt_id'])
			                        ->whereDelete_status(0)
			                        ->first();
        	$check_role_post = Post::whereUser_id(Auth::user()->id)
        							->whereId($check_role_cmt->post_id)
        							->first();
			if ($check_role_cmt->user_id == Auth::user()->id || $check_role_post) {
				$check_role_cmt->delete_status = 1;
				$check_role_cmt->save();
				return 200;
			} else
				return 404;
		}
	}
}
