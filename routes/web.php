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

//frontend


Route::get('/','HomeController@index');

//-----------------//
//backend


Route::get('/logout','AdminController@logout');
Route::get('/dashboard', 'AdminController@index')->name('home');

//products
Route::resource('products','ProductController');
Route::get('/unactive-product/{id}','ProductController@unactive_product');
Route::get('/active-product/{id}','ProductController@active_product');
Route::post('/delete-multiple','ProductController@delete_multiple');

Route::get('ajaxdata/massremove','ProductController@massremove')->name('ajaxdata.massremove');

//brand
Route::resource('brand','BrandController');
Route::get('/unactive-brand/{id}','BrandController@unactive_brand');
Route::get('/active-brand/{id}','BrandController@active_brand');

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