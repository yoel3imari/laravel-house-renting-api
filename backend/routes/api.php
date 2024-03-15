<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HouseController;
use App\Http\Controllers\Api\V1\RentingController;
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

Route::namespace('Api\V1')->group(function () {

    Route::prefix("auth")->group(function () {
        // Route::get("/test", [AuthController::class, "test"]);
        Route::post("/register", [AuthController::class, "register"]);
        Route::post("/login", [AuthController::class, "login"]);
        Route::group(['middleware' => "auth:sanctum"], function () {
            Route::get("/verify_token", [AuthController::class, "verify_token"]);
            Route::get("/logout", [AuthController::class, "logout"]);
        });
    });

    Route::middleware("auth:sanctum")->group(function () {
        Route::apiResource('/houses', HouseController::class);
        Route::apiResource('/rentings', RentingController::class);
    });


});
