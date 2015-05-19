<?php namespace App\Http\Controllers;
use App\Post;
use App\Category;
use Session;
use Auth;
use URL;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index($category_id = 0)
	{
		// for ($i=1360; $i <= 9999; $i++) { 
		// 	$max = 11359 - $i;
		// 	$str_max = (string)$max;
		// 	$str_min = (string)$i;
		// 	$arr_max = array($str_max['0'], $str_max['1'], $str_max['2'], $str_max['3']);
		// 	$arr_min = array($str_min['0'], $str_min['1'], $str_min['2'], $str_min['3']);
		// 	$arr_merge = array_merge($arr_max, $arr_min);
		// 	$arr_uni = array_unique($arr_merge);
		// 	$arr_uni_max = array_unique($arr_max);
		// 	$arr_uni_min = array_unique($arr_min);
		// 	if(count($arr_uni) == 4 && count($arr_uni_max) == 4 && count($arr_uni_min) == 4){
		// 		$check = $max > $i ? $i : $max;
		// 		if($check<$min)
		// 			$min = $check;
		// 	}
		// }
		// echo $min;
		// }
		$data = [];
		if(Auth::check()){
			$category_id = trim($category_id);
			$url_image = "";
			if(filter_var(Auth::user()->image, FILTER_VALIDATE_URL) === false)
				$url_image = URL::to('/') . "/public/images/avatar/" . Auth::user()->image;
			else
				$url_image = Auth::user()->image;
			Session::put('url_image_auth', $url_image);
			$posts = Post::get_all_posts($category_id);
	        $data['posts'] = $posts;
	        $data['categories'] = Category::all();
	    }
		return view('home', $data);
	}
}
