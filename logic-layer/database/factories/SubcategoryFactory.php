<?php

namespace Database\Factories;

use App\Models\Subcategory;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    protected $model = Subcategory::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'subcategory_title' => $this->faker->words(2, true),
        ];
    }
}
