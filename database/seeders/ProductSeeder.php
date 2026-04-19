<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $ingelec = Brand::where('name', 'Ingelec')->first();
        $schneider = Brand::where('name', 'Schneider Electric')->first();
        
        $interrupteurs = Category::where('name', 'Interrupteurs')->first();
        $ampoules = Category::where('name', 'Ampoules LED')->first();
        $disjoncteurs = Category::where('name', 'Disjoncteurs')->first();

        // 1. Interrupteur Simple
        $p1 = Product::create([
            'category_id' => $interrupteurs->id,
            'brand_id' => $ingelec->id,
            'name' => 'Interrupteur Simple Tichka',
            'description' => 'Interrupteur simple Ingelec gamme Tichka, idéal pour les installations résidentielles.',
            'base_price' => 15.00,
            'status' => 'actif',
            'is_featured' => true,
        ]);

        $p1->specifications()->createMany([
            ['key' => 'Gamme', 'value' => 'Tichka'],
            ['key' => 'Type', 'value' => 'Simple'],
        ]);

        // Variants for P1 (Colors)
        $colors = AttributeValue::whereHas('attribute', fn($q) => $q->where('name', 'Couleur'))->get();
        foreach ($colors as $color) {
            $v = ProductVariant::create([
                'product_id' => $p1->id,
                'sku' => "ICHKA-S-{$color->value}",
                'price' => 15.00,
                'stock_qty' => rand(50, 200),
                'is_active' => true,
            ]);
            $v->attributeValues()->attach($color->id);
        }

        // 2. Disjoncteur
        $p2 = Product::create([
            'category_id' => $disjoncteurs->id,
            'brand_id' => $schneider->id,
            'name' => 'Disjoncteur Magneto-Thermique iC60N',
            'description' => 'Disjoncteur haute performance Schneider pour protection des circuits.',
            'base_price' => 85.00,
            'status' => 'actif',
            'is_featured' => true,
        ]);

        // Variants for P2 (Amperage)
        $amp6 = AttributeValue::create(['attribute_id' => \App\Models\Attribute::where('name', 'Ampérage')->first()->id, 'value' => '6A']);
        $amp10 = AttributeValue::where('value', '10A')->first();
        $amp16 = AttributeValue::where('value', '16A')->first();

        foreach ([$amp6, $amp10, $amp16] as $amp) {
            $v = ProductVariant::create([
                'product_id' => $p2->id,
                'sku' => "SCH-IC60-{$amp->value}",
                'price' => 85.00 + rand(0, 10),
                'stock_qty' => rand(20, 100),
                'is_active' => true,
            ]);
            $v->attributeValues()->attach($amp->id);
        }

        // 3. Ampoule LED
        $p3 = Product::create([
            'category_id' => $ampoules->id,
            'name' => 'Ampoule LED Standard E27',
            'description' => 'Ampoule LED économique haute luminosité.',
            'base_price' => 25.00,
            'status' => 'actif',
        ]);

        $pows = AttributeValue::whereHas('attribute', fn($q) => $q->where('name', 'Puissance'))->get();
        foreach ($pows as $pow) {
            $v = ProductVariant::create([
                'product_id' => $p3->id,
                'sku' => "LED-E27-{$pow->value}",
                'price' => 25.00 + (rand(1, 5) * 5),
                'stock_qty' => rand(100, 500),
                'is_active' => true,
            ]);
            $v->attributeValues()->attach($pow->id);
        }
    }
}
