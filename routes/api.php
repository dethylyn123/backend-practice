<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarouselItemsController;
// use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/carousel', [CarouselItemsController::class, 'index']);
Route::get('/carousel/{id}', [CarouselItemsController::class, 'show']);

// when using request use post, put, or patch
Route::post('/carousel', [CarouselItemsController::class, 'store']);
// when using update use put, or patch
Route::put('/carousel/{id}', [CarouselItemsController::class, 'update']);
Route::delete('/carousel/{id}', [CarouselItemsController::class, 'destroy']);

// User API Route
Route::get('/user', [UserController::class, 'index']);
// when using request use post, put, or patch
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::put('/user/email/{id}', [UserController::class, 'email'])->name('user.email');
Route::put('/user/password/{id}', [UserController::class, 'password'])->name('user.password');
Route::delete('/user/{id}', [UserController::class, 'destroy']);


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
