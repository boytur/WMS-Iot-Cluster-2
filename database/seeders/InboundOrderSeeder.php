<?php

namespace Database\Seeders;

use App\Models\InboundOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InboundOrderSeeder extends Seeder
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

            InboundOrder::create([
                'inbound_amount' => $outbound_amount,
                'inbound_status' => 'Initialized',
                'inbound_exp' => '2028-01-01',
                'mas_prod_id' => $mas_prod_id,
                'lot_in_id' => $lot_in_id
            ]);
        }
    }
}
