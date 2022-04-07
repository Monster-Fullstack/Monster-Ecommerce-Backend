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
            "avilable_colors" => $this->faker->text(),
            "avilable_quantity" => $q,
            "main_image" => "https://rukminim1.flixcart.com/image/416/416/kg8avm80/mobile/q/8/f/apple-iphone-12-dummyapplefsn-original-imafwg8drqaam5vu.jpeg?q=70",
            "sub_cat_id" => $sub_cat,
            "category_id" => $cat,
        ];
    }
}
