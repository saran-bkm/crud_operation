<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers/export', [CustomerController::class, 'export']);

    Route::get('/items', [ItemController::class, 'index'])->name('items');
    Route::get('/items/add', [ItemController::class, 'add']);
    Route::post('/items/store', [ItemController::class, 'store']);
    Route::get('/items/edit/{id}', [ItemController::class, 'edit']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::post('/items/update', [ItemController::class, 'update']);
    Route::post('/items/bulk-upload', [ItemController::class, 'bulkUpload'])->name('items.bulk-upload');

});
