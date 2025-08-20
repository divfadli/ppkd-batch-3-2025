<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::insert([
            ['name' => 'Junior Room', 'slug' => 'junior-room'],
            ['name' => 'Superior', 'slug' => 'superior'],
            ['name' => 'Deluxe Superior', 'slug' => 'deluxe-superior'],
            ['name' => 'Suite', 'slug' => 'suite'],
            ['name' => 'Deluxe Suite', 'slug' => 'deluxe-suite'],
            ['name' => 'Executive Suite', 'slug' => 'executive-suite'],
        ]);
    }
}