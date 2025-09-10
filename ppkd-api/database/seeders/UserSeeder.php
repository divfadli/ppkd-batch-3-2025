<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin123'
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@gmail.com',
                'password' => 'operator123'
            ],
            [
                'name' => 'Paulus',
                'email' => 'paulus@gmail.com',
                'password' => 'password123'
            ],
            [
                'name' => 'Bagas',
                'email' => 'bagas@gmail.com',
                'password' => 'password123'
            ],
            [
                'name' => 'Wahyu',
                'email' => 'wahyu@gmail.com',
                'password' => 'password123'
            ]
        ];
        User::insert($users);
    }
}
