<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthCountroller;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PlantController;
use App\Http\Controllers\API\ProductController;

Route::post('signup',[AuthCountroller::class,'signup']);
Route::post('login',[AuthCountroller::class,'login']);
Route::post('checkoutProcess',[OrderController::class,'checkoutProcess'])->middleware('auth:sanctum');
Route::post('checkoutProcessWithAddress',[OrderController::class,'checkoutProcessWithAddress'])->middleware('auth:sanctum');
Route::post('logout',[AuthCountroller::class,'logout'])->middleware('auth:sanctum');
Route::post('addToCart/{id}',[ProductController::class,'addToCart'])->middleware('auth:sanctum');
Route::post('addProduct',[ProductController::class,'addProduct']);
Route::post('addPlant',[PlantController::class,'addplant']);
