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
}
