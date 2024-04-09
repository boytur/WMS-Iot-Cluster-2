<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Rack;
use App\Models\Space;
use App\Models\RackTag;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
                return view('dashboards.v_another_wh_detail', compact('warehouses'));
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
}
