<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use URL;
use DB;
use Validator;
use Auth;
use File;
use Input;
class Post extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';

	/**
	 * Function validate data for post
	 * @author  Tran Van Moi <[moitran92@gmail.com]>
	 * @since  2015/05/19
	 * @param  array $data
	 * @return object
	 */
	public static function validate($data){
		$rules = array(
			'title' => 'required|min:10',
			'content' => 'required|min:10',
			'category' => 'exists:categories,id',
			'image' => 'image|mimes:jpeg,jpg,png|max:2000'
	    );
	    return Validator::make($data, $rules);
	}

	/**
	 * Get all data of post
	 * @author Tran Van Moi
	 * @since  2015/05/12
	 * @return array
	 */
	public static function get_all_posts($category_id, $keyword = "", $user_id = false){
		$posts = DB::table('posts');
        $posts->join('users', 'posts.user_id', '=', 'users.id');
        $posts->select(
        		'posts.id', 
        		'posts.title', 
        		'posts.content', 
        		'posts.image as image_post', 
        		'posts.created_at', 
        		'posts.updated_at', 
        		'users.image', 
        		'users.name as username', 
        		'users.id as user_id');
        $posts->orderBy('created_at', 'desc');
        $posts->orderBy('updated_at', 'desc');
        if(is_numeric($category_id) && Category::find($category_id))
        	$posts->where('posts.category_id', '=', $category_id);
        if($user_id)
        	$posts->where('posts.user_id', '=', $user_id);
        $posts->where('posts.delete_status' , '=', 0);
        if($keyword != ""){
        	$posts->where( function ( $posts ) use ($keyword)
		    {
		        $posts->where('posts.title' , 'like', '%'.$keyword.'%')
	        	->orWhere('posts.content' , 'like', '%'.$keyword.'%')
	        	->orWhere('users.name' , 'like', '%'.$keyword.'%');
		    });        	
        }
        $posts = $posts->get();
        foreach ($posts as $key => $value) {
        	$path = "./public/images/post/";
        	if(File::exists($path.$value->image_post) && $value->image_post != "")
        		$posts[$key]->image_post = URL::to('/') . "/public/images/post/" . $value->image_post;
        	else
        		$posts[$key]->image_post = "";
        	$now = gmdate ( "Y-m-d G:i:s", time () + 7 * 3600);
			$date1 = new DateTime($now);
			$date = $value->updated_at > $value->created_at ? $value->updated_at : $value->created_at;
			$date2 = new DateTime($date);
			$interval = $date1->diff($date2);
			if($interval->d)
				$posts[$key]->time = date("F j, Y, g:i a", strtotime($date));
			else if($interval->h)
				$posts[$key]->time = $interval->h . " hrs";
			elseif($interval->i)
				$posts[$key]->time = $interval->i . " mins";
			else
				$posts[$key]->time = "Just now";
        	unset($posts[$key]->created_at);
        	unset($posts[$key]->updated_at);
        	$url_image = "";
			if(filter_var($value->image, FILTER_VALIDATE_URL) === false)
				$posts[$key]->image = URL::to('/') . "/public/images/avatar/" . $value->image;
			$posts[$key]->like = Like::check_like(Auth::user()->id, $value->id);
			$posts[$key]->total_like = Like::total_like($value->id);
        	$posts[$key]->comment = \DB::table('comments')
        						->join('users', 'comments.user_id', '=', 'users.id')
					            ->select(
				            		'comments.id', 
				            		'comments.content', 
				            		'comments.created_at', 
				            		'comments.updated_at',
				            		'users.name as username',
				            		'users.id as user_id',
				            		'users.image')
					            ->where('comments.post_id', '=', $value->id)
					            ->where('comments.delete_status', '=', 0)
					            ->orderBy('comments.created_at', 'asc')
					            ->orderBy('comments.updated_at', 'asc')
					            ->get();
        }
        return $posts;
	}



	/**
	 * Function create post
	 * @author  Tran Van Moi <[moitran92@gmail.com]>
	 * @since  2015/05/19
	 * @param  array $data
	 * @return object
	 */
	public static function create_post($data){
		$post = new Post;
		$post->user_id = Auth::user()->id;
        $post->category_id = $data['category'];
        $post->title = $data['title'];
        $post->content = $data['content'];
        if(Input::file('image')){
			$destination_path = './public/images/post/'; // upload path
		    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
		    $file_name = str_random(8).'.'.$extension; // renameing image
		    if(Input::file('image')->move($destination_path, $file_name)){
		    	$post->image = $file_name;
		    }
		}
        $post->save();
        return $post;
	}
}
