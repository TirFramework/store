<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area to product package
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::resource('/product', 'Tir\Store\Controllers\AdminProductController');
        Route::resource('/productDescription', 'Tir\Store\Controllers\AdminProductDescriptionController');

        Route::resource('/category', 'Tir\Store\Controllers\AdminCategoryController');
    });

});

