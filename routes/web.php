<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'AdminController@login');

Route::get('/login', function () {
    return view('login');
});

// Route::post('/login', 'AdminController@login');

Route::group(['middleware' => 'logged'], function (){

    Route::get('/admin', 'AdminController@index');
	Route::post('admin/search', 'AdminController@ajax_search');
	Route::get('/admin/board/{tag_url}', 'AdminController@tag_board');
});

Route::group(['middleware' => 'logged'], function (){

 Route::group(['prefix' => 'admin'], function(){
	Route::group(['prefix' => 'post'], function(){
	//  admin/post/add_post
			Route::post('add_post', 'PostController@add_post');

			Route::get('detail_post/{post_id}','PostController@get_post');
			Route::get('edit_post/{post_id}','PostController@edit_post');
			Route::post('delete_post/{post_id}','PostController@delete_post');

			Route::post('update_post/{post_id}', 'PostController@update_post');
			Route::post('upload_post/{post_id}', 'PostController@upload_post');
	});

	Route::group(['prefix' => 'comment'], function(){
		// admin/comment/add_comment
		Route::post('get_comment', 'CommentController@get_comment');
		Route::post('get_reply', 'CommentController@get_reply');
		Route::post('list_comment', 'CommentController@list_comment');

		Route::post('add_comment', 'CommentController@add_comment');
	});
 });
});

