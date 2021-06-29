<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});

Route::post('/login', 'App\Http\Controllers\Api\AuthController@login')->name('api.login');
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register')->name('api.register');

Route::post('/forgot-password', 'App\Http\Controllers\Api\ForgotPasswordController@sendResetLinkEmail')->name('api.forgot-password');
Route::post('/reset-password', 'App\Http\Controllers\Api\ResetPasswordController@reset')->name('api.reset-password');
