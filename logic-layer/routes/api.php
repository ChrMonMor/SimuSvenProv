<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySubcategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TypeController;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('subcategories', SubcategoryController::class);
Route::apiResource('categories-subcategories', CategorySubcategoryController::class);
Route::apiResource('types', TypeController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('items', ItemController::class);

// testing
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

