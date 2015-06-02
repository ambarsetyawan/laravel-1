<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Function construct
	 *
	 * @return Response
	 */
	public function __construct(){
		$this->middleware('admin');
	}
	/**
	 * Admin create user
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return Response
	 *
	 */
	public function getCreate()
	{
		return view('admin/create-user');
	}
	/**
	 * Admin create user
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return Response
	 *
	 */
	public function postCreate()
	{
		//
	}

	/**
	 * Admin edit user
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return Response
	 *
	 */
	public function getEdit($id)
	{
		echo "edit user";
	}

	/**
	 * Admin edit user
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return Response
	 *
	 */
	public function postEdit()
	{
		//
	}
	/**
	 * Admin edit user
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return Response
	 *
	 */
	public function getDelete($id)
	{
		//
	}
}
