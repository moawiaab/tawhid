<?php

use App\Http\Controllers\Api\AbilitiesController;
use App\Http\Controllers\Api\AccountApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\PermissionsApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\RolesApiController;
use App\Http\Controllers\Api\StoreApiController;
use App\Http\Controllers\Api\UsersApiController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('abilities', [AbilitiesController::class, 'index']);

    Route::resource('permissions', PermissionsApiController::class);
    Route::get('accounts', [AccountApiController::class, 'index']);
    Route::put('/accounts/{account}/toggle', [AccountApiController::class, 'toggle'])->name('account.toggle');

    // Roles
    Route::resource('roles', RolesApiController::class);
    Route::resource('categories', CategoryApiController::class);
    Route::resource('stores', StoreApiController::class);
    Route::resource('products', ProductApiController::class);

    // Users
    Route::resource('/users', UsersApiController::class);
    Route::put('/users/{user}/toggle', [UsersApiController::class, 'toggle'])->name('user.toggle');
    Route::get('/shops/data', [UsersApiController::class, 'showData']);

});
