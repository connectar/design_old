<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

// Theme One
Route::name('home.')->group(function (): void {
    Route::get('/', [HomeController::class, 'index'])->name('main');
    Route::get('system/{system}', [HomeController::class, 'selectSystem'])->name('system');
    Route::get('register/{plan}', [HomeController::class, 'viewRegisterPage'])->name('register');
    Route::post('register/{plan}', [HomeController::class, 'register'])->name('register_store');
});
