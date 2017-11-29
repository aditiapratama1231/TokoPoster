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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function(){
    //AUTH ROUTE
    Route::post('login','API\UserController@login');
    Route::post('register', 'API\UserController@register');
    
    //POSTER ROUTE
    Route::get('posters', 'API\PosterController@index');
    // Route::middleware('auth:api')->get('posters', 'API\PosterController@index');
    Route::middleware('auth:api')->post('posters', 'API\PosterController@create');
    Route::get('poster/{id}', 'API\PosterController@show');
    Route::delete('poster/{id}', 'API\PosterController@delete');
    
    //CATEGORY ROUTE
    Route::get('categories', 'API\CategoryController@index');
    Route::post('categories', 'API\CategoryController@create');
    Route::get('category/{id}', 'API\CategoryController@show');
    Route::delete('category/{id}', 'API\CategoryController@delete');
});