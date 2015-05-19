<?php namespace App\Http\Controllers;

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
class PostController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Get create post
	 * @author Tran Van Moi
	 * @since 2015/05/19
	 * @return  response
	 */
	public function getCreate()
	{
		$data['categories'] = Category::all();
		return view('post.create', $data);
	}

	/**
	 * post create post
	 * @author Tran Van Moi
	 * @since 2015/05/19
	 * @return response
	 */
	public function postCreate()
	{
		$data = Input::all();
		$validator = Post::validate($data);
		if($validator->fails()){
			return Redirect::to('post/create')->withInput()->withErrors($validator);
		}
		else{
			$post = Post::create_post($data);
			if(count($post))
				return redirect('post/create')->withInput()->with('post_status', ['status' => 'success', 'message' => 'Create a new post is success!']);
			else
				return redirect('post/create')->withInput()->with('post_status', ['status' => 'danger', 'message' => 'Create a new post is failed! Please try again!']);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($post_id = null)
	{
		$data = ['post_id' => $post_id];
		$rules = ['post_id' => 'required|exists:posts,id'];
		$validator = Validator::make($data, $rules);			
		if($validator->fails()){
			Session::flash('post_status', ['status' => 'danger', 'message' => 'Post is not found!']);
		}
		else {
			$check_role = Post::whereUser_id(Auth::user()->id)->whereId($data['post_id'])->first();
			$check_delete_post = Post::whereDelete_status(0)->whereId($data['post_id'])->first();
			if($check_role && $check_delete_post){
				$data['post'] = $check_delete_post;				
			}
			else
				Session::flash('post_status', ['status' => 'danger', 'message' => 'You dont have permission to edit this post!']);
		}
		$data['categories'] = Category::all();
		return view('post/edit', $data);
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit($post_id = null)
	{
		$check_delete_post = Post::whereDelete_status(0)->whereId($post_id)->first();
		if($check_delete_post){
			$data = Input::all();
			$validator = Post::validate($data);
			if($validator->fails()){
				return Redirect::to('post/edit/'.$post_id)->withInput()->withErrors($validator);
			}
			else {
				$check_delete_post->title = $data['title'];
				$check_delete_post->content = $data['content'];
				$check_delete_post->category_id = $data['category'];
				$check_delete_post->save();
				Session::flash('post_status', ['status' => 'success', 'message' => 'Edit post is success!']);
				return redirect()->back();
			}
		}
		else
			return redirect('post/edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteDelete()
	{
		$data = Input::all();
		$rules = ['post_id' => 'required|exists:posts,id'];
		$validator = Validator::make($data, $rules);
		if($validator->fails())
			return 404;
		else{
			$check_role = Post::whereUser_id(Auth::user()->id)->whereId($data['post_id'])->first();
			$check_delete_post = Post::whereDelete_status(0)->whereId($data['post_id'])->first();
			if($check_role && $check_delete_post){
				$check_delete_post->delete_status = 1;
				$check_delete_post->save();
				return 200;
			}
			else
				return 404;
		}
	}

}
