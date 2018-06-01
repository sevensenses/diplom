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
Route::post('/question', 'HomeController@create')->name('question.store');

Route::group([
	'as' => 'admin.',
	'prefix' => 'admin',
	'namespace' => '\Admin',
	'middleware' => ['auth'],
], function () {

	Route::get('', 'DashboardController@index')->name('dashboard');

	Route::get('categories/{category}/questions/new', 'CategoryQuestionController@new')->name('categories.questions.new');
	Route::get('categories/{category}/questions/hidden', 'CategoryQuestionController@hidden')->name('categories.questions.hidden');
	Route::get('categories/{category}/questions/published', 'CategoryQuestionController@published')->name('categories.questions.published');

	Route::resources([
		'users' => 'UserController',
		'categories' => 'CategoryController',
		'questions' => 'QuestionController',
	]);

	Route::get('categories/{category}/questions', 'CategoryQuestionController@index')->name('categories.questions.index');

});