<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sub_cat = SubCategory::all()->random(1)->first();
        $cat = Category::where("id", $sub_cat->category_id)->first();

        return [
            "name" => $this->faker->name(),
            "description" => $this->faker->paragraph(),
            "price" => rand(14.99, 59.99),
            "sells" => rand(1000, 9000000),
            "main_image" => "https://image.api.playstation.com/cdn/EP0102/CUSA09171_00/Vl6kGbTmofHzUHT8hsEmv8zQfkr4DpDN.png",
            "download_link" => $this->faker->paragraph(1),
            "sub_cat_id" => $sub_cat,
            "category_id" => $cat,
        ];
    }
}
