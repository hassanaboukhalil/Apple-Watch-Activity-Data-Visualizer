<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group(['prefix' => 'v1'], function () {
    // Route::group(["middleware" => "auth:api"], function () {
    //     Route::post('/uploadcsv', [ActivityController::class, 'upload']);
    // });

    Route::post('/uploadcsv', [ActivityController::class, 'upload']);

    // Unauthenticated routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup', [AuthController::class, 'signup']);
});
