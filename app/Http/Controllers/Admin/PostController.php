<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Post;
use File;
use App\Category;
use URL;
use Input;
use Session;
use Redirect;
class PostController extends Controller {

	/**
	 * Function construct
	 *
	 * @return Response
	 */
	public function __construct(){
		$this->middleware('admin');
	}
	/**
	 * admin edit post
	 * @author  Tran Van Moi <[tran.moi@mulodo.com]>
	 * @since  2015/06/03
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = null)
	{
		$data = ['post_id' => $id];
		$rules = ['post_id' => 'required|exists:posts,id'];
		$validator = Validator::make($data, $rules);
		if ($validator->fails()) {
			Session::flash('edit_status', [
					'status' => 'danger',
					'message' => 'Post is not found!']);
		} else {
			$check_post_active = Post::whereDelete_status(0)->whereId($data['post_id'])->first();
			if ($check_post_active) {
				$path = "./public/images/post/";
	        	if(File::exists($path.$check_post_active->image) && $check_post_active->image != "")
	        		$check_post_active->image = URL::to('/') . "/public/images/post/" . $check_post_active->image;
	        	else
	        		$check_post_active->image = "";
				$data['post'] = $check_post_active;
			} else
				Session::flash('edit_status',[
								'status' => 'danger',
								'message' => 'Post is not found!']);
		}
		$data['categories'] = Category::all();
		return view('admin/edit-post', $data);
	}
	public function postEdit($id = null)
	{
		$check_post_active = Post::whereDelete_status(0)->whereId($id)->first();
		if ($check_post_active) {
			$data = Input::all();
			$validator = Post::validate($data);
			if ($validator->fails()) {
				return Redirect::to('admin/post/edit/' . $id)->withInput()->withErrors($validator);
			} else {
				$check_post_active->title = $data['title'];
				$check_post_active->content = $data['content'];
				$check_post_active->category_id = $data['category'];
				$destination_path = './public/images/post/'; // upload path
				if(isset($data['remove_image']))
				{
					if($check_post_active->image)
						if(File::exists($destination_path.$check_post_active->image))
							File::delete($destination_path.$check_post_active->image);
					$check_post_active->image = "";
				}
				else
				{
					if(Input::file('image')){

					    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
					    $file_name = str_random(8).'.'.$extension; // renameing image
					    if(Input::file('image')->move($destination_path, $file_name)){
					    	if ($check_post_active->image != "" && File::exists($destination_path.$check_post_active->image))
							    File::delete($destination_path.$check_post_active->image);
					    	$check_post_active->image = $file_name;
					    }
					}
				}
				$check_post_active->save();
				Session::flash('edit_status', [
						'status' => 'success',
						'message' => 'Edit post is success!']);
				return redirect()->back();
			}
		} else
			return redirect('post/edit');
	}

	/**
	 * admin create new post
	 * @author  Tran Van Moi
	 * @since  2015/06/03
	 * @return  response
	 */
	public function getCreate()
	{
		$data['categories'] = Category::all();
		return view('admin.create-post', $data);
	}

	/**
	 * admin create new post
	 * @author  Tran Van Moi
	 * @since  2015/06/03
	 * @return  response
	 */
	public function postCreate(){
		$data = Input::all();
		$validator = Post::validate($data);
		if ($validator->fails()) {
			return Redirect::to('post/create')->withInput()->withErrors($validator);
		} else {
			$post = Post::create_post($data);
			if (count($post))
				return redirect('admin/post/create')->withInput()->with('create_status',
						[
								'status' => 'success',
								'message' => 'Create a new post is success!']);
			else
				return redirect('admin/post/create')->withInput()->with('create_status',
						[
								'status' => 'danger',
								'message' => 'Create a new post is failed! Please try again!']);
		}
	}
}
