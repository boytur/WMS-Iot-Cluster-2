<?php

namespace App\Http\Controllers\Products\Inbounds;

use App\Http\Controllers\Controller;
use App\Models\InboundOrder;
use App\Models\LotIn;
use App\Models\OnShelfProduct;
use App\Models\User;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
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
                $lot_in_products = LotIn::where('wh_id', Session::get('user_warehouse'))
                    ->where('lot_in_status', "Initialized")
                    ->paginate(20);

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


    //เรียกดูรายการสินค้าภายในล็อต
    public function inbound_detail(int $lot_in_id)
    {
        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();
        $onshelf_prod = OnShelfProduct::All();
        if ($lot_in !== null) {
            $inbound_products = InboundOrder::where('lot_in_id', $lot_in_id)->paginate(5);
            $inbound_ids = $inbound_products->map(function ($item) {
                return $item->inbound_id;
            });
            $first_inbound_product = $inbound_products->first();
            $type = '';//เก็บรูปแแบบที่ต้องการแสดง

            //เงื่อนไขเพื่อเช็คว่ารายการสินค้าถูกจัดเก็บหรือยัง
            if ($status_onshelf = $onshelf_prod->where('inbound_id', $first_inbound_product->inbound_id)->first()) {//เทียบไอดีของสินค้าในตารางล็อตกับตารางสินค้าที่ถูกจัดเก็บ
                $product = $onshelf_prod->whereIn('inbound_id', $inbound_ids);//รายการสินค้าที่ถูกจัดเก็บ
                $type = 'onshelf';
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $perPage = 5;
                $currentPageSearchResults = $product->slice(($currentPage - 1) * $perPage, $perPage)->all();
                $product = new LengthAwarePaginator($currentPageSearchResults, count($product), $perPage);

                return view('products.inbounds.v_inbound_detail', compact('lot_in', 'product', 'type'));
            } else {
                $product = $inbound_products;
                $type = 'inbound';
                return view('products.inbounds.v_inbound_detail', compact('lot_in', 'product', 'type'));
            }
        } else {
            abort(404);
        }

    }
    function cancel_on_shelf(Request $request){
        $payload =$request->json()->all();
        $note = $payload[1];
        $on_id = $payload[0];
        $on_prod = OnShelfProduct::where('on_prod_id',$on_id);
        $on_prod->update([
            'on_prod_status'=>'Fail',
            'on_prod_note'=>$note,
        ]);
        return response(200);
    }
    function confrim_on_shelf(Request $request){
        $payload =$request->json()->all();
        $on_id = $payload[0];
        $on_prod = OnShelfProduct::where('on_prod_id',$on_id);
        $on_prod->update([
            'on_prod_status'=>'Onshelf',
        ]);
        return response(200);
    }
    public function Closed_lot_in(Request $request)
    {
        $payload = $request->json()->all();
        $lot_in=LotIn::where('lot_in_id',$payload[0]);
        $lot_in->update(['lot_in_status'=>'closed']);
        $lot_in_id=$payload[0];
        return response()->json(['success' => true, 'data' => $lot_in_id], 200);
    }

    public function inbound_latest_detail(int $lot_in_id)
    {
        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();
        if ($lot_in !== null) {
            $inbound_prod = InboundOrder::where('lot_in_id', $lot_in_id)->paginate(5);
            return view('products.inbounds.v_inbound_latest_detail', compact('lot_in', 'inbound_prod'));
        } else {
            abort(404);
        }
    }


    public function edit_inbound_order(int $lot_in_id)
    {
        $lot_in = LotIn::where('lot_in_id', $lot_in_id)->first();
        $products = MasterProduct::all();

        if ($lot_in !== null) {
            $lot_in_products = InboundOrder::where('lot_in_id', $lot_in_id)->paginate(20);
            return view('products.inbounds.v_edit_inbound_order', compact('lot_in', 'lot_in_products', 'products'));
        } else {
            abort(404);
        }
    }
    public function search_product_lot_in(Request $request)
    {
        try {
            $search_key = $request->input('search_key');
            $search_attribute = $request->input('search_attribute');

            $Productquery = MasterProduct::query();

            if (!empty($search_key)) {
                if ($search_attribute === 'mas_prod_barcode') {
                    $Productquery->where('mas_prod_barcode', 'like', "%$search_key%");
                } elseif ($search_attribute === 'mas_prod_no') {
                    $Productquery->where('mas_prod_no', 'like', "%$search_key%");
                } else {
                }
            }

            $products = $Productquery->get();
            foreach ($products as $product) {
                $tags = $product->get_tags_name($product->mas_prod_id);
                $product->tags = $tags;
            }
            $cats = Category::all();
            // $new_searches = [];
            // foreach ($products as $search) {
            //     $product = Category::where('cat_id', $search->cat_id)->first();
            //     if ($product !== null) {
            //         $new_searches[] = [
            //             'mas_prod_id' => $search->mas_prod_id,
            //             'mas_prod_no' => $search->mas_prod_no,
            //             'mas_prod_barcode' => $search->mas_prod_barcode,
            //             'mas_prod_name' => $search->mas_prod_name,
            //             'mas_prod_image' => $search->mas_prod_image,
            //             'mas_prod_size' => $search->mas_prod_size,
            //             'cat_name' => $product->cat_name,
            //             'created_at' => $search->created_at,
            //             'updated_at' => $search->updated_at,
            //             'tags'=>$search->tags,
            //         ];
            //     }
            // }
            return response()->json(['success' => true, 'data' => $products, 'cats' => $cats], 200);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
