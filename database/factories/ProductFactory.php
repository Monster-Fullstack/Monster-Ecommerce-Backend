<?php

namespace Database\Factories;

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
        $price = rand(200, 800);
        $q = rand(10, 400);
        return [
            "name" => $this->faker->firstName(),
            "description" => $this->faker->paragraph(8),
            "price" => $price,
            "avilable_colors" => $this->faker->text(),
            "avilable_quantity" => $q,
            "main_image" => "https://rukminim1.flixcart.com/image/416/416/kg8avm80/mobile/q/8/f/apple-iphone-12-dummyapplefsn-original-imafwg8drqaam5vu.jpeg?q=70",
            "sub_cat_id" => SubCategory::all()->random(1)->first(),
        ];
    }
}
