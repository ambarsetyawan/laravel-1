<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use Session;
use Auth;
use URL;
use App\Library\LibraryPublic;
use Input;
use Validator;
class HomeController extends Controller {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Home Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | This controller renders your application's "dashboard" for users that
	 * | are authenticated. Of course, you are free to change or remove the
	 * | controller as you wish. It is just here to get your app started!
	 * |
	 */
	
	/**
	 * Create a new controller instance.
	 * 
	 * @return void
	 */
	public function __construct ()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 * 
	 * @return Response
	 */
	public function index ($category_id = 0)
	{
		$keyword = trim(Input::get('keyword'));
		$data['keyword'] = $keyword;
		if (Auth::check() && Auth::user()->hasRole('user')) {
			$category_id = trim($category_id);
			$url_image = LibraryPublic::get_url_image(Auth::user()->image);
			Session::put('url_image_auth', $url_image);
			$rules = ['keyword' => 'max:150|min:1'];
			$validator = Validator::make($data, $rules);
			if ($validator->fails()){
				$data['keyword'] = "";
				$posts = Post::get_all_posts($category_id);
			}
			else
				$posts = Post::get_all_posts($category_id, $keyword);
			$data['posts'] = $posts;
			$data['categories'] = Category::all();
		}
		if (Auth::check() && Auth::user()->hasRole('admin')) {
			return redirect('admin');
		}
		return view('home', $data);
	}
}
