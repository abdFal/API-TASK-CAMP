<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampBenefitController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\EnrollController;
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

Route::post('/camps/login', [AuthController::class, 'login']);
Route::get('/camps/logout', [AuthController::class, 'logout']);
Route::get('/camps/me', [AuthController::class, 'me']);
Route::get('/camps', [CampController::class, 'index']);
Route::get('/camps/{id}', [CampController::class, 'show']);
Route::post('/camps/{id}/enroll', [EnrollController::class, 'enroll']);
Route::post('/camps', [CampController::class, 'create']);
Route::patch('/camps/{id}', [CampController::class, 'edit']);
Route::delete('/camps/{id}', [CampController::class, 'destroy']);

Route::post('/camps/benefits', [CampBenefitController::class, 'store']);
Route::patch('/camps/benefits/{id}', [CampBenefitController::class, 'edit']);
Route::delete('/camps/benefits/{id}', [CampBenefitController::class, 'delete']);
