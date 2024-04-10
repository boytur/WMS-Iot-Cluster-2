<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\MasterProduct;
use App\Models\OnShelfProduct;
use App\Models\OutBoundOrder;
use App\Models\LotOut;
use App\Models\OutProductList;
use App\Models\Space;
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

            //dd($sort_selected);

            $wh_id = Session::get('user_warehouse');

            // create lot out order
            $lot_out = LotOut::create([
                'lot_out_number' => "lotout" . time(),
                'lot_out_status' => "Initialized",
                'wh_id' => $wh_id,
                'user_id' => Auth::user()->id,
            ]);

            //create outbound order
            foreach ($products as $product) {

                OutBoundOrder::create([
                    'outbound_amount' => $product['amount'],
                    'outbound_status' => 'Initialized',
                    'mas_prod_id' => $product['mas_prod_id'],
                    'lot_out_id' => $lot_out['id'],
                ]);
            }

            //dd($products);
            $on_shelf_prods = [];
            $prod_out_list = [];

            $prod_in_orders = OutBoundOrder::where('lot_out_id', $lot_out->id)->get();

            foreach ($prod_in_orders as $prod_in_order) {

                $amout_prod_order_out = $prod_in_order->outbound_amount;
                $prod_in_bounds = InboundOrder::where('mas_prod_id', $prod_in_order->mas_prod_id)->get();

                foreach ($prod_in_bounds as $prod_in_bound) {
                    $on_shelf_prods = OnShelfProduct::where('inbound_id', $prod_in_bound->inbound_id)
                        ->where('on_prod_status', "Onshelf")
                        ->get();

                    foreach ($on_shelf_prods as $on_shelf_prod) {

                        // กรณีมีของพอดี
                        if ($on_shelf_prod->on_prod_amount >= $prod_in_order->outbound_amount) {

                            $on_shelf_prod->update([
                                'on_prod_amount' => $on_shelf_prod->on_prod_amount - $prod_in_order->outbound_amount
                            ]);

                            OutProductList::create([
                                'out_prod_list_amount' => $prod_in_order->outbound_amount,
                                'on_prod_id' => $on_shelf_prod->on_prod_id,
                                'outbound_id' => $prod_in_order->outbound_id,
                            ]);

                            $space = Space::where('space_id', $on_shelf_prod->space_id)->first();
                            $master_prod_id = $prod_in_order->master_prod_id;

                            $master_prod = MasterProduct::where('master_prod_id', $master_prod_id)->first();

                            $space->update([
                                'space_capacity' => $space->space_capacity - (($master_prod->mas_prod_size) / 100)
                            ]);
                            return;

                        } else {
                            for ($i = 0; $i < $amout_prod_order_out; $i++) {
                                if ($on_shelf_prod->on_prod_amount > 0) {

                                    $on_shelf_prod->update([
                                        'on_prod_amount' => $on_shelf_prod->on_prod_amount - 1
                                    ]);

                                    if ($on_shelf_prod->on_prod_amount === 0) {
                                        OutProductList::create([
                                            'out_prod_list_amount' => $amout_prod_order_out,
                                            'on_prod_id' => $on_shelf_prod->on_prod_id,
                                            'outbound_id' => $prod_in_order->outbound_id,
                                        ]);
                                        $on_shelf_prod->update([
                                            'on_prod_status' => "Exported"
                                        ]);
                                    }
                                    $amout_prod_order_out--;
                                }
                            }
                        }
                    }
                }
            }
            response()->json(['success' => true, 'data' => 'สร้างรายการส่งออกสำเร็จ'], 200);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
