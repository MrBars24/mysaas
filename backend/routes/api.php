<?php

use App\Http\Controllers\Api\Identity\ClientLoginController;
use App\Http\Controllers\Api\Identity\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::post('/login', LoginController::class);

Route::prefix('v1')->group(function () {
    Route::post('/auth/login', LoginController::class)->name('api.v1.auth.login');

    // Client Login (Mobile Phone)
    Route::post('/auth/client/login', ClientLoginController::class)->name('api.v1.auth.client.login');
});