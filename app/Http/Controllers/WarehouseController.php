<?php

namespace App\Http\Controllers;

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
}
