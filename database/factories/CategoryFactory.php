<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "cat_name" => $this->faker->name(),
            "cat_image" => "https://shop.orange.eg/content/images/thumbs/0002700_iphone-11_550.jpeg",
        ];
    }
}
