<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OpnameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/fetch-transactions-by-date', [HomeController::class, 'fetchTransactionsByDate'])->name('fetch-transactions-by-date');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('transaction', TransactionController::class);
Route::resource('stock', StockController::class);
Route::get('/stockshowbyitem', [StockController::class, 'showByItem'])->name('stock.showbyitem');
Route::resource('item', ItemController::class);
Route::resource('report', ReportController::class);
Route::resource('cart', CartController::class);
Route::delete('clear/cart', [CartController::class, 'clear'])->name('cart.clear');
Route::resource('user', UserController::class);
Route::resource('opname', OpnameController::class);

Route::get('/transaction/{transaction}/receipt', [TransactionController::class, 'receipt'])
    ->name('transaction.receipt');
