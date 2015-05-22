<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'WelcomeController@index');
Route::get('/', 'HomeController@index');
Route::get('home/{category?}', 'HomeController@index');
// Login system
// Route::get('user/login', 'UserController@login');
// Route::post('user/login', 'UserController@login');

// // register system
// Route::get('user/register', 'UserController@register');
// Route::post('user/register', 'UserController@register');

// // logout
// Route::get('user/logout', 'UserController@logout');

// // go to profile
// Route::get('user/profile', 'UserController@profile');

// // login with facebook
// Route::get('user/facebook/login', 'UserController@facebook_redirect');
// Route::get('user/loginfb', 'UserController@loginfb');

// // login with google
// Route::get('user/google/login', 'UserController@google_redirect');
// Route::get('user/logingg', 'UserController@logingg');

// // login with twitter
// Route::get('user/twitter/login', 'UserController@twitter_redirect');
// Route::get('user/logintt', 'UserController@logintt');

// // forgot password
// Route::get('user/forgot', 'UserController@forgot');

// reset passsword
Route::controllers([
	// 'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'user' => 'UserController'
]);
Route::group(['middleware' => 'auth'], function()
{
	Route::controllers(['post' => 'PostController']);
	Route::controllers(['comment' => 'CommentController']);
	Route::controllers(['like' => 'LikeController']);
});
