<?php

use App\Http\Controllers\Api\AbilitiesController;
use App\Http\Controllers\Api\RolesApiController;
use App\Http\Controllers\Api\UsersApiController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('abilities', [AbilitiesController::class, 'index']);

    Route::resource('permissions', 'PermissionsApiController');

    // Roles
    Route::resource('roles', RolesApiController::class);

    // Users
    Route::resource('/users', UsersApiController::class);
    Route::get('/shops/data', [UsersApiController::class, 'showData']);

});
