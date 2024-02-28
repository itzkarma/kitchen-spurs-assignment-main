<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Rajesh Kumar',
                'email' => 'rajesh.kumar@example.com',
                'password' => Hash::make('R@jesh@123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Priya Patel',
                'email' => 'priya.patel@example.com',
                'password' => Hash::make('Pr!ya@123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sanjay Sharma',
                'email' => 'sanjay.sharma@example.com',
                'password' => Hash::make('S@nj@y@123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meera Desai',
                'email' => 'meera.desai@example.com',
                'password' => Hash::make('M33ra@123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vikram Singh',
                'email' => 'vikram.singh@example.com',
                'password' => Hash::make('V1kr@m@123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'Jaychand Raisingh',
            //     'email' => 'jaychand.raisingh@example.com',
            //     'password' => Hash::make('R@ijay@123'),
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
