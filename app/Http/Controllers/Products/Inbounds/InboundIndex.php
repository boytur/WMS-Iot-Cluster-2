<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use App\Models\LotIn;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InboundIndex extends Controller
{
    public function inbound_index()
    {
        try {
            if (Auth::check()) {
                $lot_in_products = LotIn::where('wh_id',Session::get('user_warehouse'))->paginate(20) ;
                return view('products.inbounds.v_inbound_index', compact('lot_in_products'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function search_lot_in(Request $request)
    {

    }

    public function create_inbound_order()
    {
        $master_products = MasterProduct::paginate(20);
        return view('products.inbounds.v_create_inbound_order', compact('master_products'));

    }
    public function latest_inbound_order()
    {
        try {
            if (Auth::check()) {
                $lot_in_products = LotIn::where('wh_id',Session::get('user_warehouse'))->paginate(20);
                return view('products.inbounds.v_view_inbound_latest', compact('lot_in_products'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function inbound_detail(int $lot_in_id)
    {
        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();

        if ($lot_in !== null) {
            return view('products.inbounds.v_inbound_detail', compact('lot_in'));
        } else {
            abort(404);
        }
    }

    public function edit_inbound_order(int $lot_in_id)
    {
        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();

        if ($lot_in !== null) {
            return view('products.inbounds.v_edit_inbound_order', compact('lot_in'));
        } else {
            abort(404);
        }
    }
}
