<?php

namespace App\Http\Controllers\Products\ManageMents;

use App\Http\Controllers\Controller;
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
}
