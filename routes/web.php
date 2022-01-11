<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('attendee', App\Http\Controllers\AttendeeController::class)->only('show', 'edit', 'update');

Route::resource('event', App\Http\Controllers\EventController::class);

Route::resource('user', App\Http\Controllers\UserController::class);

Route::resource('photo', App\Http\Controllers\PhotoController::class);
