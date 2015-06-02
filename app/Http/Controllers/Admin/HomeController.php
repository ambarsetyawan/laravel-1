<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller {
	/**
	 * Function construct
	 *
	 * @return Response
	 */
	public function __construct(){
		$this->middleware('admin');
	}

	/**
	 * Function home admin
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return response
	 */
	public function getIndex()
	{
		return view('admin/home');
	}
	/**
	 * Function manager users
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return response
	 */
	public function getUsers()
	{
		$data['users'] = User::whereDelete_status(0)->where('id', '<>', Auth::user()->id)->get();
		return view('admin/user', $data);
	}

	/**
	 * Function manager posts
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return response
	 */
	public function getPosts()
	{
		return view('admin/post');
	}

	/**
	 * Function manager categories
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return response
	 */
	public function getCategories()
	{
		return view('admin/category');
	}
	/**
	 * admin logout
	 *
	 * @author Tran Van Moi <[moitran92@gmail.com]>
	 * @since 2015/06/01
	 * @return Response
	 */
	public function getLogout ()
	{
		Auth::logout();
		return redirect('/');
	}
}
