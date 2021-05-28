<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\LoginController;
use App\Http\Controllers\API\v1\RegisterController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\CategoryController;
use App\Http\Controllers\API\v1\OrderController;
use App\Http\Controllers\API\v1\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// login controller
Route::post('/v1/login', [LoginController::class, 'login']);
Route::middleware('auth:api')->post('/v1/logout', [LoginController::class,'logout']);

// register controller
Route::post('/v1/register', [RegisterController::class, 'register']);

// user Controller
Route::middleware('auth:api')->get('/v1/show', [UserController::class,'show']);
Route::middleware('auth:api')->post('/v1/add', [UserController::class,'add']);
Route::middleware('auth:api')->post('/v1/update', [UserController::class,'update']);

// category controller
Route::middleware('auth:api')->get('v1/category', [CategoryController::class, 'index']);

// product controller
Route::middleware('auth:api')->get('/v1/products', [ProductController::class, 'index']);
Route::middleware('auth:api')->get('/v1/products/{product}', [ProductController::class, 'show']);
Route::middleware('auth:api')->get('/v1/products/searchByCategory/{category}', [ProductController::class, 'searchByCategory']);
Route::middleware('auth:api')->post('/v1/products/searchByKey', [ProductController::class, 'searchByKey']);

// cart Controller
Route::middleware('auth:api')->post('/v1/addCart', [OrderController::class, 'addcart']);
Route::middleware('auth:api')->get('/v1/editCart', [OrderController::class, 'editCart']);
Route::middleware('auth:api')->get('/v1/showCart', [OrderController::class, 'showCart']);
Route::middleware('auth:api')->get('/v1/deleteCart', [OrderController::class, 'deleteCart']);

//order controller
Route::middleware('auth:api')->post('/v1/checkout', [OrderController::class, 'checkout']);
Route::middleware('auth:api')->get('/v1/showOrder', [OrderController::class, 'showOrder']);
Route::middleware('auth:api')->get('/v1/history', [OrderController::class, 'history']);
