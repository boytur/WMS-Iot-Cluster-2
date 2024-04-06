<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\LotIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CreateLotInOrder extends Controller
{

    public function create_inbound_order(Request $request)
    {
        try {
            $products = $request->products;
            $wh_id = Session::get('user_warehouse');

            $lot_in = LotIn::create([
                'lot_in_number' => "lotin",
                'lot_in_status' => "Initialized",
                'wh_id' => $wh_id['warehouse_id'],
                'user_id' => Auth::user()->id,
            ]);
            foreach ($products as $product) {
                InboundOrder::create([
                    'inbound_amount' => $product['amount'],
                    'inbound_status' => 'Initialized',
                    'inbound_exp' => $product['exp'],
                    'mas_prod_id' => $product['mas_prod_id'],
                    'lot_in_id' => $lot_in['id'],
                ]);
            }

            response()->json(['success' => true, 'data' => 'สร้างรายการรับเข้าสำเร็จ'], 200);

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
