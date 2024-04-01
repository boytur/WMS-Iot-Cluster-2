<?php

namespace Database\Seeders;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::create([
            'wh_name' => 'WH-1',
            'wh_location' => 'Location A',
        ]);
        Warehouse::create([
            'wh_name' => 'WH-2',
            'wh_location' => 'Location B',
        ]);
        Warehouse::create([
            'wh_name' => 'WH-3',
            'wh_location' => 'Location C',
        ]);
    }
}
