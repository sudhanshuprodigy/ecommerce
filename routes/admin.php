<?php

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');
    });


    Route::group(['prefix'  =>   'brands'], function () {

        Route::get('/', 'Admin\BrandController@index')->name('admin.brands.index');
        Route::get('/create', 'Admin\BrandController@create')->name('admin.brands.create');
        Route::post('/store', 'Admin\BrandController@store')->name('admin.brands.store');
        Route::get('/{id}/edit', 'Admin\BrandController@edit')->name('admin.brands.edit');
        Route::post('/update', 'Admin\BrandController@update')->name('admin.brands.update');
        Route::get('/{id}/delete', 'Admin\BrandController@delete')->name('admin.brands.delete');
    });

    Route::group(['prefix'  =>   'categories'], function () {

        Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
        Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
        Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
        Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
        Route::post('/update', 'Admin\CategoryController@update')->name('admin.categories.update');
        Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');
    });

    Route::group(['prefix' => 'products'], function () {

        Route::get('/', 'Admin\ProductController@index')->name('admin.products.index');
        Route::get('/create', 'Admin\ProductController@create')->name('admin.products.create');
        Route::post('/store', 'Admin\ProductController@store')->name('admin.products.store');
        Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('admin.products.edit');
        Route::post('/update', 'Admin\ProductController@update')->name('admin.products.update');
        Route::post('images/upload', 'Admin\ProductImageController@upload')->name('admin.products.images.upload');
        Route::get('images/{id}/delete', 'Admin\ProductImageController@delete')->name('admin.products.images.delete');
        // Load attributes on the page load
        Route::get('attributes/load', 'Admin\ProductAttributeController@loadAttributes');
        // Load product attributes on the page load
        Route::post('attributes', 'Admin\ProductAttributeController@productAttributes');
        // Load option values for a attribute
        Route::post('attributes/values', 'Admin\ProductAttributeController@loadValues');
        // Add product attribute to the current product
        Route::post('attributes/add', 'Admin\ProductAttributeController@addAttribute');
        // Delete product attribute from the current product
        Route::post('attributes/delete', 'Admin\ProductAttributeController@deleteAttribute');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', 'Admin\OrderController@index')->name('admin.orders.index');
        Route::get('/{order}/show', 'Admin\OrderController@show')->name('admin.orders.show');
    });
});
