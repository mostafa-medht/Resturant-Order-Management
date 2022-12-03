<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function (){

    // Ingredients routes
    Route::group(['prefix' => 'ingredients'], function (){
        Route::resource('', IngredientController::class)->only(['index', 'store']);
        Route::post('/charge-ingredients', [IngredientController::class, 'chargeIngredient']);
        Route::get('/get-ingredient', [IngredientController::class, 'show']);
    });

    // Product routes
    Route::group(['prefix' => 'products'], function (){
        Route::resource('', ProductController::class)->only(['index', 'store']);
         Route::get('/get-product', [ProductController::class, 'show']);
    });

    // Ingredients routes
    Route::group(['prefix' => 'orders'], function (){
        Route::resource('', OrderController::class)->only(['index', 'store']);
        Route::get('/get-order', [OrderController::class, 'show']);
    });

});
