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



//frontend

Route::get('/welcome', function () {
    return view('frontend.welcome');
});

Route::get('/','HomeController@index');


//backend
Route::get('/login','AdminController@login');
Route::get('/logout','AdminController@logout');
Route::get('/dashboard','AdminController@index');
Route::post('/admin-login','AdminController@admin_login');


//products
Route::resource('products','ProductController');


//category-product

Route::get('/category','CategoryController@index');
Route::get('/add-category','CategoryController@create');
Route::post('/save-category','CategoryController@store');

Route::get('/edit-category/{id}','CategoryController@edit');
Route::post('/update-category/{id}','CategoryController@update');
Route::delete('/delete-category/{id}','CategoryController@destroy');
// Route::get('/delete-category/{id}','CategoryController@destroy');

Route::get('/unactive-category/{id}','CategoryController@unactive_category');
Route::get('/active-category/{id}','CategoryController@active_category');