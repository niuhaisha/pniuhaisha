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

Route::get('/', function () {
    return view('welcome');
});

//后台模块
Route::group([], function(){

	Route::get('/admin', 'AdminController@index');
	//隐式控制器
	Route::controller('/admin/user', 'UserController');
	Route::controller('/admin/cate', 'CateController');
	Route::controller('/admin/goods', 'GoodsController');


});

//前台模块
Route::group([], function(){



});
