<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Validator;
class Comment extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * Function validate data for comment
	 * @author  Tran Van Moi <[moitran92@gmail.com]>
	 * @since  2015/05/18
	 * @param  array $data
	 * @return object
	 */
	public static function validate($data){
		$rules = array(
			'content' => 'required|min:1',
			'post_id' => 'required|exists:posts,id',
	    );
	    return Validator::make($data, $rules);
	}

	/**
	 * Function create comment
	 * @author  Tran Van Moi <[moitran92@gmail.com]>
	 * @since  2015/05/13
	 * @param  string $content
	 * @param  int $post_id
	 * @return object
	 */
	public static function create_cmt($content, $post_id){
		$cmt = new Comment;
		$cmt->user_id = Auth::user()->id;
        $cmt->post_id = $post_id;
        $cmt->content = $content;
        $cmt->save();
        return $cmt;
	}
}
