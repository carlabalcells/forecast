<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersListController;

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

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//User 
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Edit Profile
Route::get('/edit-profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/edit-profile', [ProfileController::class, 'store'])->name('profile.store');

//Forecast
Route::get('/forecast/{location}', [ForecastController::class, 'index'])->name('forecast.index');
Route::post('/forecast', [ForecastController::class, 'store'])->name('forecast.show');
Route::get('/forecast/{location}/{day}', [ForecastController::class, 'detail'])->name('forecast.detail');


//Admin Backend
//Route::get('/admin', [UsersListController::class, 'index'])->name('admin');
Route::group(['middleware' => 'is.admin'], function () {
    Route::get('/admin', [UsersListController::class, 'index'])->name('admin');
});