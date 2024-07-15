<?php

Route::group([
        'prefix' => 'jwt',
    ], static function () {

    Route::post('login', \Prhost\JWTAuth\Http\Controllers\AuthController::class);
    Route::post('refresh', \Prhost\JWTAuth\Http\Controllers\RefreshController::class);
    Route::post('register', \Prhost\JWTAuth\Http\Controllers\RegistrationController::class);
    Route::post('activate', \Prhost\JWTAuth\Http\Controllers\ActivationController::class);
});
