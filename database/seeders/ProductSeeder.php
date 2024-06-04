<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = \App\Models\Product::factory(50)->make();
        $products->each(function (\App\Models\Product $product) {
            $amount = rand(1, 10);
            $tags = Tag::all()->random($amount);
            $category = Category::all()->random();
            $product->category()->associate($category);
            $product->save();
            $product->tags()->sync($tags);
        });
    }
}
