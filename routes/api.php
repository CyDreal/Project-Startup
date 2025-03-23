<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\CrewAssignmentController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\RouteController;
use App\Http\Controllers\Api\SeatConfigurationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/booking', BookingController::class);
Route::resource('/bus', BusController::class);
Route::resource('/crew_assignment', CrewAssignmentController::class);
Route::resource('/payment', PaymentController::class);
Route::resource('/review', ReviewController::class);
Route::resource('/route', RouteController::class);
Route::resource('/seat_configuration', SeatConfigurationController::class);
Route::get('/user/detail', [UserController::class, 'detail'])->middleware('auth:sanctum');

Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);
