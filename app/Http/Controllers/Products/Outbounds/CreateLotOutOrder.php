<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\OutBoundOrder;
use App\Models\LotOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class CreateLotOutOrder extends Controller
{

    public function create_outbound_order(Request $request)
    {

        try {
            $products = $request->input('payload.products');
            $sort_selected = $request->input('payload.sort_selects'); // มีค่า FI_FO กับ IN_WH

            $wh_id = Session::get('user_warehouse');
            $lot_out = LotOut::create([
                'lot_out_number' => "lotout" . time(),
                'lot_out_status' => "Initialized",
                'wh_id' => $wh_id,
                'user_id' => Auth::user()->id,
            ]);

            foreach ($products as $product) {

                OutBoundOrder::create([
                    'outbound_amount' => $product['amount'],
                    'outbound_status' => 'Initialized',
                    'outbound_exp' => null,  // ต้องเพิ่มตรงนี้
                    'mas_prod_id' => $product['mas_prod_id'],
                    'lot_out_id' => $lot_out['id'],
                ]);
            }

            response()->json(['success' => true, 'data' => 'สร้างรายการส่งออกสำเร็จ'], 200);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
