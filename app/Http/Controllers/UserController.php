<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Redirect;
use Socialize;
use App\User;
use App\Role;
use Hash;
use Input;
use Mail;
use URL;
use App\Post;
use App\Category;

class UserController extends Controller {

	/**
	 * Create a new controller instance.
	 * 
	 * @return void
	 */
	public function __construct ()
	{
		$this->middleware('auth', [
				'only' => 'getProfile']);
		$this->middleware('admin', [
				'only' => [
						'getCreate',
						'postCreate']]);
	}

	/**
	 * get Login function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/12
	 * @return Response
	 */
	public function getLogin ()
	{
		/*
		 * Delete all session
		 * Session::flush();
		 */
		if (Auth::check())
			return redirect('/');
		return view('user/login');
	}

	/**
	 * post Login function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/15
	 * @return Response
	 */
	public function postLogin ()
	{
		$data = Input::all();
		$validator = User::validate($data);
		if ($validator->fails()) {
			// If validation failed redirect back to login.
			return Redirect::to('user/login')->withInput()->withErrors($validator);
		} else {
			$userdata = array(
					'email' => Input::get('email'),
					'password' => Input::get('password'));
			/*
			 * login by email or name
			 * $field = filter_var($usernameinput, FILTER_VALIDATE_EMAIL) ?
			 * 'email' : 'name';
			 * if (Auth::attempt(array($field => $usernameinput, 'password' =>
			 * $password))){
			 */
			if (Auth::attempt($userdata)) {
				return redirect('/');
			} else {
				// Session::flash('error', 'Username or password is not
				// correct');
				return redirect('user/login')->withInput()->with('error', 'Username or password is not correct');
			}
		}
	}

	/**
	 * Facebook redirect function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/13
	 * @return redirect to login
	 */
	public function getFacebookredirect ()
	{
		return Socialize::with('facebook')->redirect();
	}

	/**
	 * Google redirect function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/13
	 * @return redirect to login
	 */
	public function getGoogleredirect ()
	{
		return Socialize::with('google')->redirect();
	}

	/**
	 * Login with facebook function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/12
	 * @return Response
	 */
	public function getLoginfb ()
	{
		try {
			$user_fb = Socialize::with('facebook')->user();
			$user = User::whereEmail($user_fb['email'])->first();
			// Create account, login and send new account to user
			if (! $user) {
				$user_fb['image'] = $user_fb->avatar;
				$user = User::create_user($user_fb, env('USER'));
			}
			// Create session
			Auth::login($user);
			$user->image = $user_fb->avatar;
			$user->save();
			return redirect('/');
		} catch (Exception $e) {
			return redirect('user/login')->withInput()->with('error', 'Login with facebook failed! Please try again!');
		}
	}

	/**
	 * Login with google function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/12
	 * @return Response
	 */
	public function getLogingg ()
	{
		try {
			$user_gg = Socialize::with('google')->user();
			$user = User::whereEmail($user_gg->email)->first();
			// Create account, login and send new account to user
			if (! $user) {
				$user_data = [
						'id' => $user_gg->id,
						'name' => $user_gg->name,
						'email' => $user_gg->email,
						'image' => $user_gg->avatar];
				$user = User::create_user($user_data, env('USER'));
			}
			// Create session
			Auth::login($user);
			$user->image = $user_gg->avatar;
			$user->save();
			return redirect('/');
		} catch (Exception $e) {
			return redirect('user/login')->withInput()->with('error', 'Login with google failed! Please try again!');
		}
	}

	/**
	 * Register function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/12
	 * @return Response
	 */
	public function getRegister ()
	{
		return view('user/register');
	}

	/**
	 * post Register function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/12
	 * @return Response
	 */
	public function postRegister ()
	{
		$data = Input::all();
		$validator = User::validate($data, env('FACTORY_REGISTER'));
		if ($validator->fails()) {
			// If validation failed redirect back to login.
			return redirect('user/register')->withInput()->withErrors($validator);
		} else {
			$userdata = array(
					'name' => Input::get('name'),
					'email' => Input::get('email'),
					'password' => Input::get('password'),
					'image' => 'default.jpg');
			$role_name = Input::get('is_owner') === 'on' ? env('OWNER') : env('USER');
			$user = User::create_user($userdata, $role_name);
			if (count($user)) {
				return redirect('user/register')->withInput()->with('register_status', 
						[
								'status' => 'success',
								'message' => 'Register user is success, You can login now!']);
			} else
				return redirect('user/register')->withInput()->with('register_status', 
						[
								'status' => 'danger',
								'message' => 'Register user is failed, Please try again!']);
		}
	}

	/**
	 * Logout function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/12
	 * @return Response
	 */
	public function getLogout ()
	{
		Auth::logout();
		return redirect('home');
	}

	/**
	 * Profile function
	 * 
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/05/12
	 * @return Response
	 */
	public function getProfile ($category_id = 0)
	{
		$category_id = trim($category_id);
		$url_image = "";
		if (filter_var(Auth::user()->image, FILTER_VALIDATE_URL) === false)
			$url_image = URL::to('/') . "/public/images/avatar/" . Auth::user()->image;
		else
			$url_image = Auth::user()->image;
		Session::put('url_image_auth', $url_image);
		$posts = Post::get_all_posts($category_id, true);
		$data['posts'] = $posts;
		$data['categories'] = Category::all();
		return view('user/profile', $data);
	}

	public function getForgot ()
	{
		$hashKey = env('APP_KEY');
		if (\Request::isMethod('post')) {
			$data['token'] = hash_hmac('sha256', str_random(40), $hashKey);
			Mail::send('emails.password', $data, 
					function  ($message)
					{
						$message->to('moitran92@gmail.com', 'John Smith')->subject('Welcome!');
					});
		}
		return view('user/forgot');
	}

	public function getCreate ()
	{
		echo "create user";
	}

	public function postCreate ()
	{
		echo "ok";
	}
}
