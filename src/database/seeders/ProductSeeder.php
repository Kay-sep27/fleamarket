<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'バナナ',
            'price' => 150,
            'description' => '甘くておいしいバナナ',
            'image' => 'banana.png',
        ]);

        Product::create([
            'name' => 'いちご',
            'price' => 300,
            'description' => '酸味と甘さのバランスが良い',
            'image' => 'strawberry.png',
        ]);

        Product::create([
            'name' => 'ピーチ',
            'price' => 250,
            'description' => 'ジューシーで香り高い桃',
            'image' => 'peach.png',
        ]);
    }
}