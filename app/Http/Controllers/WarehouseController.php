<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseUser;
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
