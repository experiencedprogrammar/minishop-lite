<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // List of images to pick from
        $images = [
            'img/lenovo.jpeg',
            'img/hp.jpeg',
            'img/laptop.jpg',
            'img/dell.jpeg',
        ];

        // Drop old data
        Product::query()->delete();

        // Insert sample products with random images
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name'        => "Product $i",
                'price'       => rand(1000, 20000),
                'stock'       => rand(5, 50),
                'description' => "Description for product $i",
                'image'       => Arr::random($images), // pick random image
            ]);
        }
    }
}
