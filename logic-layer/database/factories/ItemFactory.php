<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Customer;
use App\Models\Type;
use App\Models\CategorySubcategory;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'item_title' => $this->faker->words(3, true),
            'item_description' => $this->faker->paragraph,
            'item_release_date' => $this->faker->date(),
            'type_id' => Type::factory(),
            'item_barcode_ean' => $this->faker->ean13(),
            'item_barcode_upc' => $this->faker->numerify('############'),
            'item_price' => $this->faker->randomNumber(5),
            'item_price_currency' => $this->faker->currencyCode(),
            'category_subcategory_id' => CategorySubcategory::factory(),
            'item_brand' => $this->faker->company,
            'platform_id' => Platform::factory(),
        ];
    }
}
