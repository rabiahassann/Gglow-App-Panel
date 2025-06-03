<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
})->name('login');

// login user
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/get-subcategories/{id}', [CategoryController::class, 'getSubcategories']);

// auth routes
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    //categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/category-create', [CategoryController::class, 'addCategory'])->name('categories.add');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('categories.create');
    Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/destroy-category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    

    //Subcategories
    Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategory-create', [SubCategoryController::class, 'addCategory'])->name('subcategory.add');
    Route::post('/add-subcategory', [SubCategoryController::class, 'store'])->name('subcategory.create');
    Route::get('/subcategory/{id}/edit', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::delete('/subcategory/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
    Route::put('/subcategories/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');

    // products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product-add', [ProductController::class, 'create'])->name('product.add');
    Route::post('/product-add', [ProductController::class, 'store'])->name('admin.store-product');
    Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('admin.product-edit');
    Route::put('/product-update/{id}', [ProductController::class, 'update'])->name('admin.product-update');
    Route::get('/product-destroy/{id}', [ProductController::class, 'destroy'])->name('admin.product-destroy');

    // logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');


});  







