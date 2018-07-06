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

//Route::get('/', function () {
//    return view('category.category');
//});

Route::get('/', 'WebController@index')->name('web.index');

Auth::routes();

Route::get('/product/get/{productId}', 'ProductController@get')->name('product.get');
Route::get('/post/get/{postId}', 'PostController@get')->name('post.get');
Route::get('/post/all', 'PostController@all')->name('post.all');
Route::get('/category/get/{categoryId}', 'CategoryController@get')->name('category.get');

//admin
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('auth', 'adminOnly');

// categories manager
Route::group(['prefix' => 'admin/categories', 'middleware' => ['auth', 'adminOnly']], function () {
    Route::get('/', 'CategoryController@manager')->name('category.manager');
    Route::get('/create', 'CategoryController@create')->name('category.create');
    Route::get('/edit/{categoryId}', 'CategoryController@edit')->name('category.edit');
    Route::get('/delete/{categoryId}', 'CategoryController@delete')->name('category.delete');
    Route::post('/update/{categoryId}', 'CategoryController@update')->name('category.update');
    Route::post('/store', 'CategoryController@store')->name('category.store');
});

// products manager
Route::group(['prefix' => 'admin/products', 'middleware' => ['auth', 'adminOnly']], function () {
    Route::get('/', 'ProductController@manager')->name('product.manager');
    Route::post('/all', 'ProductController@all')->name('products.all');
    Route::get('/create', 'ProductController@create')->name('product.create');
    Route::post('/store', 'ProductController@store')->name('product.store');
    Route::get('/edit/{productId}', 'ProductController@edit')->name('product.edit');
    Route::post('/update/{productId}', 'ProductController@update')->name('product.update');
    Route::get('/delete/{productId}', 'ProductController@delete')->name('product.delete');
});

// client orders
Route::group(['prefix' => 'order', 'middleware' => ['auth']], function () {
    Route::get('/manager/{productId}', 'OrderController@manager')->name('order.manager');
    Route::get('/my', 'OrderController@my')->name('order.my');
    Route::get('/close/{orderId}', 'OrderController@close')->name('order.close');
    Route::post('/store', 'OrderController@store')->name('order.store');
    Route::post('/add', 'OrderController@add')->name('order.add');
});

// orders for admin
Route::group(['prefix' => 'admin/orders', 'middleware' => ['auth', 'adminOnly']], function () {
    Route::get('/', 'OrderController@all')->name('order.all');
    Route::get('/details/{orderId}', 'OrderController@details')->name('order.details');
});
