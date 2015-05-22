<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Input;
use App\Post;
use Redirect;
use Validator;
use Auth;
use Session;
use File;
use URL;

class PostController extends Controller {

	/**
	 * Create a new controller instance.
	 * 
	 * @return void
	 */
	public function __construct ()
	{
		$this->middleware('auth');
	}

	/**
	 * Get create post
	 * 
	 * @author Tran Van Moi
	 * @since 2015/05/19
	 * @return response
	 */
	public function getCreate ()
	{
		$data['categories'] = Category::all();
		return view('post.create', $data);
	}

	/**
	 * post create post
	 * 
	 * @author Tran Van Moi
	 * @since 2015/05/19
	 * @return response
	 */
	public function postCreate ()
	{
		$data = Input::all();
		$validator = Post::validate($data);
		if ($validator->fails()) {
			return Redirect::to('post/create')->withInput()->withErrors($validator);
		} else {
			$post = Post::create_post($data);
			if (count($post))
				return redirect('post/create')->withInput()->with('post_status', 
						[
								'status' => 'success',
								'message' => 'Create a new post is success!']);
			else
				return redirect('post/create')->withInput()->with('post_status', 
						[
								'status' => 'danger',
								'message' => 'Create a new post is failed! Please try again!']);
		}
	}

	/**
	 * Edit post by id
	 * @author  Tran Van Moi
	 * @since  2015/05/19
	 * @param int $id        	
	 * @return Response
	 */
	public function getEdit ($post_id = null)
	{
		$data = ['post_id' => $post_id];
		$rules = ['post_id' => 'required|exists:posts,id'];
		$validator = Validator::make($data, $rules);
		if ($validator->fails()) {
			Session::flash('post_status', [
					'status' => 'danger',
					'message' => 'Post is not found!']);
		} else {
			$check_role = Post::whereUser_id(Auth::user()->id)->whereId($data['post_id'])->first();
			$check_delete_post = Post::whereDelete_status(0)->whereId($data['post_id'])->first();
			if ($check_role && $check_delete_post) {
				$path = "./public/images/post/";
	        	if(File::exists($path.$check_delete_post->image) && $check_delete_post->image != "")
	        		$check_delete_post->image = URL::to('/') . "/public/images/post/" . $check_delete_post->image;
	        	else
	        		$check_delete_post->image = "";
				$data['post'] = $check_delete_post;
			} else
				Session::flash('post_status', 
						[
								'status' => 'danger',
								'message' => 'You dont have permission to edit this post!']);
		}
		$data['categories'] = Category::all();
		return view('post/edit', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function postEdit ($post_id = null)
	{
		$check_delete_post = Post::whereDelete_status(0)->whereId($post_id)->first();
		if ($check_delete_post) {
			$data = Input::all();
			$validator = Post::validate($data);
			if ($validator->fails()) {
				return Redirect::to('post/edit/' . $post_id)->withInput()->withErrors($validator);
			} else {
				$check_delete_post->title = $data['title'];
				$check_delete_post->content = $data['content'];
				$check_delete_post->category_id = $data['category'];
				if(Input::file('image')){
					$destination_path = './public/images/post/'; // upload path
				    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
				    $file_name = str_random(8).'.'.$extension; // renameing image
				    if(Input::file('image')->move($destination_path, $file_name)){
				    	if ($check_delete_post->image != "" && File::exists($destination_path.$check_delete_post->image))
						    File::delete($destination_path.$check_delete_post->image);
				    	$check_delete_post->image = $file_name;
				    }
				}
				$check_delete_post->save();
				Session::flash('post_status', [
						'status' => 'success',
						'message' => 'Edit post is success!']);
				return redirect()->back();
			}
		} else
			return redirect('post/edit');
	}

	/**
	 * delete post
	 * @author  Tran Van Moi
	 * @since  2015/05/19    	
	 * @return Response
	 */
	public function deleteDelete ()
	{
		$data = Input::all();
		$rules = [
				'post_id' => 'required|exists:posts,id'];
		$validator = Validator::make($data, $rules);
		if ($validator->fails())
			return 404;
		else {
			$check_role = Post::whereUser_id(Auth::user()->id)
			                    ->whereId($data['post_id'])
			                    ->whereDelete_status(0)
			                    ->first();
			if ($check_role) {
				$check_role->delete_status = 1;
				$check_role->save();
				return 200;
			} else
				return 404;
		}
	}
}
