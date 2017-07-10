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
    return view('home');
});

Auth::routes();

Route::get('/register/confirm/{verifyToken}', 'Auth\RegisterController@verifyEmail');

//Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/accounts', 'AccountsController@index');
Route::get('/accounts/create', 'AccountsController@create');
Route::post('/accounts/create', 'AccountsController@store');
Route::put('/accounts/{account}', 'AccountsController@update');
Route::delete('/accounts/{account}', 'AccountsController@destroy');

Route::get('/income', 'IncomesController@index');
Route::post('/income', 'IncomesController@index');
Route::get('/income/create', 'IncomesController@create');
Route::post('/income/create', 'IncomesController@store');
Route::put('/income/{income}', 'IncomesController@update');
Route::delete('/income/{income}', 'IncomesController@destroy');

Route::get('/expenses', 'ExpensesController@index');
Route::post('/expenses', 'ExpensesController@index');
Route::get('/expenses/create', 'ExpensesController@create');
Route::put('/expenses/{expense}', 'ExpensesController@update');
Route::post('/expenses/create', 'ExpensesController@store');
Route::delete('/expenses/{expense}', 'ExpensesController@destroy');

Route::get('/categories', 'CategoriesController@index');
Route::get('/categories/create', 'CategoriesController@create');
Route::post('/categories/create', 'CategoriesController@store');
Route::put('/categories/{category}', 'CategoriesController@update');
Route::delete('/categories/{category}', 'CategoriesController@destroy');

Route::get('/subcategories/{category}', 'SubcategoriesController@index');
Route::post('/subcategories/create', 'SubcategoriesController@store');
Route::put('/subcategories/{subcategory}', 'SubcategoriesController@update');
Route::delete('/subcategories/{subcategory}', 'SubcategoriesController@destroy');
