<?php

namespace Database\Seeders;

use App\Models\LotIn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LotInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 20; $i++) {

            $wh_id = rand(1, 2);
            $user_id = rand(1, 2);

            LotIn::create([
                'lot_in_number' => "lotin" . time(),
                'lot_in_status' => 'Initialized',
                'wh_id' => $wh_id,
                'user_id' => $user_id
            ]);
        }
    }
}
