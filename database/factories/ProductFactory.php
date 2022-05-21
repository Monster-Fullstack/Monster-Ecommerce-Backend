<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $q = rand(10, 400);
        $sub_cat = SubCategory::all()->random(1)->first();
        $cat = Category::where("id", $sub_cat->category_id)->first();
        return [
            "name" => $this->faker->firstName(),
            "description" => $this->faker->paragraph(8),
            "price" => $this->faker->randomElement([rand(2.99, 44.99), rand(49.99, 3499.99)]),
            "sells" => rand(0, 250),
            "premium" => $this->faker->randomElement([0, 1]),
            "colors" => $this->faker->text(),
            "quantity" => $q,
            "sub_cat_id" => $sub_cat,
            "category_id" => $cat,
        ];
    }
}
