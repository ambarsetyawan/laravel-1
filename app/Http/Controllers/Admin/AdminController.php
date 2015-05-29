<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

	/**
	 * Home page of admin
	 *
	 * @return Response
	 */
	public function __construct(){
		$this->middleware('admin');
	}
	public function getIndex()
	{
		return view('admin/home');
	}
}
