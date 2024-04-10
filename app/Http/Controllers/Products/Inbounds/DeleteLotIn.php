<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\LotIn;
use Illuminate\Http\Request;

class DeleteLotIn extends Controller
{
    public function delete_lot_in($lot_in_id)
    {
        if ($lot_in_id === null) {
            abort(404);
        } else {
            //dd($lot_in_id);
            $lot_ins = LotIn::where('lot_in_id', $lot_in_id)->first();

            if ($lot_ins->lot_in_id !== null) {
                $prod_ins = InboundOrder::where('lot_in_id', $lot_in_id)->get();

                foreach ($prod_ins as $prod_ins) {
                    if ($prod_ins->inbound_status !== "Initialized") {
                        return response('ไม่สามารถลบได้', 201);
                    }
                }
                $lot_ins = LotIn::where('lot_in_id', $lot_in_id)->delete();
                return response('ลบเรียร้อย', 200);
            } else {
                abort(404);
            }
        }
    }
}
