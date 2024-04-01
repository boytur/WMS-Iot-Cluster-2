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
}
