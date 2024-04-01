<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use App\Models\LotOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OutboundIndex extends Controller
{
    //
    public function outbound_index()
    {
        try {
            if (Auth::check()) {
                $lotouts = LotOut::paginate(20);
                return view('products.outbounds.v_outbound_index', compact('lotouts'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create_outbound_order()
    {
        return view('products.outbounds.v_create_outbound_order');
    }
    public function latest_outbound_order()
    {
     try {
         if (Auth::check()) {
             $lotouts = LotOut::paginate(20);
             return view('products.outbounds.v_view_outbound_latest', compact('lotouts'));
         }
     } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
     }
    }
}
