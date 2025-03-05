<?php

use App\Http\Controllers\admin\indexController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebinarController;

Route::get('/', function () {
    return view('frontend.index');
})->name('index');

Route::fallback(function () {
    return view('frontend.404');
});

Route::get('/shop', [ProductController::class, 'shopShow'])->name('shop');
Route::view('/login', 'frontend.login')->name('login');
Route::post('/login', [UserController::class, 'LoginProcess'])->name('loginProcess');
Route::view('/register', 'frontend.register')->name('register');
Route::post('/register', [UserController::class, 'registerProcess'])->name('registerProcess');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/mail', [UserController::class, 'mail'])->name('mail');
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::middleware('auth')->group(function () {
    Route::get('details', [UserController::class, 'details'])->name('details');
    Route::post('UpdateDetails', [UserController::class, 'upddate_profile'])->name('upddate_profile');
    Route::view('/about', 'frontend.about')->name('about');
    Route::view('/contact', 'frontend.contact')->name('contact');
    Route::view('/feature', 'frontend.feature')->name('feature');
    Route::view('/service', 'frontend.service')->name('service');
    Route::view('/project', 'frontend.project')->name('project');
    Route::post('/addToCart', [ProductController::class, 'addToCart'])->name('addToCart');
    Route::get('/shop-single/{id}', [ProductController::class, 'shopSingleShow'])->name('shopSingleShow');
    Route::get('cart', [ProductController::class, 'cart'])->name('cart');
    Route::post('cart/remove', [ProductController::class, 'cartItemRemove'])->name('cart.remove');
    Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('checkoutProcess', [OrderController::class, 'checkoutProcess'])->name('checkoutProcess');
    Route::post('checkout', [OrderController::class, 'checkoutProcessWithAddress'])->name('checkoutProcessWithAddress');
    Route::get('dashboard', [indexController::class, 'index'])->name('dashboard');
    Route::get('order',  [OrderController::class, 'UserOrders'])->name('Order');
    Route::get('Order-details/{id}', [OrderController::class, 'UserOrdersDetails'])->name('order.details');
    Route::get('Add-New-Plant', [PlantController::class, 'AddNewPlant'])->name('addnewplant');
    Route::post('Insert-New-Plant', [PlantController::class, 'InsertNewPlant'])->name('InsertNewPlant');
    Route::get('Edit-Plant/{id}', [PlantController::class, 'editPlant'])->name('editPlant');
    Route::post('Delete-Plant/{id}', [PlantController::class, 'deletePlant'])->name('deletePlant');
    Route::get('Webinar', [WebinarController::class, 'show'])->name('webinar');

  Route::get('plant',[PlantController::class,'show'])->name('plant');

    Route::prefix(prefix: 'admin')->group(function () {
        Route::get('UserList', [UserController::class, 'show'])->name('admin.userlist');
        Route::get('AdminUserList', [UserController::class, 'AdminUsers'])->name('admin.adminuserlist');
        Route::get('ProductList', [ProductController::class, 'productlist'])->name('admin.productlist');
        Route::get('OrderList', [OrderController::class, 'orderlist'])->name('admin.orderlist');
    });
});




















// TETING...
Route::view('test', 'Testing');
Route::post('test', [UserController::class,'test'])->name('test');
