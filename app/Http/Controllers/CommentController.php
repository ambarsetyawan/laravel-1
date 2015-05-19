<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller {

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
	 * Display a listing of the resource.
	 * 
	 * @return Response
	 */
	public function getIndex ()
	{
		$data = [
				'content' => "this is test comment",
				'post_id' => 3];
		$validator = Comment::validate($data);
		if ($validator->fails()) {
			echo "ok";
		} else
			echo "not ok";
	}

	/**
	 * Show the form for creating a new resource.
	 * 
	 * @return Response
	 */
	public function postCreate ()
	{
		$data = Input::all();
		$validator = Comment::validate($data);
		if ($validator->fails()) {
			return 404;
		} else {
			$content = Input::get('content');
			$post_id = Input::get('post_id');
			$cmt = Comment::create_cmt($content, $post_id);
			if (count($cmt)) {
				return 200;
			} else
				return 404;
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * 
	 * @return Response
	 */
	public function store ()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function show ($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function edit ($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function update ($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy ($id)
	{
		//
	}
}
