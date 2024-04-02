<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use App\Models\LotOut;
use Database\Seeders\OutboundOrderSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\OutBoundOrder;

class OutboundIndex extends Controller
{
    //
    public function outbound_index()
    {
        try {
            if (Auth::check()) {
                $lotouts = LotOut::where('wh_id',Session::get('user_warehouse'))->paginate(20);
                return view('products.outbounds.v_outbound_index', compact('lotouts'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function search_lot_out(Request $request)
    {

    }

    public function create_outbound_order()
    {
        return view('products.outbounds.v_create_outbound_order');
    }
    public function latest_outbound_order()
    {
        try {
            if (Auth::check()) {
                $lotouts = LotOut::where('wh_id',Session::get('user_warehouse'))->paginate(20);
                return view('products.outbounds.v_view_outbound_latest', compact('lotouts'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function outbound_detail(int $lot_out_id)
    {
        $lot_out = LotOut::where('lot_out_id', $lot_out_id)->first();

        if ($lot_out !== null) {
            return view('products.outbounds.v_outbound_detail', compact('lot_out'));
        } else {
            abort(404);
        }
    }

    public function edit_outbound_order(int $lot_out_id)
    {
        $lot_out = LotOut::where('lot_out_id', $lot_out_id)->first();

        if ($lot_out !== null) {
            $lot_out_prod = OutBoundOrder::where('lot_out_id', $lot_out_id)->paginate(20);
            return view('products.outbounds.v_edit_outbound_order', compact('lot_out','lot_out_prod'));
        } else {
            abort(404);
        }
    }

}
