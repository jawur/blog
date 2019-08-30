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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts')
    ->uses('PostController@index')
    ->name('posts.index');

Route::post('posts')
    ->uses('PostController@store')
    ->name('posts.store')
    ->middleware('auth:api');

Route::get('posts/{post}')
    ->uses('PostController@show')
    ->name('posts.show');

Route::patch('posts/{post}')
    ->uses('PostController@update')
    ->middleware('auth:api')
    ->name('posts.update');

Route::delete('posts/{post}')
    ->uses('PostController@destroy')
    ->name('posts.destroy')
    ->middleware('auth:api');

//-----------------------------------------

Route::get('comments')
    ->uses('CommentController@index')
    ->name('comments.index');

Route::post('comments')
    ->uses('CommentController@store')
    ->name('comments.store')
    ->middleware('auth:api');

Route::get('comments/{comment}')
    ->uses('CommentController@show')
    ->name('comments.show');

Route::patch('comments/{comment}')
    ->uses('CommentController@update')
    ->name('comments.update')
    ->middleware('auth:api');

Route::delete('comments/{comment}')
    ->uses('CommentController@destroy')
    ->name('comments.destroy')
    ->middleware('auth:api');
