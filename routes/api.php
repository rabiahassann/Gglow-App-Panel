<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', [CategoryController::class, 'getcategories'])->name('front.categories');  
Route::get('/subcategories/{id}', [CategoryController::class, 'getsubcategories'])->name('front.subcategories');  
Route::get('/listing/{id?}/{type?}', [CategoryController::class, 'getfilterproducts'])->name('filter.products');





