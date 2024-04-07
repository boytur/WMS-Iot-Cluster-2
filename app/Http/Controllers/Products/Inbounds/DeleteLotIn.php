<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\LotIn;
use Illuminate\Http\Request;

class DeleteLotIn extends Controller{
    public function delete_lot_in ($lot_in_id){
        if ($lot_in_id === null) {
            abort(404);
        } else {
            //dd($lot_out_id);

            $lot_out = LotIn::where('lot_out_id', $lot_in_id)->first();
            //dd($lot_out);

            if ($lot_out->lot_out_id !== null) {

                $prod_in_outs = InboundOrder::where('lot_out_id', $lot_in_id)->get();

                foreach ($prod_in_outs as $prod_in_out) {
                    if ($prod_in_out->outbound_status !== "Initialized") {
                        return response('ไม่สามารถลบได้ เนื่องจากมีสถานะอื่นๆ', 200);
                    }
                }

                $lot_out = LotIn::where('lot_out_id', $lot_in_id)->delete();
                return response('ลบเรียบร้อย', 200);
            } else {
                abort(404);
            }
        }
    }
}
