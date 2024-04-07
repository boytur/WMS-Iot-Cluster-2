<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\LotIn;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InboundIndex extends Controller
{
    public function inbound_index()
    {
        try {
            if (Auth::check()) {
                $lot_in_products = LotIn::where('wh_id', Session::get('user_warehouse'))->paginate(20);
                $products = MasterProduct::paginate(20);
                return view('products.inbounds.v_inbound_index', compact('lot_in_products', 'products'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function search_lot_in(Request $request)
    {
        try {
            $search_lot_in = $request->input('search_lot_in');
            $search_attribute = $request->input('search_attribute');
            $search_status = $request->input('search_status');

            $query = LotIn::query();
            $query->where('wh_id', Session::get('user_warehouse'))->paginate(20);

            // If user search is provided, apply appropriate search criteria
            if (!empty($search_lot_in)) {
                if ($search_attribute === 'number_lot_in') {
                    $query->where('lot_in_number', 'like', "%$search_lot_in%");
                } elseif ($search_attribute === 'number_emp') {
                    $query->whereHas('users', function ($q) use ($search_lot_in) {
                        $q->where('number', 'like', "%$search_lot_in%");
                    });
                }
            }

            // If user type filter is provided, filter by user role
            if ($search_status === "all") {
            } elseif ($search_status === "Initialized") {
                $query->where('lot_in_status', $search_status);
            } else {
                $query->where('lot_in_status', $search_status);
            }
            $searches = $query->paginate(10);


            $new_searches = [];
            foreach ($searches as $search) {

                $user = User::where('id', $search->user_id)->first();

                if ($user !== null) {
                    $new_searches[] = [
                        'lot_in_id' => $search->lot_in_id,
                        'lot_in_number' => $search->lot_in_number,
                        'lot_in_status' => $search->lot_in_status,
                        'wh_id' => $search->wh_id,
                        'user_id' => $user->fname . " " . $user->lname,
                        'created_at' => $search->created_at,
                        'updated_at' => $search->updated_at
                    ];
                }
            }
            return response()->json(['success' => true, 'data' => $new_searches], 200);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function create_inbound_order()
    {
        $master_products = MasterProduct::paginate(20);

        foreach ($master_products as $product) {
            $tags = $product->get_tags_name($product->mas_prod_id);
            $product->tags = $tags;
        }

        return view('products.inbounds.v_create_inbound_order', compact('master_products'));
    }
    public function latest_inbound_order()
    {
        try {
            if (Auth::check()) {
                $lot_in_products = LotIn::where('wh_id', Session::get('user_warehouse'))->paginate(20);
                return view('products.inbounds.v_view_inbound_latest', compact('lot_in_products'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function inbound_detail(int $lot_in_id)
    {
        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();

        if ($lot_in !== null) {
            return view('products.inbounds.v_inbound_detail', compact('lot_in'));
        } else {
            abort(404);
        }
    }

    public function inbound_latest_detail(int $lot_in_id)
    {
        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();
        if ($lot_in !== null) {
            $inbound_prod = InboundOrder::where('inbound_id',$lot_in_id)->paginate(3);
            return view('products.inbounds.v_inbound_latest_detail', compact('lot_in','inbound_prod'));
        } else {
            abort(404);
        }
    }


    public function edit_inbound_order(int $lot_in_id)
    {
        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();
        $master_products = MasterProduct::paginate(5);
        foreach ($master_products as $product) {
            $tags = $product->get_tags_name($product->mas_prod_id);
            $product->tags = $tags;
        }
        if ($lot_in !== null) {
            $lot_in_products = InboundOrder::where('lot_in_id', $lot_in_id)->paginate(20);
            return view('products.inbounds.v_edit_inbound_order', compact('lot_in', 'lot_in_products','master_products'));
        } else {
            abort(404);
        }
    }
}
