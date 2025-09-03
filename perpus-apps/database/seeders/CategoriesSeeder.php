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
        $categories = [
            ['name_category' => 'Fiksi'],
            ['name_category' => 'Non-Fiksi'],
            ['name_category' => 'Sejarah'],
            ['name_category' => 'Biografi'],
            ['name_category' => 'Teknologi'],
            ['name_category' => 'Sains'],
            ['name_category' => 'Agama'],
            ['name_category' => 'Pendidikan'],
            ['name_category' => 'Sastra'],
            ['name_category' => 'Komik'],
        ];

        foreach ($categories as $category) {
            Categories::create($category);
        }
    }
}