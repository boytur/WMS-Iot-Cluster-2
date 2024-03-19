<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OutboundIndex extends Controller
{
    //
    public function outbound_index()
    {
        return view('products.outbounds.v_outbound_index');
    }

    public function create_outbound_order()
    {
        return view('products.outbounds.v_create_outbound_order');
    }
    public function latest_outbound_order()
    {
        return view('products.outbounds.v_view_outbound_latest');
    }
}
