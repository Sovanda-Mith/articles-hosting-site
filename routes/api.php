<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Article Routes
// Route::controller(ArticleController::class)->prefix('articles')->name('articles.')->group(function () {
//     Route::get('/', 'index')->name('index');
//     Route::post('/', 'store')->name('store');
//     Route::get('/{id}', 'show')->name('show');
//     Route::put('/{id}', 'update')->name('update');
//     Route::delete('/{id}', 'destroy')->name('destroy');
// });
//     {
// Article Routes - using apiResource
Route::apiResource('articles', ArticleController::class);

Route::controller(SettingController::class)->prefix('settings')->group(
    function () {
        Route::get('/blockedUser', 'blockedUsers');
        Route::get('/mutedUser', 'mutedUsers');
        Route::post('/notification', 'updateNotificationSettings');
        Route::get('/download', 'downloadUserData');
    }
);

Route::controller(CategoryController::class)->prefix('category')->group(
    function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    }
);

Route::controller(ArticleCategoryController::class)->prefix('articleCategory')->group(
    function () {
        Route::post('/', 'update');

    }
);

Route::controller(UploadController::class)->prefix('upload')->group(
    function () {
        Route::post('/cover', 'uploadCover');
    }
);
