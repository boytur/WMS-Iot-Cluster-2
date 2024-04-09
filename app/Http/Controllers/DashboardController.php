<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use Illuminate\Http\Request;
use App\Models\OnShelfProduct;
use App\Models\OutBoundOrder;
use App\Models\Warehouse;
use Cron\DayOfMonthField;

class DashboardController extends Controller
{
    public function dashboard_index()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {
                ///ไปเช็คสถานะว่าเป็นรับเข้าสำเร็จไหม
                $count_warehouses = Warehouse::count();
                $onshelf_products = OnShelfProduct::whereDate('created_at', '=', now()->toDateString())
                    ->sum('on_prod_amount');

                //สินค้าภายใน 1 วัน
                $outbound_products = OutBoundOrder::whereDate('created_at', '=', now()->toDateString())
                    ->sum('outbound_amount');
                $outbound_product_jan = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 1) // 1 for January
                    ->sum('outbound_amount');
                $outbound_product_feb = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 2) // 2 for January
                    ->sum('outbound_amount');
                $outbound_product_mar = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 3) // 3 for January
                    ->sum('outbound_amount');
                $outbound_product_apr = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 4) // 4 for January
                    ->sum('outbound_amount');
                $outbound_product_may = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 5) // 5 for January
                    ->sum('outbound_amount');
                $outbound_product_jun = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 6) // 6 for January
                    ->sum('outbound_amount');
                $outbound_product_jul = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 7) // 7 for January
                    ->sum('outbound_amount');
                $outbound_product_aug = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 8) // 8 for January
                    ->sum('outbound_amount');
                $outbound_product_sep = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 9) // 9 for January
                    ->sum('outbound_amount');
                $outbound_product_oct = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 10) // 10 for January
                    ->sum('outbound_amount');
                $outbound_product_nov = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 11) // 11 for January
                    ->sum('outbound_amount');
                $outbound_product_dec = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 12) // 12 for January
                    ->sum('outbound_amount');




                $onshelf_all = OnShelfProduct::all(); //สินค้าทั้งหมด
                $onshelf_product_year = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', date('m'))
                    ->get(); //สินค้าภายในปีนี้
                $onshelf_product_jan = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 1) // 1 for January
                    ->sum('on_prod_amount');
                $onshelf_product_feb = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 2) // 2 for January
                    ->sum('on_prod_amount');
                $onshelf_product_mar = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 3) // 3 for January
                    ->sum('on_prod_amount');
                $onshelf_product_apr = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 4) // 4 for January
                    ->sum('on_prod_amount');
                $onshelf_product_may = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 5) // 5 for January
                    ->sum('on_prod_amount');
                $onshelf_product_jun = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 6) // 6 for January
                    ->sum('on_prod_amount');
                $onshelf_product_jul = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 7) // 7 for January
                    ->sum('on_prod_amount');
                $onshelf_product_aug = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 8) // 8 for January
                    ->sum('on_prod_amount');
                $onshelf_product_sep = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 9) // 9 for January
                    ->sum('on_prod_amount');
                $onshelf_product_oct = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 10) // 10 for January
                    ->sum('on_prod_amount');
                $onshelf_product_nov = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 11) // 11 for January
                    ->sum('on_prod_amount');
                $onshelf_product_dec = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', 12) // 12 for January
                    ->sum('on_prod_amount');

                return view('dashboards.v_all_wh', compact(
                    'onshelf_products',
                    'onshelf_all',
                    'onshelf_product_jan',
                    'onshelf_product_feb',
                    'onshelf_product_mar',
                    'onshelf_product_apr',
                    'onshelf_product_may',
                    'onshelf_product_jun',
                    'onshelf_product_jul',
                    'onshelf_product_aug',
                    'onshelf_product_sep',
                    'onshelf_product_oct',
                    'onshelf_product_nov',
                    'onshelf_product_dec',
                    'outbound_products',
                    'outbound_product_jan',
                    'outbound_product_feb',
                    'outbound_product_mar',
                    'outbound_product_apr',
                    'outbound_product_may',
                    'outbound_product_jun',
                    'outbound_product_jul',
                    'outbound_product_aug',
                    'outbound_product_sep',
                    'outbound_product_oct',
                    'outbound_product_nov',
                    'outbound_product_dec',
                    'count_warehouses'
                ));
            } else {
                return view('dashboards.v_all_normal');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
