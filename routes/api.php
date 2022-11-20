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
    Route::post('/permissions/delete-all', [PermissionsApiController::class,'destroyAll']);
    Route::post('/permissions/add-all', [PermissionsApiController::class,'addAll']);
    Route::put('/permissions/{item}/restore', [PermissionsApiController::class,'restore']);
    Route::put('/permissions/{item}/delete-restore', [PermissionsApiController::class,'deleteRestore']);
    Route::get('/permissions-export', [PermissionsApiController::class, 'export']);

    Route::get('accounts', [AccountApiController::class, 'index']);
    Route::put('/accounts/{account}/toggle', [AccountApiController::class, 'toggle'])->name('account.toggle');

    // Roles
    Route::resource('roles', RolesApiController::class);
    Route::post('/roles/delete-all', [RolesApiController::class,'destroyAll']);
    Route::put('/roles/{item}/restore', [RolesApiController::class,'restore']);

    Route::resource('categories', CategoryApiController::class);
    Route::post('/categories/delete-all', [CategoryApiController::class,'destroyAll']);
    Route::post('/categories/add-all', [CategoryApiController::class,'addAll']);
    Route::put('/categories/{item}/restore', [CategoryApiController::class,'restore']);

    Route::resource('stores', StoreApiController::class);
    Route::post('/stores/delete-all', [StoreApiController::class,'destroyAll']);
    Route::post('/stores/add-all', [StoreApiController::class,'addAll']);
    Route::put('/stores/{item}/restore', [StoreApiController::class,'restore']);

    Route::resource('products', ProductApiController::class);
    Route::post('/products/delete-all', [ProductApiController::class,'destroyAll']);
    Route::post('/products/add-all', [ProductApiController::class,'addAll']);
    Route::put('/products/{item}/restore', [ProductApiController::class,'restore']);

    // Users
    Route::resource('/users', UsersApiController::class);
    Route::put('/users/{user}/toggle', [UsersApiController::class, 'toggle'])->name('user.toggle');
    Route::post('/users/delete-all', [UsersApiController::class,'destroyAll']);
    Route::post('/users/add-all', [UsersApiController::class,'addAll']);
    Route::put('/users/{item}/restore', [UsersApiController::class,'restore']);
    Route::post('/users/password', [UsersApiController::class, 'password'])->name('users.password');

    Route::get('/shops/data', [UsersApiController::class, 'showData']);

});
