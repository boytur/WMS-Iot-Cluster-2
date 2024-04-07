<?php

namespace App\Http\Controllers\Products\Outbounds;

use App\Http\Controllers\Controller;
use App\Models\LotOut;
use App\Models\User;
use App\Models\MasterProduct;
use Database\Seeders\OutboundOrderSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\OutBoundOrder;

class OutboundIndex extends Controller
{
    public function outbound_index()
    {
        try {
            if (Auth::check()) {
                $lotouts = LotOut::where('wh_id', Session::get('user_warehouse'))->paginate(20);
                return view('products.outbounds.v_outbound_index', compact('lotouts'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function search_lot_out(Request $request)
    {
        try {

            $lot_search = $request->input('lot_out_search');
            $lot_type = $request->input('lot_out_type');
            $lot_status = $request->input('lot_out_status');

            $query = LotOut::query();

            $query->where('wh_id', Session::get('user_warehouse'));
            if (!empty($lot_search)) {
                if ($lot_type === 'lot_out_number') {
                    $query->where('lot_out_number', 'like', "%$lot_search%");
                } elseif ($lot_type === 'lot_out_creater') {
                    $query->whereHas('users', function ($q) use ($lot_search) {
                        $q->where('number', 'like', "%$lot_search%");
                    });
                }
            }

            if (empty($lot_search)) {
                if ($lot_status === 'lot_out_all_status') {

                } elseif ($lot_status === 'lot_out_intialize') {
                    $query->where('lot_out_status', 'like', "%$lot_search%");

                } else {
                    $query->where('lot_out_status', 'like', "%$lot_search%");
                }
            }
            $searches = $query->paginate(10);

            $count = $query->get()->count();
            $new_searches = [];
            foreach ($searches as $search) {
                $user = User::where('id', $search->user_id)->first();
                if ($user !== null) {
                    $new_searches[] = [
                        'lot_out_id' => $search->lot_out_id,
                        'lot_out_number' => $search->lot_out_number,
                        'lot_out_status' => $search->lot_out_status,
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
    public function create_outbound_order()
    {
        try {

            $master_products = MasterProduct::paginate(20);
            return view('products.outbounds.v_create_outbound_order', compact('master_products'));

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function latest_outbound_order()
    {
        try {
            if (Auth::check()) {
                $lotouts = LotOut::where('wh_id', Session::get('user_warehouse'))->paginate(20);
                return view('products.outbounds.v_view_outbound_latest', compact('lotouts'));
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function outbound_latest_detail(int $lot_out_id)
    {
        $lot_out = LotOut::where('lot_out_id', $lot_out_id)->first();

        if ($lot_out !== null) {
            return view('products.outbounds.v_view_outbound_latest_detail', compact('lot_out'));
        } else {
            abort(404);
        }
    }
    public function outbound_detail(int $lot_out_id)
    {
        $lot_out = LotOut::where('lot_out_id', $lot_out_id)->first();

        if ($lot_out !== null) {
            return view('products.outbounds.v_outbound_detail', compact('lot_out'));
        } else {
            abort(404);
        }
    }

    public function edit_outbound_order(int $lot_out_id)
    {
        $lot_out = LotOut::where('lot_out_id', $lot_out_id)->first();

        if ($lot_out !== null) {
            $lot_out_prod = OutBoundOrder::where('lot_out_id', $lot_out_id)->paginate(20);
            return view('products.outbounds.v_edit_outbound_order', compact('lot_out', 'lot_out_prod'));
        } else {
            abort(404);
        }
    }
}
