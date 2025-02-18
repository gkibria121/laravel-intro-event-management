<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;




Route::apiResource('events', EventController::class);
Route::apiResource('events.attendees', AttendeeController::class);

Route::fallback(fn() => response()->json([
    'message' => "Route not found"
], Response::HTTP_NOT_FOUND));
