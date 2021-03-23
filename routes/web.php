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

Route::get('/admin', function () {
    return view('layouts.backend.auth.login');
})->name('admin.login');

Route::get('/admin-register', function () {
    return view('layouts.backend.auth.register');
})->name('admin.register');

Route::get('/dashboard', function () {
    return view('layouts.backend.dashboard');
});
