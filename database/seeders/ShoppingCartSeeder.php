<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('buyer')->get();
        foreach ($users as $user) {
            $productAmount = rand(1, 15);
            $products = ProductDetail::inRandomOrder()->limit($productAmount)->get();
            $products = $products->map(fn ($item) => new ShoppingCart([
                'product_detail_id' => $item->id,
                'amount' => rand(1, 5),
            ]));
            $user->shoppingCart()->saveMany($products);
        }
    }
}
