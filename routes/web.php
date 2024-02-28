<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard/analytic', function () {
    return view('dashboards.v_all_wh');
});

Route::get('/dashboard/view-another', function () {
    return view('dashboards.v_single_wh');
});

Route::get('/product/import', function () {
    return view('products.imports.v_import_by_lot_number');
});


// Test
Route::get('/product/export', function () {
    return view('products.exports.v_export_by_sale_number');
});

Route::get('/product/history', function () {
    return view('products.historys.v_product_history');
});

Route::get('/warehouse/add-space', function () {
    return view('warehouses.v_add_wh_space');
});

Route::get('/warehouse/add-wh', function () {
    return view('warehouses.v_add_more_wh');
});

Route::get('/management', function () {
    return view('users.v_user_management');
});
