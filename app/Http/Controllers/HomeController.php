<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use Session;
use Auth;
use URL;

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
		$data = [];
		if (Auth::check()) {
			$category_id = trim($category_id);
			$url_image = "";
			if (filter_var(Auth::user()->image, FILTER_VALIDATE_URL) === false)
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
