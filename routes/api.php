<?php

use App\Http\Controllers\Api\AssignmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\VolunteerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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




Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::apiResource('/places', PlaceController::class);
    Route::apiResource('/tasks', TaskController::class);
    Route::apiResource('/volunteers', VolunteerController::class);
    Route::apiResource('/assignments',AssignmentController::class);
});
