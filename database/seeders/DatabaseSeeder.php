<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use App\Models\MagicWords;
use App\Models\Notification;
use App\Models\Photo;
use App\Models\Product;
use App\Models\SiteInfo;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $photo = Photo::create([
            "name" => "https://cdn.elbadrgroupeg.store/image/cache/catalog/Gigabyte/TyokNalOaCm1SLDngEwFIa1QPuPEHS-1000x1000.png",
        ]);
        foreach (Product::all() as $product) {
            DB::table("photoables")->insert([
                "photo_id" => $photo->id,
                "photoable_id" => $product->id,
                "photoable_type" => "App\Models\Product",
            ]);
        }

        $photo2 = Photo::create([
            "name" => "https://m.media-amazon.com/images/I/81TzR9+1IXL._AC_SL1500_.jpg",
        ]);
        foreach (Product::all() as $product) {
            DB::table("photoables")->insert([
                "photo_id" => $photo2->id,
                "photoable_id" => $product->id,
                "photoable_type" => "App\Models\Product",
            ]);
        }
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
