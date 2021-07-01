<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["middleware" => "auth:api"], function () {
    Route::get('/me', 'App\Http\Controllers\Api\UsersController@me')->name('api.me');
    Route::post('/change-password', 'App\Http\Controllers\Api\UsersController@changePassword')->name('api.change-password');
    Route::post('/change-details', 'App\Http\Controllers\Api\UsersController@changeDetails')->name('api.change-details');
});

Route::post('/login', 'App\Http\Controllers\Api\AuthController@login')->name('api.login');
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register')->name('api.register');

Route::post('/forgot-password', 'App\Http\Controllers\Api\ForgotPasswordController@sendResetLinkEmail')->name('api.forgot-password');
Route::post('/reset-password', 'App\Http\Controllers\Api\ResetPasswordController@reset')->name('api.reset-password');
