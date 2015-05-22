<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

	protected $table = 'likes';

	/**
	 * Check like of post by user_id
	 * @author  Tran Van Moi
	 * @since  2015/05/21
	 * @param  int $user_id
	 * @param  int $post_id
	 * @return  int
	 */
	public static function check_like($user_id, $post_id){
		$check_like = Like::whereUser_id($user_id)->wherePost_id($post_id)->first();
		if($check_like)
			return 1;
		else
			return 0;
	}

	/**
	 * Total like of post
	 * @author  Tran Van Moi
	 * @since  2015/05/21
	 * @param  int $post_id
	 * @return  int
	 */
	public static function total_like($post_id){
		return Like::wherePost_id($post_id)->count();		
	}

	/**
	 * User like post
	 * @author  Tran Van Moi
	 * @since  2015/05/21
	 * @param  int $user_id
	 * @param  int $post_id
	 * @return  int
	 */
	public static function like($user_id, $post_id){
		$like = new Like;
		$like->user_id = $user_id;
		$like->post_id = $post_id;
		$like->save();
		return $like;
	}

	/**
	 * User unlike post
	 * @author  Tran Van Moi
	 * @since  2015/05/21
	 * @param  int $user_id
	 * @param  int $post_id
	 * @return  int
	 */
	public static function unlike($user_id, $post_id){
		$like = Like::whereUser_id($user_id)->wherePost_id($post_id)->first();
		if($like->delete())
			return true;
		else return false;

	}
}
