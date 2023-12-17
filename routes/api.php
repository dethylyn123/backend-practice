<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarouselItemsController;
// use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PromptController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ProfileController;
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

//Private APIs
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //Admin APIs
    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel',               'index');
        Route::get('/carousel/{id}',          'show');
        Route::post('/carousel',              'store');
        Route::put('/carousel/{id}',          'update');
        Route::delete('/carousel/{id}',       'destroy');
    });

    Route::get('/user', [UserController::class, 'index']);
    Route::put('/user/image/{id}', [UserController::class, 'image'])->name('user.image');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::put('/user/email/{id}', [UserController::class, 'email'])->name('user.email');
    Route::put('/user/password/{id}', [UserController::class, 'password'])->name('user.password');
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    Route::get('/prompt', [PromptController::class, 'index']);
    Route::get('/prompt/{id}', [PromptController::class, 'show']);
    Route::post('/prompt', [PromptController::class, 'store']);
    Route::delete('/prompt/{id}', [PromptController::class, 'destroy']);

    //Message API
    Route::get('/message', [MessageController::class, 'index']);
    Route::get('/message/{id}', [MessageController::class, 'show']);
    Route::post('/message', [MessageController::class, 'store']);
    Route::put('/message/{id}', [MessageController::class, 'update']);
    Route::delete('/message/{id}', [MessageController::class, 'destroy']);

    //User Specific APIs = update of image based kong kinsa tong user nga ni log in
    Route::get('/profile/show', [ProfileController::class, 'show']);
    Route::put('/profile/image', [ProfileController::class, 'image'])->name('profile.image');
});


//User Selection
Route::get('/user/selection', [UserController::class, 'selection']);
