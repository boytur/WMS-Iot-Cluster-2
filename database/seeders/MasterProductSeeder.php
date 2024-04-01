<?php

namespace Database\Seeders;

use App\Models\MasterProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $random_cat_id = rand(1, 20);
            $random_mas_prod_size = rand(1, 300);
            MasterProduct::create([
                'mas_prod_no' => "PROD$i",
                'mas_prod_barcode' => '1234567891234',
                'mas_prod_name' => "product name-SKU$i-3",
                'mas_prod_image' => 'https://placehold.co/600x400',
                'mas_prod_size' => $random_mas_prod_size,
                'cat_id' => $random_cat_id
            ]);
        }
    }
}
