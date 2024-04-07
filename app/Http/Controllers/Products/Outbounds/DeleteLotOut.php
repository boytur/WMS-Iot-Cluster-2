<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use App\Models\LotOut;
use App\Models\OutBoundOrder;
use Illuminate\Http\Request;

class DeleteLotOut extends Controller
{
    public function delete_lot_out($lot_out_id)
    {
        if ($lot_out_id === null) {
            abort(404);
        } else {
            //dd($lot_out_id);

            $lot_out = LotOut::where('lot_out_id', $lot_out_id)->first();
            //dd($lot_out);

            if ($lot_out->lot_out_id !== null) {

                $prod_in_outs = OutBoundOrder::where('lot_out_id', $lot_out_id)->get();

                foreach ($prod_in_outs as $prod_in_out) {
                    if ($prod_in_out->outbound_status !== "Initialized") {
                        return response('ไม่สามารถลบได้ เนื่องจากมีสถานะอื่นๆ', 200);
                    }
                }

                $lot_out = LotOut::where('lot_out_id', $lot_out_id)->delete();
                return response('ลบเรียบร้อย', 200);
            } else {
                abort(404);
            }
        }
    }
}
