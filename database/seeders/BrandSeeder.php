<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Ingelec', 'country' => 'Maroc'],
            ['name' => 'Schneider Electric', 'country' => 'France'],
            ['name' => 'Legrand', 'country' => 'France'],
            ['name' => 'Yaki', 'country' => 'Turquie'],
            ['name' => 'Philips', 'country' => 'Pays-Bas'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand + ['is_active' => true]);
        }
    }
}
