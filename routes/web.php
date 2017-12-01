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
//social login
Route::get ( '/redirect/{driver}', 'Auth\SocialAuthController@redirect' );
Route::get ( '/callback/{driver}', 'Auth\SocialAuthController@callback' );

Route::get('/', 'HomeController@index')->name('home');
Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::resource('/user/categories', 'CategoryController', ['only'=>['show'], 'as' => 'user']);
Route::get('/product_details/{id}', 'HomeController@show')->name('product.show');
Route::resource('/orders', 'OrderController');

//wishlist functions
Route::get('/addToWishList/{id}', 'HomeController@addToWishList')->name('addToWishList');
Route::get('/users/wishlist', 'HomeController@getWithList')->name('wishlist');
Route::get('/removeFromWithList/{id}', 'HomeController@removeFromWithList')->name('removeFromWithList');

//cart functions
Route::get('/addCart/{id}', 'HomeController@getAddToCart' )->name('addCart');
Route::get('/cart', 'HomeController@getCart' )->name('cartDetails');
Route::get('/changeQuantity/{product_id}/{num}', 'HomeController@changeQuantity')->name('changeQuantity');
Route::get('/removeProduct/{id}','HomeController@removeFromCart')->name('removeProduct');

//contact
Route::get('/contact_us','HomeController@getContact');
Route::post('/contact_us','HomeController@postContact');

//compare
Route::get('/addToCompare/{id}','HomeController@addToCompare')->name('addToCompare');
Route::get('/compare', 'HomeController@compare')->name('compare');
Route::get('/remvoveFromCompare/{id}','HomeController@remvoveFromCompare')->name('remvoveFromCompare');

Route::prefix('admin')->group(function(){
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
  Route::resource('/users', 'Admin\UserController',['except'=>['store','create']]);
  Route::resource('/categories', 'Admin\CategoryController');
  Route::resource('/products', 'Admin\ProductController');
  Route::resource('/orders', 'Admin\OrderController',['except'=>['store','create','destroy'],
  	'as'=>'admin']);
  Route::patch('/orders/cancel/{id}', 'Admin\OrderController@cancel');
});

