<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MenuController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\SearchTourController;
use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\TourController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function() {

    Route::group(['prefix' => 'tours'], function () {
        Route::get('countries', [SearchTourController::class, 'countries']);
        Route::get('towns', [SearchTourController::class, 'towns']);
        Route::get('options', [SearchTourController::class, 'options']);
        Route::get('tours', [SearchTourController::class, 'tours']);
        Route::post('order', [SearchTourController::class, 'order']);
    });

    Route::group(['middleware' => 'auth:sanctum'], function() {

        Route::put('menus/rebuild', [MenuController::class, 'rebuild'])->name('menus.rebuild');
        Route::apiResource('menus', MenuController::class);
        Route::get('pages/list', [PageController::class, 'list']);
        Route::apiResource('pages', PageController::class);
        Route::apiResource('tours', TourController::class);
        Route::apiResource('posts/tags', TagController::class)->only(['index']);
        Route::apiResource('posts', PostController::class);
        Route::get('user', [AuthController::class, 'user']);

        Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
            Route::get('{group}', [SettingController::class, 'index'])->name('index');
            Route::post('{group}', [SettingController::class, 'store'])->name('store');
        });

    });

});
