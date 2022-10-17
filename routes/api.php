<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CommentLikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostLikeController;
use App\Http\Controllers\Api\ReplyController;
use App\Http\Controllers\Api\UserAuthController;
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

Route::resources([
    'post' => PostController::class,
    'comment/reply' => ReplyController::class,
    'comment' => CommentController::class,
], ['except' => ['create', 'edit']]);

