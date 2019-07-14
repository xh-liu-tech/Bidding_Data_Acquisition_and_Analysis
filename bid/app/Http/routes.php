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

Route::get('/', function () {
    return view('welcome');
});

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
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/spider', 'SpiderController@index');
    Route::post('/spider', 'SpiderController@store');
    Route::put('/spider/{spider_method}/{id}', 'SpiderController@update');
    Route::delete('/spider/{spider_method}/{id}', 'SpiderController@destroy');
    Route::post('/spider/import', 'SpiderController@import');
    //Route::resource('/spider', 'SpiderController', ['only' => ['index', 'store', 'update', 'destroy']]); 
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/user', 'UserController@index');
    Route::put('/user/{id}', 'UserController@update');
    Route::delete('user/{id}', 'UserController@destroy');

    Route::get('/query', 'QueryController@index');
    Route::post('/query', 'QueryController@query');

    Route::get('/fetch', 'FetchController@index');
    Route::get('/fetch/start', 'FetchController@start');

    Route::get('/company', 'CompanyController@index');
    Route::get('/company/{company}', 'CompanyController@query');
    Route::get('/company/show/{company}', 'CompanyController@show');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/download/{file_name}', 'HomeController@getDownload');
    Route::get('/home', 'HomeController@index');
});
