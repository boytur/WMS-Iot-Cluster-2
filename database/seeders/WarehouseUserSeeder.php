<?php

namespace Database\Seeders;

use App\Models\WarehouseUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WarehouseUser::create([
            "wh_id" => 1,
            'user_id' => 1
        ]);

        WarehouseUser::create([
            "wh_id" => 2,
            'user_id' => 1
        ]);
        WarehouseUser::create([
            "wh_id" => 3,
            'user_id' => 1
        ]);
        WarehouseUser::create([
            "wh_id" => 2,
            'user_id' => 2
        ]);
    }
}
