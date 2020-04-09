<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area to product package
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::resource('/attributeSet', 'Tir\Store\Attribute\Controllers\AdminAttributeSetController');
        Route::resource('/attribute', 'Tir\Store\Attribute\Controllers\AdminAttributeController');
        Route::resource('/attributeValue', 'Tir\Store\Attribute\Controllers\AdminAttributeValueController');
    });

});