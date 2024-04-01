<?php

namespace Database\Seeders;

use App\Models\Space;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function create_space($shelfCount_, $rackFloorCount_, $rackNamePrefix_, $rack_id)
        {
            $shelfCount = $shelfCount_;
            $rackFloorCount = $rackFloorCount_;
            $rackNamePrefix = $rackNamePrefix_;

            for ($i = 1; $i <= $shelfCount; $i++) {
                for ($j = 1; $j <= $rackFloorCount; $j++) {
                    $rackName = $rackNamePrefix . $i . '-' . $j;
                    Space::create([
                        'space_name' => $rackName,
                        'space_capacity' => 0,
                        'rack_id' => $rack_id,
                    ]);
                }
            }
        }

        create_space(10, 4, 'A', 1);
        create_space(15, 4, 'B', 2);
        create_space(10, 4, 'A', 3);
        create_space(15, 4, 'B', 4);
    }
}
