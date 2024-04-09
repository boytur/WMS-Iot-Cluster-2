<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Products\Inbounds\CreateLotInOrder;
use App\Http\Controllers\Products\Inbounds\DeleteLotIn;
use App\Http\Controllers\Products\Inbounds\FindLotInSpace;
use App\Http\Controllers\Products\Inbounds\InboundIndex;
use app\Http\Controllers\Products\Inbounds\GetLotInAnotherWh;
use App\Http\Controllers\Products\Outbounds\OutboundIndex;

use App\Http\Controllers\Products\Outbounds\CreateLotOutOrder;

use App\Http\Controllers\Products\Managements\ProductManagementIndex;
use App\Http\Controllers\Products\Outbounds\DeleteLotOut;
use App\Http\Controllers\Users\Profile;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\Users\UserManagementIndex;
use App\Http\Controllers\Products\Managements\CreateNewMasterProduct;
use App\Http\Controllers\Products\Outbounds\EditByAddProductLotOutOrder;
use App\Http\Controllers\Products\Inbounds\EditAmountLotInOrder;
use App\Http\Controllers\Products\Inbounds\EditByAddProductLotInOrder;
use App\Models\MasterProduct;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

    // Route::get('/dashboard/view-all', function () {
    //     return view('dashboards.v_all_wh');
    // });
    Route::get('/dashboard/view-all', [DashboardController::class, 'dashboard_index']);

    Route::post('/set-user-warehouse', [WarehouseController::class, 'set_user_warehouse'])->name('set-user-warehouse');


    Route::get('/dashboard/view-another', [WarehouseController::class, 'get_user_warehouse']);
    Route::get('/dashboard/view-another/detail/{wh_id}', [WarehouseController::class, 'get_warehouse_detail']);

    // route for inbound order
    Route::get('/product/inbounds', [InboundIndex::class, 'inbound_index']);
    Route::get('/product/inbounds/create-inbound-order', [InboundIndex::class, 'create_inbound_order']);
    Route::get('/product/inbounds/view-inbound-latest', [InboundIndex::class, 'latest_inbound_order']);
    Route::get('/product/inbounds/view-inbound-latest/detail/{lot_in_id}', [InboundIndex::class, 'inbound_latest_detail']);
    Route::get('/product/inbounds/inbound-detail/{lot_in_id}', [InboundIndex::class, 'inbound_detail']);
    Route::get('/product/inbounds/edit-inbound-order/{lot_in_id}', [InboundIndex::class, 'edit_inbound_order']);
    Route::post('/product/inbounds/edit-inbound-order/{lot_in_id}', [EditByAddProductLotInOrder::class, 'add_product_to_lot_in'])->name('add_product_to_lot_in');

    Route::post('/product/inbounds/find-lot-in-space/{lot_in_id}', [FindLotInSpace::class, 'find_lot_in_space']);
    Route::post('/product/inbounds/inbound-detail/closed_lot_in',[InboundIndex::class, 'Closed_lot_in']);
    Route::post('/product/inbounds/search-lot-in', [InboundIndex::class, 'search_lot_in'])->name('search_lot_in');
    Route::post('/product/inbounds/create-inbound-order', [CreateLotInOrder::class, 'create_inbound_order']);
    Route::post('/product/inbounds/create-inbound-order/search-product', [InboundIndex::class, 'search_product_lot_in']);
    Route::post('/product/inbounds/inbound-detail/cancel_on_shelf',[InboundIndex::class, 'cancel_on_shelf']);
    Route::post('/product/inbounds/inbound-detail/confrim_on_shelf',[InboundIndex::class, 'confrim_on_shelf']);


    Route::post('/product/inbounds/search-lot-in', [InboundIndex::class, 'search_lot_in']);
    Route::delete('/product/inbouns/delete-inbound-product/{lot_in_id}', [DeleteLotIn::class, 'delete_lot_in']);
    // route for outbound order
    Route::get('/product/outbounds', [OutboundIndex::class, 'outbound_index']);
    Route::get('/product/outbounds/create-outbound-order', [OutboundIndex::class, 'create_outbound_order']);
    Route::get('/product/outbounds/view-outbound-latest', [OutboundIndex::class, 'latest_outbound_order']);
    Route::get('/product/outbounds/view-outbound-latest/detail/{lot_out_id}', [OutboundIndex::class, 'outbound_latest_detail']);
    Route::get('/product/outbounds/outbound-detail/{lot_out_id}', [OutboundIndex::class, 'outbound_detail']);
    Route::get('/product/outbounds/edit-outbound-order/{lot_out_id}', [OutboundIndex::class, 'edit_outbound_order']);
    Route::post('/product/outbounds/edit-outbound-order/{lot_out_id}', [EditByAddProductLotOutOrder::class, 'add_product_to_lot_out'])->name('add_product_to_lot_out');
    Route::post('/product/outbounds/create-outbound-order', [CreateLotOutOrder::class, 'create_outbound_order'])->name('create_outbound_order');

    Route::post('/product/outbounds/search-lot-out', [OutboundIndex::class, 'search_lot_out']);
    Route::post('/product/outbounds/create-outbound-order/search-product', [OutboundIndex::class, 'search_product_lot_out']);
    Route::delete('/product/outbounds/delete-outbound-product/{lot_out_id}', [DeleteLotOut::class, 'delete_lot_out']);

    // route for product management
    Route::get('/product/managements', [ProductManagementIndex::class, 'product_management_index'])->name('product_management_index');
    Route::get('/product/managements/edit/{mas_prod_id}', [ProductManagementIndex::class, 'edit_master_product_index'])->name('edit_master_product');
    Route::get('/product/managements/detail/{mas_prod_id}', [ProductManagementIndex::class, 'detail_master_product_index'])->name('edit_master_product');
    Route::get('/product/managements/add-new-product', [ProductManagementIndex::class, 'add_master_product_index'])->name('edit_master_product');
    Route::post('/product/managements/search-product', [ProductManagementIndex::class, 'search_product'])->name('search_product');

    Route::get('/warehouse/add-space',[WarehouseController::class,'add_wh_space_index']);
    Route::post('/warehouse/add-space',[WarehouseController::class,'add_wh_space']);

    //    route for warehouses management
    Route::get('/warehouse/add-wh', [WarehouseController::class, 'get_add_more_warehouse']);
    // route for user detail
    Route::get('/user-edit-detail/{number}', [UserManagementIndex::class, 'user_edit_index'])->name('user_edit_index');
    // Route::put('/user-edit-detail/{number}', [UserManagementIndex::class, 'user_edit_update']);
    Route::put('/user-edit-detail/{number}', [UserManagementIndex::class, 'user_edit_update'])->name('user.edit.update');


    Route::get('/user-management', [UserManagementIndex::class, 'user_management_index'])->name('user_management_index');
    Route::get('/user-management/detail/{number}', [UserManagementIndex::class, 'user_management_detail'])->name('user_management_detail');
    Route::put('/user-management/edit-password', [UserManagementIndex::class, 'edit_user_password']);
    Route::post('/user-management/search', [UserManagementIndex::class, 'search_user']);
    Route::get('/profile/{number}', [Profile::class, 'get_user_profile']);

    Route::get('/product/managements/add-new-product', [CreateNewMasterProduct::class, 'create']);

    Route::post('/product/managements/add-new-product', [CreateNewMasterProduct::class, 'store']);

    Route::get('/user-management/create_user', [UserManagementIndex::class, 'create_user']);
    Route::put('/user-management/create_new_user', [UserManagementIndex::class, 'create_new_user']);
    // Route::post('/user-management/create_user', [UserManagementIndex::class, 'store_user'])->name('upload.image');

    Route::delete('/user-management/delete-user/{id}', [UserManagementIndex::class, 'delete']);
    Route::post('/user-management/create_user', [UserManagementIndex::class, 'store_user']);
    Route::post('/user-management/create_user', [UserManagementIndex::class, 'store_user'])->name('upload.image');
    Route::put('/user-management/edit-user-info/{user_id}',[UserManagementIndex::class,'edit_user_info']);
    Route::get('/profile', [Profile::class, 'get_user_profile']);


});
