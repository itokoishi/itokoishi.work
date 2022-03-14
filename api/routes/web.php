<?php

use App\Http\Controllers\CalenderController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShiftController;
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

Route::resource('/login', LoginController::class);
Route::resource('/log-out', LogoutController::class);

Route::get('/image/staff/{param}', [ImageController::class, 'staff']);


Route::middleware(['admin_auth'])->group(function () {
    Route::resource('/', IndexController::class);
    Route::resource('/calender', CalenderController::class);
    Route::resource('/shift', ShiftController::class);
    Route::resource('/staff/register', \App\Http\Controllers\Staff\RegisterController::class);
    Route::resource('/staff/photo', \App\Http\Controllers\Staff\PhotoController::class);
});
