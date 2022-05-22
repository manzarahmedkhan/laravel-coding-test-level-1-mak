<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;


Route::apiResource('events', 'EventController');
Route::post('events/active-events', 'EventController@activeEvents');


