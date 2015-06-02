<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input;
use App\User;
use Redirect;
use App\Library\LibraryPublic;
use Session;
use Hash;
use File;
use Validator;
use DB;
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
		$data = Input::all();
		$validator = User::validate($data, 'register');
		if($validator->fails()) {
			return Redirect::to('admin/user/create')->withInput()->withErrors($validator);
		}
		else {
			$data['image'] = 'default.jpg';
			$role_name = env('USER');
			$user = User::create_user($data, $role_name);
			LibraryPublic::send_mail_res($data);
			if (count($user)) {
				return redirect('admin/user/create')->withInput()->with('create_status',
						[
								'status' => 'success',
								'message' => 'Create user is success!']);
			} else
				return redirect('admin/user/create')->withInput()->with('create_status',
						[
								'status' => 'danger',
								'message' => 'Create user failed, Please try again!']);
		}
	}

	/**
	 * Admin edit user
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return Response
	 */
	public function getEdit($id = null)
	{
		$id = trim($id);
		$user = User::find($id);
		$data = [];
		if(!$user){
			Session::flash('not_found_user', 'User is not found!');
		}
		else{
			$user->image = LibraryPublic::get_url_image($user->image);
			Session::put('url_image_edit_user', $user->image);
			$data['user'] = $user;
		}
		return view('admin/edit-user', $data);
	}

	/**
	 * Admin edit user
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @param  int $id
	 * @return Response
	 */
	public function postEdit($id = null)
	{
		$id = trim($id);
		$user = User::find($id);
		if($user){
			$data = Input::all();
			$data['id'] = $id;
			$validator = User::validate($data, 'admin-edit');
			if($validator->fails()){
				return Redirect::to('admin/user/edit/' . $id)->withInput()->withErrors($validator);
			}
			else {
				$user->name = $data['name'];
				$user->email = $data['email'];
				$user->birthday = $data['birthday'];
				$user->address = $data['address'];
				if(Input::file('image')){
					$destination_path = './public/images/avatar/'; // upload path
				    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
				    $file_name = str_random(8).'.'.$extension; // renameing image
				    if(Input::file('image')->move($destination_path, $file_name)){
				    	if ($user->image != "default.jpg" && File::exists($destination_path.$user->image))
						    File::delete($destination_path.$user->image);
				    	$user->image = $file_name;
				    }
				}
				if($data['password'] != ""){
					$user->password = Hash::make($data['password']);
				}
				$user->save();
				$url_image = LibraryPublic::get_url_image($user->image);
				Session::put('url_image_edit_user', $url_image);
			    return redirect('admin/user/edit/'. $id)->withInput()->with('edit_status',
						[
								'status' => 'success',
								'message' => 'Setting account is success!']);
			}
		}
		else
			return redirect('admin/user/edit');
	}
	/**
	 * Admin edit user
	 * @author  Tran Van Moi
	 * @since  2015/06/01
	 * @return Response
	 */
	public function deleteDelete()
	{
		$ids = Input::get('ids');
		if(is_array($ids) && $ids){
			DB::beginTransaction();
			$check_save = true;
			foreach ($ids as $id){
				$data['id'] = $id;
				$rules = ['id' => 'required|exists:users,id'];
				$validator = Validator::make($data, $rules);
				if($validator->fails()){
					DB::rollback();
					return 404;
				}
				else {
					$user = User::find($id);
					$user->delete_status = 1;
					$user->save();
				}
			}
			DB::commit();
			return 200;
		}
		return 404;
	}
}
