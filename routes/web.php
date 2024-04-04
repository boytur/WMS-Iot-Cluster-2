<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Products\Inbounds\InboundIndex;
use App\Http\Controllers\Products\Outbounds\OutboundIndex;
use App\Http\Controllers\Products\Managements\ProductManagementIndex;
use App\Http\Controllers\Users\Profile;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\Users\UserManagementIndex;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// เส้นทางที่ไม่ต้องการการยืนยันตน
Route::get('/login', [AuthController::class, 'login_index']);
Route::post('/login', [AuthController::class, 'login_process'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        if (Auth::check()) {
            return redirect('/dashboard/view-all');
        } else {
            return redirect('/login');
        }
    });

    Route::get('/dashboard/view-all', function () {
        return view('dashboards.v_all_wh');
    });

    Route::post('/set-user-warehouse', [WarehouseController::class, 'set_user_warehouse'])->name('set-user-warehouse');


    Route::get('/dashboard/view-another', [WarehouseController::class, 'get_user_warehouse']);
    Route::get('/dashboard/view-another/detail/{wh_id}', [WarehouseController::class, 'get_warehouse_detail']);

    // route for inbound order
    Route::get('/product/inbounds', [InboundIndex::class, 'inbound_index']);
    Route::get('/product/inbounds/create-inbound-order', [InboundIndex::class, 'create_inbound_order']);
    Route::get('/product/inbounds/view-inbound-latest', [InboundIndex::class, 'latest_inbound_order']);
    Route::get('/product/inbounds/inbound-detail/{lot_in_id}', [InboundIndex::class, 'inbound_detail']);
    Route::get('/product/inbounds/edit-inbound-order/{lot_in_id}', [InboundIndex::class, 'edit_inbound_order']);

    Route::post('/product/inbounds/search-lot-in', [InboundIndex::class, 'search_lot_in'])->name('search_lot_in');

    // route for outbound order
    Route::get('/product/outbounds', [OutboundIndex::class, 'outbound_index']);
    Route::get('/product/outbounds/create-outbound-order', [OutboundIndex::class, 'create_outbound_order']);
    Route::get('/product/outbounds/view-outbound-latest', [OutboundIndex::class, 'latest_outbound_order']);
    Route::get('/product/outbounds/outbound-detail/{lot_out_id}', [OutboundIndex::class, 'outbound_detail']);
    Route::get('/product/outbounds/edit-outbound-order/{lot_out_id}', [OutboundIndex::class, 'edit_outbound_order']);

    Route::post('/product/outbounds/search-lot-out', [OutboundIndex::class, 'search_lot_out'])->name('search_lot_out');

    // route for product management
    Route::get('/product/managements', [ProductManagementIndex::class, 'product_management_index'])->name('product_management_index');
    Route::get('/product/managements/edit/{mas_prod_id}', [ProductManagementIndex::class, 'edit_master_product_index'])->name('edit_master_product');
    Route::get('/product/managements/detail/{mas_prod_id}', [ProductManagementIndex::class, 'detail_master_product_index'])->name('edit_master_product');
    Route::get('/product/managements/add-new-product', [ProductManagementIndex::class, 'add_master_product_index'])->name('edit_master_product');

    Route::get('/warehouse/add-space', function () {
        if (Auth::check() && Auth::user()->role === "warehouse_manager") {
            return view('warehouses.v_add_wh_space');
        } else {
            return redirect('/dashboard/view-all');
        }
    });

    Route::get('/warehouse/add-wh', function () {
        if (Auth::check() && Auth::user()->role === "warehouse_manager") {
            return view('warehouses.v_add_more_wh');
        } else {
            return redirect('/dashboard/view-all');
        }
    });

    Route::get('/user-management', [UserManagementIndex::class, 'user_management_index'])->name('user_management_index');;
    Route::post('/user-management/search', [UserManagementIndex::class, 'search_user'])->name('search_user');
    Route::get('/profile/{number}', [Profile::class,'get_user_profile']);
});
