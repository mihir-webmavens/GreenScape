<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('frontend.index');
})->name('index');

Route::fallback(function () {
    return view('frontend.404');
});

Route::view('/shop','frontend.shop')->name('shop');
Route::view('/login','frontend.login')->name('login');
Route::post('/login',[UserController::class,'LoginProcess'])->name('loginProcess');
Route::view('/register','frontend.register')->name('register');
Route::post('/register',[UserController::class,'registerProcess'])->name('registerProcess');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::get('/mail',[UserController::class,'mail'])->name('mail');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function(){
    Route::get('details',[UserController::class,'details'])->name('details');
    Route::post('UpdateDetails',[UserController::class,'upddate_profile'])->name('upddate_profile');
    Route::view('/about','frontend.about')->name('about');
    Route::view('/contact','frontend.contact')->name('contact');
    Route::view('/feature','frontend.feature')->name('feature');
    Route::view('/service','frontend.service')->name('service');
    Route::view('/project','frontend.project')->name('project');
});
