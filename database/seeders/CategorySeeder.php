<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Appareillage',
                'icon' => 'heroicon-o-swatch',
                'children' => [
                    ['name' => 'Interrupteurs'],
                    ['name' => 'Prises de courant'],
                ]
            ],
            [
                'name' => 'Éclairage',
                'icon' => 'heroicon-o-light-bulb',
                'children' => [
                    ['name' => 'Ampoules LED'],
                    ['name' => 'Projecteurs'],
                    ['name' => 'Lustres'],
                ]
            ],
            [
                'name' => 'Protection Électrique',
                'icon' => 'heroicon-o-shield-check',
                'children' => [
                    ['name' => 'Disjoncteurs'],
                    ['name' => 'Coffrets Électriques'],
                ]
            ],
            [
                'name' => 'Énergie Fondamentale',
                'icon' => 'heroicon-o-sun',
                'children' => [
                    ['name' => 'Panneaux Solaires'],
                    ['name' => 'Batteries'],
                ]
            ],
        ];

        foreach ($categories as $catData) {
            $parent = Category::create([
                'name' => $catData['name'],
                'icon' => $catData['icon'] ?? null,
                'is_active' => true,
            ]);

            if (isset($catData['children'])) {
                foreach ($catData['children'] as $childData) {
                    Category::create([
                        'name' => $childData['name'],
                        'parent_id' => $parent->id,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
