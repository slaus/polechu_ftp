<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Web\FormController;
use App\Http\Controllers\Web\LocalizationController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\TourController;
use App\Services\Localization\LocalizationService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('locale/{locale}', LocalizationController::class)->name('locale');

Route::view('/admin/{catchall?}', 'admin.index')
    ->where('catchall', '(.*)')
    ->middleware('auth:sanctum');

Route::get('login', [LoginController::class, 'index'])
    ->middleware('guest')
    ->name('login');
Route::post('login', [LoginController::class, 'store'])
    ->middleware('guest');
Route::get('logout', LogoutController::class)
    ->name('logout')
    ->middleware('auth:sanctum');

Route::group(['prefix' => (new LocalizationService(request()))->setLocale(), 'middleware' => ['redirect']], function () {

    Route::group(['prefix' => 'form', 'as' => 'form.'], function () {
        Route::post('feedback', [FormController::class, 'feedback'])->name('feedback');
        Route::post('contact', [FormController::class, 'contact'])->name('contact');
    });

    Route::get('/tours/{slug}', TourController::class)->name('tours');
    Route::get('/blog/{slug}', PostController::class)->name('post');
    Route::get('/{slug?}', PageController::class)->name('page');

});
