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
    Route::get('/list-users', 'App\Http\Controllers\Api\UsersController@index')->name('api.index');
    Route::get('/service-users', 'App\Http\Controllers\Api\UsersController@allUsers')->name('api.service-users');
    Route::post('/switch-roles', 'App\Http\Controllers\Api\SwitchRoleController@switchRole')->name('api.switchRole');
    Route::get('/me', 'App\Http\Controllers\Api\UsersController@me')->name('api.me');
    Route::post('/change-password', 'App\Http\Controllers\Api\UsersController@changePassword')->name('api.change-password');
    Route::post('/change-details', 'App\Http\Controllers\Api\UsersController@changeDetails')->name('api.change-details');
    Route::get('/list-orders', 'App\Http\Controllers\Api\CustomerOrdersController@index')->name('api.list-orders');

    //Customer Class
    Route::post('/import-customers', 'App\Http\Controllers\Api\CustomersController@import')->name('api.import-customers');
    Route::get('/list-customers', 'App\Http\Controllers\Api\CustomersController@index')->name('api.list-customers');
    Route::get('/get-costumer/{id}', 'App\Http\Controllers\Api\CustomersController@showById')->name('api.get-costumer');
    Route::post('/create-customer', 'App\Http\Controllers\Api\CustomersController@store')->name('api.create-costumer');
    Route::post('/update-customer', 'App\Http\Controllers\Api\CustomersController@changeDetails')->name('api.update-customer');
    Route::post('/delete-customer/{id}', 'App\Http\Controllers\Api\CustomersController@destroy')->name('api.delete-customer');

    //Service Class
    Route::get('/list-services', 'App\Http\Controllers\Api\ServiceOrdersController@index')->name('api-list-services');
    Route::post('/create-service', 'App\Http\Controllers\Api\ServiceOrdersController@store')->name('api.create-service');
    Route::get('/show-service/{id}', 'App\Http\Controllers\Api\ServiceOrdersController@show')->name('api.show-service');
    Route::post('/update-service', 'App\Http\Controllers\Api\ServiceOrdersController@updateServiceDetails')->name('api.update-service');
    Route::post('/delete-service/{id}', 'App\Http\Controllers\Api\ServiceOrdersController@destroy')->name('api.delete-service');


    //Projects
    Route::get('/list-projects', 'App\Http\Controllers\Api\ProjectsController@index')->name('api.list-projects');

    //Profile
    Route::get('/count/{user}', 'App\Http\Controllers\Api\ProfileController@index')->name('api-count');

    //Contacts
    Route::get('/list-contacts', 'App\Http\Controllers\Api\ContactsController@index')->name('api.list-contacts');
    Route::get('/list-contactsId/{id}', 'App\Http\Controllers\Api\ContactsController@showById')->name('api.list-contactsId');
    Route::post('/delete-contact/{id}', 'App\Http\Controllers\Api\ContactsController@destroy')->name('api.delete-contact');
    Route::post('/create-contact', 'App\Http\Controllers\Api\ContactsController@store')->name('api.create-contact');
    Route::post('/update-contact', 'App\Http\Controllers\Api\ContactsController@changeDetails')->name('api.update-contact');
});

Route::post('/login', 'App\Http\Controllers\Api\AuthController@login')->name('api.login');
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register')->name('api.register');

Route::post('/forgot-password', 'App\Http\Controllers\Api\ForgotPasswordController@sendResetLinkEmail')->name('api.forgot-password');
Route::post('/reset-password', 'App\Http\Controllers\Api\ResetPasswordController@reset')->name('api.reset-password');


//CustomerOrdersController
Route::post('/import-orders', 'App\Http\Controllers\Api\CustomerOrdersController@import')->name('api.import-orders');


Route::post('/set-order', 'App\Http\Controllers\Api\SetServiceOrderController@store')->name('api.set-order');
Route::get('/constants', 'App\Http\Controllers\Api\ConstantsController@index')->name('api.index');
