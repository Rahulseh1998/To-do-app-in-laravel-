<?php

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

Route::get('/', function () {
    return view('welcome');
});





	Route::post('list', 'listController@create');
    
	Route::post('taskDelete','listController@taskDelete');

	Route::post('taskDone','listController@taskDone');

	Route::post('editTask', 'listController@editTask');

	Route::post('unDone', 'listController@taskUndone');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
