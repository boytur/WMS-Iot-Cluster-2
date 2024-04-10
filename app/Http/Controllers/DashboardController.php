<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\MasterProduct;
use Illuminate\Http\Request;
use App\Models\OnShelfProduct;
use App\Models\OutBoundOrder;
use App\Models\Warehouse;
use App\Models\LotIn;
use App\Models\LotOut;

use Cron\DayOfMonthField;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function dashboard_index()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {
                $count_warehouses = Warehouse::count();
                $mas_product = MasterProduct::count();
                $onshelf_products = OnShelfProduct::whereDate('created_at', '=', now()->toDateString())
                    ->where('on_prod_status', '=', 'Onshelf')
                    ->sum('on_prod_amount');
                //สินค้าภายใน 1 วัน
                $outbound_products = OutBoundOrder::whereDate('created_at', '=', now()->toDateString())
                    ->where('outbound_status', '=', 'Onshelf')
                    ->sum('outbound_amount'); // ส่งออก 1
                $outbound_products_by_month = [];
                for ($month = 1; $month <= 12; $month++) {
                    $outbound_products_by_month[$month] = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                        ->whereMonth('created_at', '=', $month)
                        ->where('outbound_status', '=', 'Onshelf')
                        ->sum('outbound_amount');
                }





                $onshelf_all = OnShelfProduct::where('on_prod_status', '=', 'Onshelf')
                    ->sum('on_prod_amount'); //สินค้าทั้งหมด

                $onshelf_product_year = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                    ->whereMonth('created_at', '=', date('m'))
                    ->where('on_prod_status', '=', 'Onshelf')
                    ->get(); //สินค้าภายในปีนี้
                $onshelf_products_by_month = [];
                for ($month = 1; $month <= 12; $month++) {
                    $onshelf_products_by_month[$month] = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                        ->whereMonth('created_at', '=', $month)
                        ->where('on_prod_status', '=', 'Onshelf')
                        ->sum('on_prod_amount');
                }

                return view('dashboards.v_all_wh', compact(
                    'onshelf_products',
                    'onshelf_all',
                    'onshelf_products_by_month',
                    'outbound_products',
                    'outbound_products_by_month',
                    'mas_product',
                    'count_warehouses'
                ));
            } else {
                $wh_id = Session::get('user_warehouse');
                $warehouses = Warehouse::where('wh_id', $wh_id)->first();
                $mas_product = MasterProduct::count();

                $lot_ins = LotIn::where('wh_id', $wh_id)->get();

                $onshelf_products = 0;
                $onshelf_all = 0;
                $onshelf_products_by_month = [];
                $outbound_products_by_month = [];

                foreach ($lot_ins as $lot_in) {
                    $inbounds = InboundOrder::where('lot_in_id', $lot_in->lot_in_id)->get();

                    // dd($inbounds);
                    foreach ($inbounds as $inbound) {
                        $onshelf_products
                            += OnShelfProduct::whereDate('created_at', '=', now()->toDateString())
                            ->where('inbound_id', $inbound->inbound_id)
                            ->where('on_prod_status', '=', 'Onshelf')
                            ->sum('on_prod_amount');
                        $onshelf_all += OnShelfProduct::whereDate('created_at', '=', now()->toDateString())
                            ->where('inbound_id', $inbound->inbound_id)
                            ->where('on_prod_status', '=', 'Onshelf')
                            ->sum('on_prod_amount');
                        $onshelf_products_by_month = [];
                        for ($month = 1; $month <= 12; $month++) {
                            $onshelf_products_by_month[$month] = OnShelfProduct::whereYear('created_at', '=', date('Y'))
                                ->whereMonth('created_at', '=', $month)
                                ->where('inbound_id', $inbound->inbound_id)
                                ->where('on_prod_status', '=', 'Onshelf')
                                ->sum('on_prod_amount');
                        }
                    }
                }
                $outbound_products = 0;
                $lot_outs = LotOut::where('wh_id', $wh_id)->get();
                foreach ($lot_outs as $lot_out) {
                    $outbounds = OutBoundOrder::where('lot_out_id', $lot_out->lot_out_id)->get();
                    $outbound_products = OutBoundOrder::whereDate('created_at', '=', now()->toDateString())
                        ->where('outbound_status', '=', 'Onshelf')
                        ->sum('outbound_amount');
                    $outbound_products_by_month = [];
                    for ($month = 1; $month <= 12; $month++) {
                        $outbound_products_by_month[$month] = OutBoundOrder::whereYear('created_at', '=', date('Y'))
                            ->whereMonth('created_at', '=', $month)
                            ->where('outbound_status', '=', 'Onshelf')
                            ->sum('outbound_amount');
                    }
                }
                return view('dashboards.v_all_normal', compact('warehouses', 'onshelf_products', 'onshelf_all', 'outbound_products', 'onshelf_products_by_month', 'outbound_products_by_month', 'mas_product'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function get_warehouse_detail_normal()
    {
        try {
            if (Auth::check() && Auth::user()->role !== "warehouse_manager") {
            } else {
                return redirect('/dashboard/view-all');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    // public function dashboard_normal($wh_id)
    // {
    //     try {
    //         if (Auth::check() && Auth::user()->role === "normal_employee") {
    //             $warehouses = Warehouse::where('wh_id', $wh_id)->get();

    //             return view('dashboards.v_all_normal', compact('warehouses'));
    //         } else {
    //             return redirect('/dashboard/view-all');
    //         }
    //     } catch (\Exception $e) {
    //         throw new \Exception($e->getMessage());
    //     }
    // }
}
