<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarouselItemsController;
// use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PromptController;
use App\Http\Controllers\Api\MessageController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Public APIs
Route::post('/login', [AuthController::class, 'login'])->name('user.login');

Route::post('/user', [UserController::class, 'store'])->name('user.store'); //user register


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel',               'index');
        Route::get('/carousel/{id}',          'show');

        // when using request use post, put, or patch
        Route::post('/carousel',              'store');
        // when using update use put, or patch
        Route::put('/carousel/{id}',          'update');
        Route::delete('/carousel/{id}',       'destroy');
    });

    // User API Route
    Route::get('/user', [UserController::class, 'index']);
    // when using request use post, put, or patch

    Route::put('/user/image/{id}', [UserController::class, 'image'])->name('user.image');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/email/{id}', [UserController::class, 'email'])->name('user.email');
    Route::put('/user/password/{id}', [UserController::class, 'password'])->name('user.password');
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
});

// Prompt API

Route::get('/prompt', [PromptController::class, 'index']);
Route::get('/prompt/{id}', [PromptController::class, 'show']);

// when using request use post, put, or patch
Route::post('/prompt', [PromptController::class, 'store']);
// when using update use put, or patch
Route::delete('/prompt/{id}', [PromptController::class, 'destroy']);

//User Selection
Route::get('/user/selection', [UserController::class, 'selection']);

//Message API
Route::get('/message', [MessageController::class, 'index']);
Route::get('/message/{id}', [MessageController::class, 'show']);
Route::post('/message', [MessageController::class, 'store']);
Route::put('/message/{id}', [MessageController::class, 'update']);
Route::delete('/message/{id}', [MessageController::class, 'destroy']);
