<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Customer;
use App\Models\Type;
use App\Models\CategorySubcategory;
use App\Models\Platform;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;
    public $url = '10.150.56.50';
    /** @test */
    public function it_lists_all_items()
    {
        Item::factory()->count(3)->create();

        $response = $this->getJson("{$this->url}/api/items");

        $response->assertOk()
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_shows_a_single_item()
    {
        $item = Item::factory()->create();

        $response = $this->getJson("{$this->url}/api/items/{$item->id}");

        $response->assertOk()
                 ->assertJsonFragment(['id' => $item->id]);
    }

    /** @test */
    public function it_creates_a_new_item()
    {
        $customer = Customer::factory()->create();
        $type = Type::factory()->create();
        $category = CategorySubcategory::factory()->create();
        $platform = Platform::factory()->create();

        $payload = [
            'customer_id' => $customer->customer_id,
            'item_title' => 'Test Item',
            'item_description' => 'Test description',
            'item_release_date' => now()->toDateString(),
            'type_id' => $type->type_id,
            'item_barcode_ean' => '1234567890123',
            'item_barcode_upc' => '123456789012',
            'item_price' => 19.99,
            'item_price_currency' => 'USD',
            'category_subcategory_id' => $category->category_subcategory_id,
            'item_brand' => 'Test Brand',
            'platform_id' => $platform->id,
        ];

        $response = $this->postJson("{$this->url}/api/items", $payload);

        $response->assertCreated()
                 ->assertJsonFragment(['item_title' => 'Test Item']);
    }

    /** @test */
    public function it_updates_an_item()
    {
        $item = Item::factory()->create();
        $customer = Customer::factory()->create();

        $response = $this->putJson("{$this->url}/api/items/{$item->id}", [
            'customer_id' => $customer->customer_id,
            'item_title' => 'Updated Title',
        ]);

        $response->assertOk()
                 ->assertJsonFragment(['item_title' => 'Updated Title']);
    }

    /** @test */
    public function it_deletes_an_item()
    {
        $item = Item::factory()->create();

        $response = $this->deleteJson("{$this->url}/api/items/{$item->id}");

        $response->assertOk()
                 ->assertJson(['message' => 'Item deleted successfully']);

        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
