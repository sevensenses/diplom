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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/question', 'HomeController@question')->name('question.add');
Route::post('/question', 'HomeController@create')->name('question.add');

Route::group([
	'as' => 'admin.',
	'prefix' => 'admin',
	'namespace' => '\Admin',
	'middleware' => ['auth'],
], function () {

	Route::get('', 'Controller@index')->name('dashboard');

	Route::get('{model}/list', function (Request $request, $model) { 
		return \App::call('App\Http\Controllers\Admin\\' . studly_case($model) . 'Controller@list'); 
	})->name('list');

	Route::get('{model}/create', function (Request $request, $model) { 
		return \App::call('App\Http\Controllers\Admin\\' . studly_case($model) . 'Controller@createForm'); 
	})->name('create.form');

	Route::post('{model}/create', function (Request $request, $model) { 
		return \App::call('App\Http\Controllers\Admin\\' . studly_case($model) . 'Controller@create'); 
	})->name('create');

	Route::get('{model}/edit/{id}', function (Request $request, $model, $id) { 
		return \App::call('App\Http\Controllers\Admin\\' . studly_case($model) . 'Controller@editForm', [$id]); 
	})->name('edit.form');

	Route::post('{model}/edit/{id}', function (Request $request, $model, $id) { 
		return \App::call('App\Http\Controllers\Admin\\' . studly_case($model) . 'Controller@edit', [$id]); 
	})->name('edit');

	Route::any('{model}/remove/{id}', function (Request $request, $model, $id) { 
		return \App::call('App\Http\Controllers\Admin\\' . studly_case($model) . 'Controller@remove', [$id]); 
	})->name('remove');

});