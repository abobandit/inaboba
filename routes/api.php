<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/signin', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/authUser', [UserController::class, 'authUser']);
    Route::apiResource('/albums', AlbumController::class);
    Route::apiResource('/users', UserController::class)->only('index','update','show','store');
    Route::apiResource('/posts', PostController::class);
    Route::apiResource('/chats', ChatController::class);
    Route::apiResource('/comments', CommentController::class);
    Route::apiResource('/friends', FriendController::class);
    Route::apiResource('/messages', MessageController::class);
    Route::apiResource('/photos', PhotoController::class);
    Route::get('/photos', [PhotoController::class,'images']);
    Route::get('/photos/{album}', [PhotoController::class,'imagesByAlbum']);
    Route::apiResource('/albums', AlbumController::class);
});
Route::middleware(['auth:sanctum', 'admin'])->prefix('/admin')->group(function () {
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/posts', PostController::class);
    Route::apiResource('/chats', ChatController::class);
    Route::apiResource('/comments', CommentController::class);
    Route::apiResource('/friends', FriendController::class);
    Route::apiResource('/messages', MessageController::class);
    Route::apiResource('/photos', PhotoController::class);
    Route::apiResource('/albums', AlbumController::class);
});
