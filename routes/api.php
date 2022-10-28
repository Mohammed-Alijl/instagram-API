<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CommentLikeController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\ForgetPasswordController;
use App\Http\Controllers\Api\ImagesController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostLikeController;
use App\Http\Controllers\Api\PostSaveController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReelsController;
use App\Http\Controllers\Api\ReplyController;
use App\Http\Controllers\Api\ReplyLikeController;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerifyEmailController;
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
    Route::post('/password/code/send', [ForgetPasswordController::class, 'sendCode']);
    Route::post('/password/code/check', [ForgetPasswordController::class, 'checkCode']);
    Route::post('/password/reset', [ForgetPasswordController::class, 'resetPassword']);
    Route::post('update/image', [UserController::class, 'imageUpdate']);
    Route::delete('', [UserController::class, 'destroy']);
});
Route::group(['prefix' => 'post'], function () {
    Route::group(['prefix' => 'like'], function () {
        Route::get('', [PostLikeController::class, 'index']);
        Route::get('/{id}', [PostLikeController::class, 'show']);
        Route::post('', [PostLikeController::class, 'store']);
        Route::delete('/{id}', [PostLikeController::class, 'destroy']);
    });
    Route::group(['prefix' => 'save'], function () {
        Route::get('', [PostSaveController::class, 'index']);
        Route::post('', [PostSaveController::class, 'store']);
        Route::delete('/{id}', [PostSaveController::class, 'destroy']);
    });
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
Route::group(['prefix' => 'profile'], function () {
    Route::get('/{id}', [ProfileController::class, 'show']);
    Route::get('/posts/{id}', [ProfileController::class, 'profilePosts']);
});
Route::group(['prefix' => 'story/view'], function () {
    Route::get('/users/{id}', [ViewStoryController::class, 'index']);
    Route::get('/{id}', [ViewStoryController::class, 'show']);
    Route::post('', [ViewStoryController::class, 'store']);
});
Route::group(['prefix' => 'user'], function () {
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/search', [UserController::class, 'search']);
});
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


Route::get('followers/{id}', [FollowController::class, 'followers']);
Route::get('following/{id}', [FollowController::class, 'index']);

Route::resource('follow', FollowController::class)->except('update', 'create', 'edit', 'index');
Route::resource('story', StoryController::class)->except('update', 'create', 'edit');
Route::resource('reels', ReelsController::class)->except('update', 'create', 'edit');
Route::resources([
    'post' => PostController::class,
    'comment/reply' => ReplyController::class,
    'comment' => CommentController::class,
], ['except' => ['create', 'edit']]);

