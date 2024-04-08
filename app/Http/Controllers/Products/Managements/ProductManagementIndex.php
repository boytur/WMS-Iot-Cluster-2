<?php

namespace App\Http\Controllers\Products\ManageMents;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MasterProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductManagementIndex extends Controller
{

    public function product_management_index()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {

                $products = MasterProduct::paginate(20);

                foreach ($products as $product) {
                    $tags = $product->get_tags_name($product->mas_prod_id);
                    $product->tags = $tags;
                }

                return view('products.managements.v_product_management_index', compact('products'));
            } else {
                return redirect('/product/inbounds');
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function edit_master_product_index($mas_prod_id)
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {

                if ($mas_prod_id !== null) {
                    $product = MasterProduct::where('mas_prod_id', $mas_prod_id)->first();

                } else {
                    return redirect('/product/managements');
                }
                return view('products.managements.v_edit_master_product', compact('product'));
            } else {
                return redirect('/product/inbounds');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function detail_master_product_index($mas_prod_id)
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {

                if ($mas_prod_id !== null) {
                    $product = MasterProduct::where('mas_prod_id', $mas_prod_id)->first();

                } else {
                    return redirect('/product/managements');
                }
                return view('products.managements.v_detail_master_product', compact('product'));
            } else {
                return redirect('/product/inbounds');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    public function add_master_product_index()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {

                return view('products.managements.v_add_new_master_product');
            } else {
                return redirect('/product/inbounds');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function search_product(Request $request)
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
                }else {
                    $Productquery->where('mas_prod_name', 'like', "%$search_key%");
                }
            }

            $products = $Productquery->get();
            foreach ($products as $product) {
                $tags = $product->get_tags_name($product->mas_prod_id);
                $product->tags = $tags;
            }
            $new_searches = [];
            foreach ($products as $search) {
                $product = Category::where('cat_id', $search->cat_id)->first();
                if ($product !== null) {
                    $new_searches[] = [
                        'mas_prod_id' => $search->mas_prod_id,
                        'mas_prod_no' => $search->mas_prod_no,
                        'mas_prod_barcode' => $search->mas_prod_barcode,
                        'mas_prod_name' => $search->mas_prod_name,
                        'mas_prod_image' => $search->mas_prod_image,
                        'mas_prod_size' => $search->mas_prod_size,
                        'cat_name' => $product->cat_name,
                        'created_at' => $search->created_at,
                        'updated_at' => $search->updated_at,
                        'tags'=>$search->tags,
                    ];
                }
            }
            return response()->json(['success' => true, 'data' => $new_searches], 200);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
