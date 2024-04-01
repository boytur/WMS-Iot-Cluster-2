<?php

namespace Database\Seeders;

use App\Models\LotOut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LotOutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {

            $wh_id = rand(1, 2);
            $user_id = rand(1, 2);

            LotOut::create([
                'lot_out_number' => "lotout" . time(),
                'lot_out_status' => 'Initialized',
                'wh_id' => $wh_id,
                'user_id' => $user_id
            ]);
        }
    }
}
