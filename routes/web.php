<?php

// use App\Http\Controllers\Api\UsersApiController;

use App\Http\Controllers\Api\DashboardApiController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
// Route::view('/home', 'layouts.app');
Route::redirect('/home', '/dashboard');

Route::get('/mytest', [DashboardApiController::class, 'index']);

Auth::routes();

Route::group([
    'middleware' => ['auth'],
], function () {
    Route::view('/{any?}', 'layouts.app')->name('dashboard')->where('any', '.*');
});
