<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\backend\HomeController;

/*
|----------------------------------------------------------------
|	Admin Login Routes
|----------------------------------------------------------------
 */
Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminLoginController::class, 'login'])->name('submit.login');
Route::get('register', [AdminRegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AdminRegisterController::class, 'register'])->name('submit.register');
Route::view('/forgot', 'admin-auth.passwords.email')->name('forgot');
Route::get('/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('reset');
Route::post('/forgot', [AdminForgotPasswordController::class,'sendResetLinkEmail'])->name('forgot.submit');
Route::post('/reset', [AdminResetPasswordController::class,'reset'])->name('password.reset');
/*
|----------------------------------------------------------------
|	Admin Routes
|----------------------------------------------------------------
 */
Route::group(['middleware' => ['auth:admin']], function () {

    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('user/profile', [HomeController::class, 'profile'])->name('user.profile');
    Route::get('user/edit/{id}', [HomeController::class, 'editProfile'])->name('user.edit');

});
