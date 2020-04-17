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
Route::get('{slug}-{id}.html', ['as' => 'brand', 'uses' => 'HomeController@brand'])->where(['slug' => '[a-z\-0-9]+', 'id' => '[0-9]+']);;


//-----------------//
//backend


Route::get('/search','ProductController@search');


Route::get('/logout','AdminController@logout');
Route::get('/dashboard', 'AdminController@index');

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
Route::get('export','BrandController@export');
Route::get('brand.search','BrandController@search')->name('brand.search');


//category-product
Route::resource('category','CategoryController');
// Route::get('category/create', 'CategoryController@create');
// Route::post('category/create', 'CategoryController@store');
// Route::get('category/list','CategoryController@list');
// Route::get('category/edit/{id}', 'CategoryController@edit');
// Route::post('category/update/{id}', 'CategoryController@update');
// Route::delete('category/delete/{id}', 'CategoryController@delete');
// Route::get('category', 'CategoryController@index');
// Route::get('category/deactivated/{id}','CategoryController@deactivated');
// Route::get('category/activated/{id}','CategoryController@activated');

// Route::get('/{any}', function () {
//   return view('category');
// })->where('any', '.*');

Route::get('/upload', 'UploadImagesController@index');
Route::post('/images-save', 'UploadImagesController@store');
Route::post('/images-delete', 'UploadImagesController@destroy');
Route::get('/get-data', 'UploadImagesController@getData');