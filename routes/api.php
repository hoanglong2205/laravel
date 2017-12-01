<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user-details', 'Api\UserController@show');
Route::post('/login', 'Api\AuthController@authenticate');
//automatic generate new token
Route::get('/refresh-token', 'Api\AuthController@refresh');

Route::post('/signup', 'Api\AuthController@register');
Route::resource('/categories', 'Api\CategoryController', ['only' => ['index','show']]);
Route::resource('/orders', 'Api\OrderController');