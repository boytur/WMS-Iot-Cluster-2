<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboundIndex extends Controller
{
    public function inbound_index()
    {
        return view('products.inbounds.v_inbound_index');
    }

    public function create_inbound_order()
    {
        return view('products.inbounds.v_create_inbound_order');
    }
    public function latest_inbound_order()
    {
        return view('products.inbounds.v_view_inbound_latest');
    }


}
