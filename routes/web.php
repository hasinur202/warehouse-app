<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Backend\AdminController;

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
    // Session::flush();
    return view('welcome');
})->name('home');



Route::group(['middleware' => 'guest'], function () {

    Route::get('/admin', function () {
        return view('layouts.backend.auth.login');
    })->name('admin.login');

    Route::get('/admin-register', function () {
        return view('layouts.backend.auth.register');
    })->name('admin.register');

    Route::post('/admin-store',[LoginController::Class,'store'])->name('admin.store');
    Route::post('/admin-login',[LoginController::Class,'login'])->name('attempt.adminLogin');
});



Route::group(['middleware' => ['auth','admin.role']], function () {
    Route::get('/logout',[LoginController::Class,'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('layouts.backend.dashboard');
    })->name('dashboard');

    Route::get('admin-list', [AdminController::Class,'index'])->name('admin.list');

});







