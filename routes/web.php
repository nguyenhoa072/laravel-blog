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
Route::get('/sort','HomeController@sort');
// Route::get('{id}','HomeController@brand');
Route::get('{slug}-{id}.html', ['as' => 'brand', 'uses' => 'HomeController@brand'])->where(['slug' => '[a-z\-0-9]+', 'id' => '[0-9]+']);;


//-----------------//
//backend


Route::get('/search','ProductController@search');


Route::get('/logout','AdminController@logout');
Route::get('/dashboard', 'AdminController@index')->name('home');

//products

Route::resource('products','ProductController');
Route::get('/unactive-product/{id}','ProductController@unactive_product');
Route::get('/active-product/{id}','ProductController@active_product');
Route::post('/delete-multiple','ProductController@delete_multiple');

Route::get('ajaxdata/massremove','ProductController@massremove')->name('ajaxdata.massremove');

Route::get('{slug}-p{id}.html', ['as' => 'products.show', 'uses' => 'ProductController@show'])->where(['slug' => '[a-z\-0-9]+', 'id' => '[0-9]+']);


//brand
Route::resource('brand','BrandController');
Route::get('brand/deactivated/{id}','BrandController@deactivated');
Route::get('brand/activated/{id}','BrandController@activated');

//category-product
Route::resource('category','CategoryController');
Route::get('category/deactivated/{id}','CategoryController@deactivated');
Route::get('category/activated/{id}','CategoryController@activated');