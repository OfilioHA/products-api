<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = Review::factory(50)->make();
        $users = User::role('buyer');
        $reviews->map(function (Review $review) use ($users) {
            $product = Product::inRandomOrder()->first();
            $user = $users->inRandomOrder()->first();
            $review->user_id = $user->id;
            $review->product_id = $product->id;
            $review->save();
        });
    }
}
