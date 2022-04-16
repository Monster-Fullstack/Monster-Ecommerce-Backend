<?php

namespace Database\Factories;

use App\Models\Category;
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
        // $category = Category::factory()
        //     ->has(MagicWords::factory()->count(3))
        //     ->create();

        return [
            "cat_name" => $this->faker->name(),
            "game" => false,
            "cat_image" => "https://shop.orange.eg/content/images/thumbs/0002700_iphone-11_550.jpeg",
        ];
    }
}
