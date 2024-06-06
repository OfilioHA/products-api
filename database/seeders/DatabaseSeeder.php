<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AttributeSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            ProductSeeder::class,
            ProductDetailSeeder::class,
            ShoppingCartSeeder::class,
            WishListSeeder::class
        ]);
    }
}
