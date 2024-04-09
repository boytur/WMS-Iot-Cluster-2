<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\LotIn;
use App\Models\MasterProduct;
use App\Models\OnShelfProduct;
use App\Models\Rack;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FindLotInSpace extends Controller
{
    public function find_lot_in_space($lot_in_id)
    {

        if ($lot_in_id === "" || $lot_in_id === null) {
            return response()->json(['success' => false, 'data' => 'Invalid lot in id'], 400);
        }

        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();

        if ($lot_in->lot_in_id === null) {
            return response()->json(['success' => false, 'data' => 'ไม่มีล็อตสินค้านี้อยู่จริง'], 400);
        }

        $wh_id = Session::get('user_warehouse');
        $racks = Rack::where('wh_id', $wh_id)->get();

        //dd($racks);
        $inbound_prods = InboundOrder::where('lot_in_id', $lot_in->lot_in_id)->get();

        foreach ($inbound_prods as $inbound_prod) {

            $prod_tags = [];
            $rack_tags = [];
            $mas_prod = MasterProduct::where('mas_prod_id', $inbound_prod->mas_prod_id)->first();

            if ($mas_prod) {
                // Get master product tags
                $prod_tags = $mas_prod->get_tags_name($mas_prod->mas_prod_id);
                // Loop through racks to get rack tags
                foreach ($racks as $rack) {
                    $rack_tags = $rack->get_tags_name($rack->rack_id);

                    // Check if both master product tags and rack tags are not empty and not null
                    if (!empty($prod_tags) && !empty($rack_tags) && $prod_tags[0]['tag_name'] !== null && $rack_tags[0]['tag_name'] !== null) {
                        // Compare each tag of the master product with each tag of the rack
                        foreach ($prod_tags as $prod_tag) {

                            foreach ($rack_tags as $rack_tag) {

                                //if matching master product tags
                                if ($prod_tag['tag_name'] === $rack_tag['tag_name']) {

                                    //dd($prod_tags, $mas_prod->mas_prod_name, $rack_tags, $rack->rack_name, $rack->warehouses->wh_name);

                                    // find space from rack id that matches
                                    $spaces = Space::where('rack_id', $rack->rack_id)->get();

                                    //check space with master product size
                                    $mas_percent_perpiece = ($mas_prod->mas_prod_size) / 100;
                                    $all_percent = $mas_percent_perpiece * $inbound_prod->inbound_amount;

                                    //dd($space->toArray());
                                    //dd($mas_percent_perpiece, $all_percent,$inbound_prod->inbound_amount);

                                    // ลูปใส่ของจนกว่าจะหมด
                                    foreach ($spaces as $space) {

                                        // กรณีเก็บได้พอดี
                                        if ($space->space_capacity < 100 && $space->space_capacity + $all_percent < 100) {
                                            $space->update([
                                                'space_capacity' => $space->space_capacity + $all_percent
                                            ]);
                                            OnShelfProduct::create([
                                                'on_prod_amount' => $inbound_prod->inbound_amount,
                                                'on_prod_status' => "Transporting",
                                                'space_id' => $space->space_id,
                                                'inbound_id' => $inbound_prod->inbound_id
                                            ]);
                                            return;
                                        } else {

                                            // กรณีเก็บได้ไม่พอดีก็เก็บทีละตัว
                                            $spaces_now = $space->space_capacity;
                                            $spaces_can_kept = $spaces_now - 100;
                                            $actual_spaces = $all_percent - $spaces_can_kept;

                                            for ($i = 0; $i < $inbound_prod->inbound_amount; $i++) {
                                                if ($space->space_capacity < 100 && $mas_percent_perpiece + $space->space_capacity < 100) {

                                                    $space->update([
                                                        'space_capacity' => $space->space_capacity + $mas_percent_perpiece
                                                    ]);

                                                    if ($space->space_capacity < 100.00 && $mas_percent_perpiece + $space->space_capacity >= 100.00) {
                                                        OnShelfProduct::create([
                                                            'on_prod_amount' => $actual_spaces,
                                                            'on_prod_status' => "Transporting",
                                                            'space_id' => $space->space_id,
                                                            'inbound_id' => $inbound_prod->inbound_id
                                                        ]);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        //กรณีสินค้าไม่มี tags
                    } else {

                    }
                }
            }
        }
    }
}
