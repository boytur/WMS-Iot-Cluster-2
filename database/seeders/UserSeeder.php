<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create User 1
        User::create([
            'number' => 100001,
            'fname' => 'พิชฌวัฒน์',
            'lname' => 'สุวรรณ',
            'image' => 'https://f005.backblazeb2.com/file/piyawatdev/429609813_261420900353601_623560574211910018_n.jpg',
            'email' => 'warehouse_manager@gmail.com',
            'phone' => '1234567890',
            'password' => Hash::make('1234567890'),
            'role' => 'warehouse_manager',
        ]);

        // Create User 2
        User::create([
            'number' => 100002,
            'fname' => 'ปิยะวัฒน์',
            'lname' => 'วงค์ญาติ',
            'image'=> 'https://f005.backblazeb2.com/file/piyawatdev/20210111_093407.jpg',
            'email' => 'normal_employee@gmail.com',
            'phone' => '0987654321',
            'password' => Hash::make('1234567890'),
            'role' => 'normal_employee',
        ]);
    }
}
