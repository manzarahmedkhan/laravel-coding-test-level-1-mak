<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\AdminLoginController;

Route::post('login', [AdminLoginController::class, 'login']);
Route::apiResource('events', 'EventController');
Route::post('events/active-events', 'EventController@activeEvents');


