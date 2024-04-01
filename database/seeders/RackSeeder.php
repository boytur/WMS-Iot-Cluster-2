<?php

namespace Database\Seeders;

use App\Models\Rack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RackSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run()
    {
        Rack::create([
            'rack_name' => 'A',
            'rack_height' => 4,
            'rack_width' => 10,
            'wh_id' => 1
        ]);
        Rack::create([
            'rack_name' => 'B',
            'rack_height' => 4,
            'rack_width' => 15,
            "wh_id" => 1
        ]);
        Rack::create([
            'rack_name' => 'A',
            'rack_height' => 4,
            'rack_width' => 10,
            'wh_id' => 2
        ]);
        Rack::create([
            'rack_name' => 'B',
            'rack_height' => 4,
            'rack_width' => 15,
            'wh_id' => 2
        ]);
    }
}
