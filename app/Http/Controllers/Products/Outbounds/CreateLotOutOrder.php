<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use Illuminate\Http\Request;

class CreateLotOutOrder extends Controller
{
    public function create_outbound_order()
    {
        $master_products = MasterProduct::paginate(20);
        return view('products.outbounds.v_create_outbound_order',compact('master_products'));
    }
}
