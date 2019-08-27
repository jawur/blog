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

//Route:::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('posts')
    ->uses('PostController@index')
    ->name('getPosts');

Route::post('posts')
    ->uses('PostController@store')
    ->name('storePost')
    ->middleware('auth:api');

Route::get('posts/{post}')
    ->uses('PostController@show')
    ->name('showPost');

Route::put('posts/{post}')
    ->uses('PostController@update')
    ->name('getPost')
    ->middleware('auth:api');

Route::delete('posts/{post}')
    ->uses('PostController@destroy')
    ->name('deletePost')
    ->middleware('auth:api');

//-----------------------------------------

Route::get('comments')
    ->uses('CommentController@index')
    ->name('getComments');

Route::post('comments')
    ->uses('CommentController@store')
    ->name('storeComment')
    ->middleware('auth:api');

Route::get('comments/{comment}')
    ->uses('CommentController@show')
    ->name('showComment');

Route::put('comments/{comment}')
    ->uses('CommentController@update')
    ->name('getComment')
    ->middleware('auth:api');

Route::delete('comments/{comment}')
    ->uses('CommentController@destroy')
    ->name('deleteComment')
    ->middleware('auth:api');
