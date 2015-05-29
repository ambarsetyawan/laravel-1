<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Like;
use Validator;
use Input;
use Auth;
class LikeController extends Controller {

	/**
	 * Create a new controller instance.
	 * 
	 * @return void
	 */
	public function __construct ()
	{
		$this->middleware('auth');
	}

	public function postLikepost(){
		$data = Input::all();
		$rules = ["post_id" => 'required|exists:posts,id'];
		$validator = Validator::make($data, $rules);
		if($validator->fails())
			return 404;
		else{
			$check_like = Like::check_like(Auth::user()->id, $data['post_id']);
			if($check_like){
				$unlike = Like::unlike(Auth::user()->id, $data['post_id']);
				if($unlike){
					$total_like = Like::total_like($data['post_id']);
					$total_like_text = $total_like ? $total_like . " people like this" : "";
					return json_encode(["like" => "Like", "total_like" => $total_like_text]);
				}
				else 
					return 404;
			}
			else{
				$like = Like::like(Auth::user()->id, $data['post_id']);
				if($like){
					$total_like = Like::total_like($data['post_id']);
					$total_like_text = $total_like ? $total_like . " people like this" : "";
					return json_encode(["like" => "Unlike", "total_like" => $total_like_text]);
				}
				else 
					return 404;
			}
		}
	}
}
