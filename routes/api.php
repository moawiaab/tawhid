<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api', 'middleware' => ['auth:sanctum']], function () {
    Route::get('abilities', 'AbilitiesController@index');

    Route::resource('permissions', 'PermissionsApiController');
    Route::post('/permissions/delete-all','PermissionsApiController@destroyAll');
    Route::post('/permissions/add-all','PermissionsApiController@addAll');
    Route::put('/permissions/{item}/restore','PermissionsApiController@restore');
    Route::put('/permissions/{item}/delete-restore','PermissionsApiController@deleteRestore');
    Route::get('/permissions-export','PermissionsApiController@export');

    Route::get('/dashboard', 'DashboardApiController@index')->name('dashboard');

    Route::get('accounts','AccountApiController@index');
    Route::put('/accounts/{account}/toggle','AccountApiController@toggle')->name('account.toggle');

    // Roles
    Route::resource('roles', 'RolesApiController');
    Route::post('/roles/delete-all','RolesApiController@destroyAll');
    Route::put('/roles/{item}/restore','RolesApiController@restore');


    // Users
    Route::resource('/users', 'UsersApiController');
    Route::put('/users/{user}/toggle','UsersApiController@toggle')->name('user.toggle');
    Route::post('/users/delete-all','UsersApiController@destroyAll');
    Route::post('/users/add-all','UsersApiController@addAll');
    Route::put('/users/{item}/restore','UsersApiController@restore');
    Route::post('/users/password','UsersApiController@password')->name('users.password');
    Route::post('/users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');

    Route::get('/shops/data','UsersApiController@showData');

});
