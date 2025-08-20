<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // php artisan db:seed --class=UserSeeder (Pemanggilan di terminal, terkhusus class yang diinginkan)
        // $this->call(UserSeeder::class);
        // $this->call(CategoriesSeeder::class);
        // php artisan db:seed
        $this->call([UserSeeder::class, CategoriesSeeder::class]);
    }
}