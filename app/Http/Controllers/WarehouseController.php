<?php

namespace App\Http\Controllers;

use App\Models\RackTag;
use App\Models\Tag;
use App\Models\User;
use App\Models\InboundOrder;
use App\Models\LotIn;
use App\Models\LotOut;
use App\Models\MasterProduct;
use App\Models\Warehouse;
use App\Models\WarehouseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\OnShelfProduct;
use App\Models\Rack;
use App\Models\Space;
use App\Models\OutBoundOrder;

class WarehouseController extends Controller
{
    public function set_user_warehouse(Request $request)
    {
        try {
            $warehouse_id = $request->only('warehouse_id');
            $warehouse_id = $warehouse_id['warehouse_id'];
            Session::put('user_warehouse', $warehouse_id);

            $warehouses = Warehouse::where('wh_id', $warehouse_id)->first();
            Session::put('user_warehouse_name', $warehouses->wh_name);

            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return back()->withErrors(['change_warehouse' => $e->getMessage()]);
        }
    }
    public function get_user_warehouse()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {
                $warehouses = Warehouse::paginate(20);
                return view('dashboards.v_another_wh', compact('warehouses'));
            } else {
                return redirect('/dashboard/view-all');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }



    public function get_warehouse_detail($wh_id)
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {
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
                        $onshelf_products += OnShelfProduct::whereDate('created_at', '=', now()->toDateString())
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





                return view('dashboards.v_another_wh_detail', compact('warehouses', 'onshelf_products', 'onshelf_all', 'outbound_products', 'onshelf_products_by_month', 'outbound_products_by_month', 'mas_product'));
            } else {
                return redirect('/dashboard/view-all');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function get_add_more_warehouse()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {
                $warehouses = Warehouse::paginate(20);
                return view('warehouses.v_add_more_wh', compact('warehouses'));
            } else {
                return redirect('/warehouse/view-all');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    /*
         * add_wh_index()
         * @author: Pichawat Suwan 65160346
         * @create date: 2024-04-10
         */
    public function add_wh_space_index()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {
                $tags = Tag::all();
                return view('warehouses.v_add_wh_space', compact('tags'));
            } else {
                return redirect('/dashboard/view-all');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
     /*
         * add_wh_space()
         * @author: Pichawat Suwan 65160346
         * @create date: 2024-04-10
         */
    public function add_wh_space(Request $request)
    {
        // try{
            // dd($request);
            $wh_id = Session::get('user_warehouse');
            $rack = Rack::create([
                'rack_name' => $request->payload['rack_name'],
                'rack_height' => $request->payload['rack_h'],
                'rack_width' => $request->payload['rack_w'],
                'wh_id' => $wh_id,
            ]);
            // dd($rack);
            if ($request->payload['tag_id']!=null) {
                RackTag::create([
                    'tag_id'=>$request->payload['tag_id'],
                    'rack_id'=>$rack->rack_id,
                ]);
            }
            // dd($request->payload['space_name']);
            foreach ($request->payload['space_name'] as $space_name) {
                // dd($space_name);
                if($space_name!='')
                {Space::create([
                    'space_name' => $space_name,
                    'rack_id' => $rack->rack_id,
                    'space_capacity'=> 0,
                ]);}
            }
            return response()->json(['success' => true], 200);
        // } catch (\Exception $e) {
        //     throw new \Exception($e->getMessage());
        // }
    }

    public function add_warehouse(Request $request)
    {

        $wh_name = $request->name;
        $wh_location = $request->subdistrict . " " . $request->district . " " . $request->province . ' ' . $request->postal_code;
        //dd($request);
        $new_wh = Warehouse::create([
            'wh_name' => $wh_name,
            'wh_location' => $wh_location
        ]);

        $managers = User::where('role', 'warehouse_manager')->get();

        foreach ($managers as $manager) {
            WarehouseUser::create([
                'wh_id' => $new_wh->wh_id,
                'user_id' => $manager->id
            ]);
        }
        return response()->json(['success' => true, 'message' => 'เพิ่มคลังสินค้าใหม่เรียบร้อยแล้ว']);
    }
}
