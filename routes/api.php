<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "api" middleware group. Make something great!
 * |
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('item', ItemController::class);
// Route::apiResource('transaction', TransactionController::class);
// Route::apiResource('transactiondetail', TransactionDetailController::class);
// Route::apiResource('stock', StockController::class);
// Route::apiResource('stock', StockController::class);

// Route::apiResource('user', UserController::class);

// Route::apiResource('opname', OpnameController::class);

// Route::apiResource('itemunit', ItemUnitController::class);
