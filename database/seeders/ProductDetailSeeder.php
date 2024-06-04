<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = \App\Models\Product::all();
        $products->each(function (\App\Models\Product $product) {
            $colors = ['#000000', '#FFFFFF'];
            $sizes = ['S', 'M', 'L'];
            $colors_at = rand(0, count($colors) - 1);
            $sizes_at = rand(0, count($sizes) - 1);
            $amount = min($colors_at + 1, $sizes_at + 1);
            $selectedColors = array_slice($colors, 0, $amount);
            $selectedSizes = array_slice($sizes, 0, $amount);

            foreach ($selectedColors as $color) {
                foreach ($selectedSizes as $size) {
                    $detail = \App\Models\ProductDetail::factory()->make();
                    $product->details()->save($detail);
                    \App\Models\ProductDetailAttribute::create([
                        'product_detail_id' => $detail->id,
                        'attribute_id' => 1,
                        'value' => $color
                    ]);
                    \App\Models\ProductDetailAttribute::create([
                        'product_detail_id' => $detail->id,
                        'attribute_id' => 2,
                        'value' => $size
                    ]);
                }
            }
        });
    }
}
