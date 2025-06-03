<?php

namespace Database\Factories;

use App\Models\CategorySubcategory;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategorySubcategoryFactory extends Factory
{
    protected $model = CategorySubcategory::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'subcategory_id' => Subcategory::factory(),
        ];
    }
}
