<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'laptop.jpg',
            'disk.jpg',
            'coffeegrinder.jpg',
            'bag.jpg',
            'makeupset.jpg',
            'mic.jpg',
            'onion.jpg',
            'shoes.jpg',
            'tumbler.jpg',
            'watch.jpg',
        ];

        foreach ($images as $image) {
            Item::factory()->create([
                'image_path' => 'storage/images/' . $image,
            ]);
        }
    }
}