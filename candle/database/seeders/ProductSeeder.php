<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Spiced Mint',
            'price' => 9.99,
            'image' => 'images/spiced_mint.jpg',
        ]);

        Product::create([
            'name' => 'Sweet Strawberry',
            'price' => 9.99,
            'image' => 'images/sweet_strawberry.jpg',
        ]);

        Product::create([
            'name' => 'Cool Blueberries',
            'price' => 9.99,
            'image' => 'images/cool_blueberries.jpg',
        ]);

        Product::create([
            'name' => 'Juicy Lemon',
            'price' => 9.99,
            'image' => 'images/juicy_lemon.jpg',
        ]);
    }
}
