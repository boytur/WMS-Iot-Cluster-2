<?php

namespace App\Http\Controllers\Products\Managements;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\MasterProduct;
use App\Models\Tag;



class CreateNewMasterProduct extends Controller
{

    public function create()
    {

        try {
            $master_products = MasterProduct::all();
            $categories = Category::paginate(20);
            $tags = Tag::paginate(10);

            $max = MasterProduct::orderBy('mas_prod_id', 'ASC')->limit(1)->get();

            return view('products.managements.v_add_new_master_product', compact('master_products', 'categories', 'tags',));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $max = MasterProduct::orderBy('mas_prod_id', 'DESC')->first();;

        $max_id = $max->mas_prod_no;
        $max_id = substr($max_id, 4);

        $new_mas_prod_id = $max_id + 1;

        $mas_prod_barcode = $request->input('mas_prod_barcode');
        $mas_prod_name = $request->input('mas_prod_name');
        $cat_id = $request->input('cat_id');
        $mas_prod_size = $request->input('mas_prod_size');
        $mas_prod_tags = $request->input('mas_prod_tags');
        $mas_prod_no = 'PROD' . $new_mas_prod_id;

        $request->validate([
            'mas_prod_image' => 'nullable|mimes:png,jpg,jpeg,webp'
        ]);

        $mas_prod_image = null;
        $path = null;

        if ($request->has('mas_prod_image')) {
            $file = $request->file('mas_prod_image');
            $extension = $file->getClientOriginalExtension();
            $mas_prod_image = time() . '.' . $extension;
            $path = 'public/assets/';
            $file->move($path, $mas_prod_image);
        }

        MasterProduct::create([


            'mas_prod_no' => $mas_prod_no,
            'mas_prod_barcode' => $mas_prod_barcode,
            'mas_prod_name' => $mas_prod_name,
            'cat_id' => $cat_id,
            'mas_prod_size' => $mas_prod_size,
            'mas_prod_image' => $path . $mas_prod_image

        ]);

        return redirect('/product/managements/add-new-product');
    }
}
