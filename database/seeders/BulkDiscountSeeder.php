<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class BulkDiscountSeeder extends Seeder
{
    public function run(): void
    {
        $sampleTiers = [
            [
                'min_qty' => 5,
                'discount_percent' => 5,
                'label' => '5+ units (5% OFF)',
            ],
            [
                'min_qty' => 10,
                'discount_percent' => 10,
                'label' => '10+ units / 10kg (10% Bulk OFF)',
            ],
            [
                'min_qty' => 20,
                'discount_percent' => 15,
                'label' => '20+ units (15% Bulk OFF)',
            ],
        ];

        $products = Product::all();
        foreach ($products as $product) {
            $product->bulk_discounts = $sampleTiers;
            $product->save();
        }
    }
}
