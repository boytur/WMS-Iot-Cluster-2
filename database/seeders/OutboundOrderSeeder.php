<?php

namespace Database\Seeders;

use App\Models\OutBoundOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutboundOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 200; $i++) {
            $outbound_amount = rand(1, 100);
            $mas_prod_id = rand(1, 100);
            $lot_in_id = rand(1, 20);

            OutBoundOrder::create([
                'outbound_amount' => $outbound_amount,
                'outbound_status' => 'Initialized',
                'outbound_exp' => '2028-01-01',
                'mas_prod_id' => $mas_prod_id,
                'lot_out_id' => $lot_in_id
            ]);
        }
    }
}
