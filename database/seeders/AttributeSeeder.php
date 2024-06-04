<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = collect(['COLORS', 'SIZES']);
        $attributes->each(function ($item) {
            $attribute = new \App\Models\Attribute();
            $attribute->name = $item;
            $attribute->save();
        });
    }
}
