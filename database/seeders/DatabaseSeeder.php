<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use App\Models\MagicWords;
use App\Models\Notification;
use App\Models\Product;
use App\Models\SiteInfo;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create();
        SiteInfo::factory(1)->create();
        $cats = Category::factory(50)->create();
        SubCategory::factory(100)->create();
        Product::factory(800)->create();
        Game::factory(300)->create();
        MagicWords::factory(100)->create();
        foreach ($cats as $cat) {
            $words_ids = [];
            $words_ids[] = MagicWords::all()->random()->id;
            $words_ids[] = MagicWords::all()->random()->id;
            $words_ids[] = MagicWords::all()->random()->id;
            $cat->words()->sync($words_ids);
        }
        Notification::factory(300)->create();
    }
}
