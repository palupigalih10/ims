<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function () {
    // Menu
    Route::controller(MenuController::class)->prefix('menu')->name('menu')->group(function () {
        Route::get('sidebar', 'sidebar')->name('.sidebar');
    });
    Route::resource('menu', MenuController::class)->except(['create', 'edit']);
});
