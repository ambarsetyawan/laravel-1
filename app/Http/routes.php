<?php
Route::get('/', 'HomeController@index');
Route::get('home/{category?}', 'HomeController@index');
// reset passsword
Route::controllers([
	// 'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'user' => 'UserController'
]);
// User
Route::group(['middleware' => 'auth'], function()
{
	Route::controllers(['post' => 'PostController']);
	Route::controllers(['comment' => 'CommentController']);
	Route::controllers(['like' => 'LikeController']);
});
// Admin
Route::group(['middleware' => 'admin'], function(){
    Route::controllers(['admin' => 'Admin\AdminController']);
    // Route::controllers(['admin\user' => 'Admin\UserController']);
    // Route::controllers(['admin\post' => 'Admin\PostController']);
});