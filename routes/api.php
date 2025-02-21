<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;




Route::post('/login', [AuthController::class, 'login']);



Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('events', EventController::class);
    Route::apiResource('events.attendees', AttendeeController::class);
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout/all', [AuthController::class, 'logoutAll']);
});
