<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\ColorController;
use App\Http\Controllers\backend\TermsController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\backend\DistrictController;
use App\Http\Controllers\backend\HowToBuyController;
use App\Http\Controllers\backend\SettingsController;
use App\Http\Controllers\Backend\WarehouseController;
use App\Http\Controllers\backend\MeasurementController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\ChildCategoryController;
use App\Http\Controllers\backend\PrivacypolicyController;
use App\Http\Controllers\backend\ShippingClassController;
use App\Http\Controllers\backend\DeliverychargeController;

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
    Route::get('staff-list', [AdminController::Class,'index'])->name('admin.list');
    Route::post('/admin-activity',[AdminController::Class,'adminActivity'])->name('admin.activity');
    Route::post('/admin-add',[AdminController::Class,'createAdmin'])->name('create.admin');
    Route::post('/admin-update',[AdminController::Class,'update'])->name('update.admin');

    //Warehouse Rotues
    Route::get('ware-house-list', [WarehouseController::Class,'index'])->name('warehouse.list');
    Route::post('/create-warehouse',[WarehouseController::Class,'store'])->name('create.warehouse');
    Route::post('/warehouse-update',[WarehouseController::Class,'update'])->name('update.warehouse');

    //Category Rotues
    Route::get('main-category-list', [CategoryController::Class,'index'])->name('main.category.list');
    Route::post('/create-main-category',[CategoryController::Class,'store'])->name('add.main.category');
    Route::post('/update-main-category',[CategoryController::Class,'update'])->name('update.main.category');
    Route::post('/main-category-activity',[CategoryController::Class,'activity'])->name('main.category.activity');

    //Sub Category Rotues
    Route::get('sub-category-list', [SubCategoryController::Class,'index'])->name('sub.category.list');
    Route::post('/main-category-by-warehouse',[SubCategoryController::Class,'mainCategoryByWarehouse'])->name('load.main.category');
    Route::post('/create-sub-category',[SubCategoryController::Class,'store'])->name('add.sub.category');
    Route::post('/update-sub-category',[SubCategoryController::Class,'update'])->name('update.sub.category');
    Route::post('/sub-category-activity',[SubCategoryController::Class,'activity'])->name('sub.category.activity');


    //Child Category Rotues
    Route::get('child-category-list', [ChildCategoryController::Class,'index'])->name('child.category.list');
    Route::post('/sub-category-by-id',[ChildCategoryController::Class,'subCategoryById'])->name('load.sub.category');
    Route::post('/create-child-category',[ChildCategoryController::Class,'store'])->name('add.child.category');
    Route::post('/update-child-category',[ChildCategoryController::Class,'update'])->name('update.child.category');
    Route::post('/child-category-activity',[ChildCategoryController::Class,'activity'])->name('child.category.activity');

    Route::post('/child-category-by-warehouse',[ChildCategoryController::Class,'getChildCategByWarehouse'])->name('load.child.category');
    Route::post('/all-category-by-child',[ChildCategoryController::Class,'getAllCategByChildCat'])->name('load.all.category');

    //Brand Routes
    Route::get('brand-list', [BrandController::Class,'index'])->name('brand.list');
    Route::post('/create-new-brand',[BrandController::Class,'store'])->name('add.brand');
    Route::post('/update-new-brand',[BrandController::Class,'update'])->name('update.brand');
    Route::post('/brand-activity',[BrandController::Class,'activity'])->name('brand.activity');

    //Slider Routes
    Route::get('slides-list', [SliderController::Class,'index'])->name('slider.list');
    Route::post('/create-new-slider',[SliderController::Class,'store'])->name('add.slider');
    Route::post('/update-new-slider',[SliderController::Class,'update'])->name('update.slider');
    Route::post('/slider-activity',[SliderController::Class,'activity'])->name('slider.activity');

    //About routes
    Route::get('/about-setup', [AboutController::Class, 'index'])->name('setup.about');
    Route::post('save/about', [AboutController::Class, 'store'])->name('about.save');

    //Privacy and Policy
    Route::get('/privacy-policy-setup', [PrivacypolicyController::Class, 'index'])->name('privacy.policy');
    Route::post('save/privacy-policy', [PrivacypolicyController::Class, 'store'])->name('privacy.save');

    //Terms and Conditions
    Route::get('/terms-and-conditions-setup', [TermsController::Class, 'index'])->name('terms.conditions');
    Route::post('save/terms-and-conditions', [TermsController::Class, 'store'])->name('terms.save');

    //How to Buy
    Route::get('/how-to-buy-setup', [HowToBuyController::Class, 'index'])->name('how.to.buy');
    Route::post('save/how-to-buy', [HowToBuyController::Class, 'store'])->name('buy.save');

    //Colors Route
    Route::get('/color-info', [ColorController::Class, 'index'])->name('color.list');
    Route::post('/create-new-color',[ColorController::Class,'store'])->name('add.color');
    Route::post('/update-color',[ColorController::Class,'update'])->name('update.color');
    Route::post('/update-color-activity',[ColorController::Class,'activity'])->name('color.activity');

    //Shipping Class Routes
    Route::get('/shipping-class-list', [ShippingClassController::Class, 'index'])->name('shipping.class');
    Route::post('/create-shipping-class',[ShippingClassController::Class,'store'])->name('add.shipping.class');
    Route::post('/update-shipping-class',[ShippingClassController::Class,'update'])->name('update.shipping.class');

    //District Routes
    Route::get('/state-setup', [DistrictController::Class, 'index'])->name('district.setup');
    Route::post('/create-state',[DistrictController::Class,'store'])->name('add.district');
    Route::post('/update-state',[DistrictController::Class,'update'])->name('update.state');


    //Delivery charge Routes
    Route::get('/delivery-charge-setup', [DeliverychargeController::Class, 'index'])->name('delivery.charge');
    Route::post('/district-find', [DeliverychargeController::Class, 'district_find'])->name('district.find');
    Route::post('/store-delivery-charge',[DeliverychargeController::Class,'store'])->name('deliverychargeadd.store');

    //Colors Route
    Route::get('/measurement-view', [MeasurementController::Class, 'index'])->name('measurement.list');
    Route::post('/create-measurement',[MeasurementController::Class,'store'])->name('add.measurement');
    Route::post('/update-measurement',[MeasurementController::Class,'update'])->name('update.measurement');


    //Products Routes
    Route::get('product-add-form', [ProductController::Class,'index'])->name('product.add');
    Route::get('product-list', [ProductController::Class,'product_list_index'])->name('product.list');
    Route::post('/add-product',[ProductController::Class,'store'])->name('add.product');
    Route::post('/update-product-activity',[ProductController::Class,'activity'])->name('product.activity');
    Route::post('/edit-product',[ProductController::Class,'getProductById'])->name('edit.product');
    Route::post('/update-product',[ProductController::Class,'update'])->name('update.product');


    //Coupon Routes
    Route::get('coupon-list', [CouponController::Class,'index'])->name('coupon.list');
    Route::post('/coupon-store',[CouponController::Class,'store'])->name('coupon.store');

    //Settings
    Route::get('setup-website-info', [SettingsController::Class, 'index'])->name('setup.settings');
    Route::post('save-settings', [SettingsController::Class, 'store'])->name('settings.save');

});







