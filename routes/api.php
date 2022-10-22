<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CommentLikeController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostLikeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReplyController;
use App\Http\Controllers\Api\ReplyLikeController;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ViewStoryController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'auth/user'], function () {
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::get('/info', [UserAuthController::class, 'getUserInfo']);
    Route::put('', [UserController::class, 'update']);
    Route::put('/password', [UserController::class, 'changePassword']);
    Route::post('update/image', [UserController::class, 'imageUpdate']);
    Route::delete('', [UserController::class, 'destroy']);
});
Route::group(['prefix' => 'post/like'], function () {
    Route::get('', [PostLikeController::class, 'index']);
    Route::get('/{id}', [PostLikeController::class, 'show']);
    Route::post('', [PostLikeController::class, 'store']);
    Route::delete('/{id}', [PostLikeController::class, 'destroy']);
});
Route::group(['prefix' => 'comment/like'], function () {
    Route::get('/{id}', [CommentLikeController::class, 'show']);
    Route::post('', [CommentLikeController::class, 'store']);
    Route::delete('/{id}', [CommentLikeController::class, 'destroy']);
});
Route::group(['prefix' => 'reply/like'], function () {
    Route::get('/{id}', [ReplyLikeController::class, 'show']);
    Route::post('', [ReplyLikeController::class, 'store']);
    Route::delete('/{id}', [ReplyLikeController::class, 'destroy']);
});
Route::group(['prefix'=>'profile'],function(){
   Route::get('/{id}',[ProfileController::class,'show']);
   Route::get('/posts/{id}',[ProfileController::class,'profilePosts']);
});
Route::group(['prefix'=>'story/view'],function(){
    Route::get('/users/{id}',[ViewStoryController::class,'index']);
    Route::get('/{id}',[ViewStoryController::class,'show']);
    Route::post('',[ViewStoryController::class,'store']);
});
Route::get('followers', [FollowController::class, 'followers']);
Route::get('user/{id}', [UserController::class, 'show']);

Route::resource('follow', FollowController::class)->except('update', 'create', 'edit');
Route::resource('story', StoryController::class)->except('update', 'create', 'edit');
Route::resources([
    'post' => PostController::class,
    'comment/reply' => ReplyController::class,
    'comment' => CommentController::class,
], ['except' => ['create', 'edit']]);

