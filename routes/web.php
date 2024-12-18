<?php

use App\Http\Controllers\IncomesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WarehouseController;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::controller(WarehouseController::class)->group(function () {
    Route::get('/warehouses', 'warehouses')->name('warehouses');
    Route::get('/warehouses_pagination', 'warehouses_pagination')->name('warehouses_pagination');
});

Route::controller(OrderController::class)->group(function () {
    Route::get('/orders', 'orders')->name('orders');
    Route::get('/orders_pagination', 'orders_pagination')->name('orders_pagination');
});

Route::controller(IncomesController::class)->group(function ()  {
    Route::get('/incomes', 'incomes')->name('incomes');
    Route::get('/incomes_pagination', 'incomes_pagination')->name('incomes_pagination');
});
