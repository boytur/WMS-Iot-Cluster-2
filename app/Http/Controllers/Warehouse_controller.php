<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Warehouse_controller extends Controller
{

    public function index_warehouse(){
        try {

            $warehouse_id = Session::get('user_warehouse');
            if($warehouse_id == null){
                $warehouse_id = 1;
            }

            //dd($warehouse_id);

            $wh = Warehouse::where('wh_id', $warehouse_id)->first();

            if (!$wh) {
                return back()->withErrors(['get_warehouse' => "ไม่มี"]);
            }

            //dd($wh->wh_name);
            return view('dashboards.v_all_wh')->with('wh', $wh);

        } catch (\Exception $e) {
            return back()->withErrors(['get_warehouse' => $e->getMessage()]);
        }
    }

    public function set_user_warehouse(Request $request)
    {
        try {
            $warehouse_id = $request->only('warehouse_id');
            $warehouse = Warehouse::where('wh_id', $warehouse_id);
            Session::put('user_warehouse', $warehouse_id);

            $user_wh = Session::get('user_warehouse');
            return response()->json(['success' => true, 'user_wh' => $user_wh], 200);

        } catch (\Exception $e) {
            return back()->withErrors(['change_warehouse' => $e->getMessage()]);
        }
    }

    public function get_warehouse(Request $request)
    {
        try {

            $warehouse_id = Session::get('user_warehouse');

            $wh = Warehouse::where('wh_id', $warehouse_id);

            if (!$wh) {
                return back()->withErrors(['get_warehouse' => "ไม่มี"]);
            }

            return response()->json(['success' => true, 'warehouse' => $wh], 200);

        } catch (\Exception $e) {
            return back()->withErrors(['get_warehouse' => $e->getMessage()]);
        }
    }
}
