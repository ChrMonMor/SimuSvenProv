<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySubcategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TypeController;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('subcategories', SubcategoryController::class);
Route::apiResource('categories-subcategories', CategorySubcategoryController::class);
Route::apiResource('types', TypeController::class);
Route::apiResource('items', ItemController::class);
Route::apiResource('platforms', PlatformController::class);

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class,'logout']);
});

// testing
Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

