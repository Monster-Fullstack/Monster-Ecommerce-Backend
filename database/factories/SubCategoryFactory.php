<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "category_id" => Category::all()->random(1)->first(),
            "views" => rand(50, 80000),
            "game" => false,
            "subcat_name" => $this->faker->name(),
            "main_image" => "https://images7.alphacoders.com/439/thumb-1920-439636.jpg",
        ];
    }
}
