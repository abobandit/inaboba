<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
    Route::post('/signup', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/authUser', [UserController::class, 'authUser']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('/albums', AlbumController::class);
        Route::apiResource('/users', UserController::class)->only('index','update','show','store');
        Route::apiResource('/posts', PostController::class);
        Route::apiResource('/chats', ChatController::class);
        Route::apiResource('/comments', CommentController::class);
        Route::apiResource('/friends', FriendController::class);
        Route::apiResource('/messages', MessageController::class);
        Route::apiResource('/media', MediaController::class);
        Route::get('/media', [MediaController::class,'media']);
        Route::get('/media/{album}', [MediaController::class,'mediaByAlbum']);
        Route::apiResource('/albums', AlbumController::class);
    });
    Route::middleware(['auth:sanctum', 'admin'])->prefix('/admin')->group(function () {
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/posts', PostController::class);
        Route::apiResource('/chats', ChatController::class);
        Route::apiResource('/comments', CommentController::class);
        Route::apiResource('/friends', FriendController::class);
        Route::apiResource('/messages', MessageController::class);
        Route::apiResource('/media', MediaController::class);
        Route::apiResource('/albums', AlbumController::class);
    });
