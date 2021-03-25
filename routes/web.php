<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\WarehouseController;

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

    //Admin Routes
    Route::get('admin-list', [AdminController::Class,'index'])->name('admin.list');
    Route::post('/admin-activity',[AdminController::Class,'adminActivity'])->name('admin.activity');
    Route::post('/admin-add',[AdminController::Class,'createAdmin'])->name('create.admin');
    Route::post('/admin-update',[AdminController::Class,'update'])->name('update.admin');

    //Warehouse Rotues
    Route::get('ware-house-list', [WarehouseController::Class,'index'])->name('warehouse.list');
    Route::post('/create-warehouse',[WarehouseController::Class,'store'])->name('create.warehouse');
    Route::post('/warehouse-update',[WarehouseController::Class,'update'])->name('update.warehouse');

    //Category Rotues
    Route::get('main-category-list', [CategoryController::Class,'index'])->name('main.category.list');
    Route::post('/create-main-category',[CategoryController::Class,'storeMainCategory'])->name('add.main.category');
    Route::post('/update-main-category',[CategoryController::Class,'updateMainCategory'])->name('update.main.category');
    Route::post('/main-category-activity',[CategoryController::Class,'mainCategoryActivity'])->name('main.category.activity');

    //Sub Category Rotues
    Route::get('sub-category-list', [CategoryController::Class,'sub_index'])->name('sub.category.list');
    Route::post('/main-category-by-warehouse',[CategoryController::Class,'mainCategoryByWarehouse'])->name('load.main.category');
    Route::post('/create-sub-category',[CategoryController::Class,'storeSubCategory'])->name('add.sub.category');
    // Route::post('/update-main-category',[CategoryController::Class,'updateMainCategory'])->name('update.main.category');
    // Route::post('/main-category-activity',[CategoryController::Class,'mainCategoryActivity'])->name('main.category.activity');


});







