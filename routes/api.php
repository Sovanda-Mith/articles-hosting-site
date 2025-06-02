<?php

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

