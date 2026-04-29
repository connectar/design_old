<?php

use App\Http\Controllers\Admin\HomeNewLayoutController;
use Illuminate\Support\Facades\Route;

// Theme Two
Route::middleware(['web', 'locale'])->name('theme_two.')->group(function (): void {
    Route::get('/', [HomeNewLayoutController::class, 'index'])->name('home.main');
    Route::middleware('checkNetworkIP')->group(function () {
        Route::get('system/{system}', [HomeNewLayoutController::class, 'selectSystem'])->name('system');
        Route::get('register/{plan}', [HomeNewLayoutController::class, 'viewRegisterPage'])->name('home.register');
        Route::post('register/{plan}', [HomeNewLayoutController::class, 'register'])->name('home.register_store');
    });
});


/*

Route::name('new_home.')->group(function(){
    Route::get('home', [HomeNewLayoutController::class, 'index'])->name('home.main');
    Route::get('home/sys/{system}', [HomeNewLayoutController::class, 'selectSystem'])->name('system');
    Route::get('home/register/{plan}', [HomeNewLayoutController::class, 'viewRegisterPage'])->name('home.register');
    Route::post('home/register/{plan}', [HomeNewLayoutController::class, 'register'])->name('home.register_store');
});

*/
