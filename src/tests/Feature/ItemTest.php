<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function item_index_displays_items()
    {
        $items = Item::factory()->count(2)->create();

        $response = $this->get('/items');

        $response->assertStatus(200);
        $response->assertSee($items[0]->name);
        $response->assertSee($items[1]->name);
    }

    /** @test */
    public function item_show_displays_item_details()
    {
        $item = Item::factory()->create([
            'name' => '詳細テスト商品',
            'description' => '詳細説明',
            'price' => 3500,
        ]);

        $response = $this->get(route('items.show', $item));

        $response->assertStatus(200);
        $response->assertSee('詳細テスト商品');
        $response->assertSee('詳細説明');
        $response->assertSee('￥3,500');
    }

    /** @test */
    public function item_show_returns_404_for_nonexistent_item()
    {
        $response = $this->get('/items/9999');
        $response->assertStatus(404);
    }
}