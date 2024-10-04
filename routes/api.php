<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MasterDataController;
use App\Http\Controllers\Api\TransactionController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware(middleware: 'auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

    // Master Data //
    Route::get('items', [MasterDataController::class, 'getItems']);
    Route::get('item-types', [MasterDataController::class, 'getItemTypes']);
    Route::get('users', [MasterDataController::class, 'getUsers']);
    Route::post('items', [MasterDataController::class, 'createItem'])->middleware('auth:api');
    Route::post('item-types', [MasterDataController::class, 'createItemType'])->middleware('auth:api');

    // Transaksi //
    Route::post('transactions', [TransactionController::class, 'createTransaction'])->middleware('auth:api');
    Route::get('transactions', [TransactionController::class, 'listTransactions'])->middleware('auth:api');
    Route::get('transactions/{id}', [TransactionController::class, 'getTransactionDetails'])->middleware('auth:api');
});
