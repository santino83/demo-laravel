<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CarouselImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ThematicController;
use App\Http\Controllers\ThematicImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homepage.index');
})->name('homepage');

/* =========== travio api =========== */

Route::post('/api/travio/search/hotels',[ \App\Http\Controllers\TravioController::class, 'searchHotels']);

/* =========== admin routes ========= */

/* ADMIN ROUTES */
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {

    Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::resource('carousel', CarouselController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy', 'create']);

    Route::controller(CarouselImageController::class)->name('carousel_image.')->group(function (){

        Route::get('/carousel/{carousel}/image', 'index')->name('index');
        Route::post('/carousel/{carousel}/image', 'store')->name('store');
        Route::delete('/carousel/{carousel}/image/{image}','destroy')->name('destroy');
        Route::post('/carousel/{carousel}/image/{image}/up', 'moveUp')->name('change_up');
        Route::post('/carousel/{carousel}/image/{image}/down', 'moveDown')->name('change_down');

    });

    Route::resource('thematic', ThematicController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy', 'create']);

    Route::controller(ThematicImageController::class)->name('thematic_image.')->group(function (){

        Route::get('/thematic/{thematic}/image', 'index')->name('index');
        Route::post('/thematic/{thematic}/image', 'store')->name('store');
        Route::delete('/thematic/{thematic}/image/{image}','destroy')->name('destroy');
        Route::post('/thematic/{thematic}/image/{image}/up', 'moveUp')->name('change_up');
        Route::post('/thematic/{thematic}/image/{image}/down', 'moveDown')->name('change_down');

    });

});

Route::get('logout', [AuthController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('logout');


Route::middleware('guest')->group(function () {

    Route::get('register', [RegisterUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisterUserController::class, 'store']);

    Route::get('login', [AuthController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthController::class, 'store']);

});
