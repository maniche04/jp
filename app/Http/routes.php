<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('/home');
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index'); 

    Route::get('/items', 'ItemsController@index'); 

    Route::get('/items/search', 'ItemsController@search'); 

    Route::post('/cart/add','CartController@add');

    Route::post('/cart/remove','CartController@remove');

    Route::get('/cart/getbox','CartController@getbox');

    Route::get('/settings/setlayout/{value}','SettingsController@setLayout');

    Route::group(['middleware' => 'verifyadmin'], function() {
	    
	    Route::get('/admin', 'AdminController@updatePrices');

	});



});
