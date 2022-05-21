<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Game;
use App\Models\HomeSlider;
use App\Models\MagicWords;
use App\Models\Photo;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Console\Command;

class GameData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GameData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the dummy data for the gamer sections and it\'s needed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $word = MagicWords::insert([
            "word_name" => "Gamer",
        ]);

        // start crazy pc cat
        $cat1 = Category::insert([
            "cat_name" => "Crazy PC",
            "cat_image" => "https://images.unsplash.com/photo-1626218174358-7769486c4b79?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80",
        ]);

        $nvidiaSub = SubCategory::insert([
            "subcat_name" => "Nvidia",
            "views" => 2000,
            "main_image" => "https://images.unsplash.com/photo-1555618565-9f2b0323a10d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $nvidiaProducts1 = Product::insert([
            "name" => "GTX 1080 TI",
            "description" => "This the really very good card",
            "price" => 200,
            "premium" => 0,
            "colors" => "black",
            "quantity" => 300,
            "sells" => 260,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $nvidiaProducts2 = Product::insert([
            "name" => "GTX 750 TI",
            "description" => "This the really very good card",
            "price" => 60,
            "premium" => 1,
            "colors" => "black,brown",
            "quantity" => 60,
            "sells" => 55,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $processorsSub = SubCategory::insert([
            "subcat_name" => "Processors",
            "views" => 9000,
            "main_image" => "https://www.strafe.com/reviews/wp-content/uploads/sites/19/intel-cpu-blog-banner.png",
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $processorsProducts1 = Product::insert([
            "name" => "Core i9 10100",
            "description" => "This the really very good processor",
            "price" => 2500,
            "premium" => 1,
            "colors" => "black,gold",
            "quantity" => 60,
            "sells" => 45,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $processorsProducts2 = Product::insert([
            "name" => "Core i3 10100",
            "description" => "This the really very good processor",
            "price" => 120,
            "premium" => 1,
            "colors" => "black,red",
            "quantity" => 200,
            "sells" => 198,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $ramSub = SubCategory::insert([
            "subcat_name" => "Ram",
            "views" => 25000,
            "main_image" => "https://images.unsplash.com/photo-1602664474505-51c549ad15c5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $ramProducts1 = Product::insert([
            "name" => "16 GB",
            "description" => "This the really very good Ram",
            "price" => 55,
            "premium" => 1,
            "colors" => "black",
            "quantity" => 300,
            "sells" => 30,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        // end crazy pc cat
        // games cat
        $cat2 = Category::insert([
            "cat_name" => "Games",
            "game" => true,
            "cat_image" => "https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/most-popular-video-games-of-2022-1642612227.png?crop=1.00xw:1.00xh;0,0&resize=980:*",
        ]);

        $horror = SubCategory::insert([
            "subcat_name" => "Horror Games",
            "game" => true,
            "views" => 95000,
            "main_image" => "https://static1.thegamerimages.com/wordpress/wp-content/uploads/2021/04/The-10-Hardest-Horror-Games-Ranked.jpg",
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "Outlast 2",
            "description" => "This the really horror game",
            "price" => 29,
            "download_link" => "https://uploadhaven.com/download/8bdf6ce5da6055bb65af950955484f13",
            "sells" => 2500000,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Photo::insert([
            "name" => "https://cdn.akamai.steamstatic.com/steam/apps/414700/ss_391bfd739898fd31ec7fa0c0b7658f18b7202286.600x338.jpg?t=1618944453",
        ]);

        Photo::insert([
            "name" => "https://cdn.akamai.steamstatic.com/steam/apps/414700/ss_3f641157a8ca9a168260bfdaf42a753821bc71e5.600x338.jpg?t=1618944453",
        ]);

        Photo::insert([
            "name" => "https://cdn.akamai.steamstatic.com/steam/apps/414700/ss_2a2ee79384c9100469a61336937b8dba6a8a7d26.600x338.jpg?t=1618944453",
        ]);

        Photo::insert([
            "name" => "https://cdn.akamai.steamstatic.com/steam/apps/414700/ss_2a2ee79384c9100469a61336937b8dba6a8a7d26.600x338.jpg?t=1618944453",
        ]);

        Photo::insert([
            "name" => "https://cdn.akamai.steamstatic.com/steam/apps/414700/ss_2a2ee79384c9100469a61336937b8dba6a8a7d26.600x338.jpg?t=1618944453",
        ]);

        Photo::insert([
            "name" => "https://cdn.akamai.steamstatic.com/steam/apps/414700/ss_2a2ee79384c9100469a61336937b8dba6a8a7d26.600x338.jpg?t=1618944453",
        ]);

        Photo::insert([
            "name" => "https://cdn.akamai.steamstatic.com/steam/apps/414700/ss_2a2ee79384c9100469a61336937b8dba6a8a7d26.600x338.jpg?t=1618944453",
        ]);

        Photo::insert([
            "name" => "https://www.egprices.com/images/large/asus_geforce_gtx_750ti_performance.jpg",
            "main_image" => 1,
        ]);

        Game::insert([
            "name" => "Resident Evil 7",
            "description" => "This the really horror game",
            "price" => 60,
            "download_link" => "https://uploadhaven.com/download/f795e56ceebc2b47821b51d17ce27c72",
            "sells" => 1000000,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "Resident Evil 3 Remake",
            "description" => "This the really horror game",
            "price" => 60,
            "download_link" => "https://uploadhaven.com/download/9220c76742d652a9f69abeab0d8c3d85",
            "sells" => 1000000,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $action = SubCategory::insert([
            "subcat_name" => "Action Games",
            "views" => 25000,
            "game" => true,
            "main_image" => "https://images.unsplash.com/photo-1555618565-9f2b0323a10d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "The Witcher 3",
            "description" => "This the really action game",
            "price" => 40,
            "download_link" => "https://uploadhaven.com/download/18983557d6120db874d5f0f9b2b87ca9",
            "sells" => 5000000,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "assassin's creed valhalla",
            "description" => "This the really action game",
            "price" => 40,
            "download_link" => "https://uploadhaven.com/download/21e3c5f14bc4f127992c6cc914ba6756",
            "sells" => 5000000,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "shadow of the tomb raider",
            "description" => "This the really action game",
            "price" => 40,
            "download_link" => "https://uploadhaven.com/download/3055a331e34f19370fb04c833c52cba4",
            "sells" => 5000000,
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        // add those categories to magic word
        $cats = [];
        $cats[] = Category::latest("id")->get()[0]->id;
        $cats[] = Category::latest("id")->get()[1]->id;
        MagicWords::latest("id")->first()->categories()->sync($cats);
        HomeSlider::insert([
            "slider_image" => "https://images.unsplash.com/photo-1576562331281-d09e46af9854?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1332&q=80",
        ]);
        HomeSlider::insert([
            "slider_image" => "https://images.unsplash.com/photo-1578916171728-46686eac8d58?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80",
        ]);
        HomeSlider::insert([
            "slider_image" => "https://images3.alphacoders.com/108/thumb-1920-1082409.png",
        ]);
    }
}
