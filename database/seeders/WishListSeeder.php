<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('buyer')->get();
        foreach ($users as $user) {
            $productAmount = rand(1, 15);
            $products = Product::inRandomOrder()->limit($productAmount)->get();
            $user->wishList()->sync($products);
        }
    }
}
