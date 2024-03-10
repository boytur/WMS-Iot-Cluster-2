<?php
use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\Warehouse_controller;
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

// เส้นทางที่ไม่ต้องการการยืนยันตน
Route::get('/login', [Auth_controller::class, 'login_index']);
Route::post('/login', [Auth_controller::class, 'login_process'])->name('login');
Route::post('/logout', [Auth_controller::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return 'testing....';
    });

    Route::get('/dashboard/view-all',[Warehouse_controller::class, 'index_warehouse']);

    Route::get('/dashboard/view-another', function () {
        return view('dashboards.v_another_wh');
    });

    Route::get('/product/inbounds', function () {
        return view('products.inbounds.v_inbound_index');
    });

    Route::get('/product/outbounds', function () {
        return view('products.outbounds.v_outbound_index');
    });

    Route::get('/product/managements', function () {
        return view('products.managements.v_product_management_index');
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

    Route::post('/set-user-warehouse', [Warehouse_controller::class, 'set_user_warehouse'])->name('set-user-warehouse');
});

if(App::environment('production')){
    URL::forceScheme('https');
}
