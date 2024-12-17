<?php

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
