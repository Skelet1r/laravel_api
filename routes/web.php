<?php

use App\Http\Controllers\WarehouseController;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('warehouses', [WarehouseController::class, 'warehouses'])->name('warehouses');
