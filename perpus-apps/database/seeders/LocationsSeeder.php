<?php

namespace Database\Seeders;

use App\Models\Locations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefix = 'LOC-';

        for ($i = 1; $i <= 10; $i++) {
            $runningNumber = str_pad($i, 3, '0', STR_PAD_LEFT);
            $codeLocation  = $prefix . $runningNumber;

            $bookshelf = "Rak-{$i}, Lantai-{$i}";

            Locations::create([
                'code_location' => $codeLocation,
                'label'         => 'Lokasi ' . $i,
                'bookshelf'     => $bookshelf,
            ]);
        }
    }
}