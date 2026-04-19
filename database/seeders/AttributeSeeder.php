<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Couleur',
                'type' => 'color',
                'values' => [
                    ['value' => 'Blanc', 'color_code' => '#FFFFFF'],
                    ['value' => 'Noir', 'color_code' => '#000000'],
                    ['value' => 'Gris', 'color_code' => '#808080'],
                    ['value' => 'Or', 'color_code' => '#FFD700'],
                ]
            ],
            [
                'name' => 'Ampérage',
                'type' => 'select',
                'values' => [
                    ['value' => '10A'],
                    ['value' => '16A'],
                    ['value' => '20A'],
                    ['value' => '32A'],
                ]
            ],
            [
                'name' => 'Puissance',
                'type' => 'select',
                'values' => [
                    ['value' => '9W'],
                    ['value' => '12W'],
                    ['value' => '18W'],
                    ['value' => '50W'],
                    ['value' => '100W'],
                ]
            ],
            [
                'name' => 'Tension',
                'type' => 'select',
                'values' => [
                    ['value' => '220V'],
                    ['value' => '380V'],
                    ['value' => '12V'],
                ]
            ],
        ];

        foreach ($attributes as $attrData) {
            $attribute = Attribute::create([
                'name' => $attrData['name'],
                'type' => $attrData['type'],
                'is_filterable' => true,
                'is_visible' => true,
            ]);

            foreach ($attrData['values'] as $valData) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'value' => $valData['value'],
                    'color_code' => $valData['color_code'] ?? null,
                ]);
            }
        }
    }
}
