<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Game;
use App\Models\MagicWords;
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
    protected $signature = 'GamerData';

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
            "avilable_colors" => "black",
            "avilable_quantity" => 300,
            "sells" => 260,
            "main_image" => "https://m.media-amazon.com/images/I/81IdRzJZHeL._AC_SY450_.jpg",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $nvidiaProducts2 = Product::insert([
            "name" => "GTX 750 TI",
            "description" => "This the really very good card",
            "price" => 60,
            "premium" => 1,
            "avilable_colors" => "black,brown",
            "avilable_quantity" => 60,
            "sells" => 55,
            "main_image" => "https://m.media-amazon.com/images/I/51avPJeBVKL._AC_.jpg",
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
            "avilable_colors" => "black,gold",
            "avilable_quantity" => 60,
            "sells" => 45,
            "main_image" => "https://sigma-computer.com/image/products/161580903702.webp",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $processorsProducts2 = Product::insert([
            "name" => "Core i3 10100",
            "description" => "This the really very good processor",
            "price" => 120,
            "premium" => 1,
            "avilable_colors" => "black,red",
            "avilable_quantity" => 200,
            "sells" => 198,
            "main_image" => "https://m.media-amazon.com/images/I/412hZ79rMZL._AC_SY780_.jpg",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $ramSub = SubCategory::insert([
            "subcat_name" => "Ram",
            "views" => 25000,
            "main_image" => "https://images.unsplash.com/photo-1592664474505-51c549ad15c5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $ramProducts1 = Product::insert([
            "name" => "16 GB",
            "description" => "This the really very good Ram",
            "price" => 55,
            "premium" => 1,
            "avilable_colors" => "black",
            "avilable_quantity" => 300,
            "sells" => 30,
            "main_image" => "https://static.labeb.com/test/images/catalogs/93268/tybjkqb5y2b-w450.jpg",
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
            "price" => 29.99,
            "download_link" => "https://uploadhaven.com/download/8bdf6ce5da6055bb65af950955484f13",
            "sells" => 2500000,
            "main_image" => "https://cdn-cf.gamivo.com/image_cover.jpg?f=17574&n=7905723384692063.jpg&h=7404c240925023bfe92a240a3ea2b522",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "Resident Evil 7",
            "description" => "This the really horror game",
            "price" => 59.99,
            "download_link" => "https://uploadhaven.com/download/f795e56ceebc2b47821b51d17ce27c72",
            "sells" => 1000000,
            "main_image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShjqgJWuQIokNzLzSm9pGFpbJMJiit-MtVHMkgxDELmFILZAmLO46LUuuDIrQzy-yv-T0&usqp=CAU",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "Resident Evil 3 Remake",
            "description" => "This the really horror game",
            "price" => 59.99,
            "download_link" => "https://uploadhaven.com/download/9220c76742d652a9f69abeab0d8c3d85",
            "sells" => 1000000,
            "main_image" => "https://cdn.cloudflare.steamstatic.com/steam/apps/952060/header.jpg?t=1644282235",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        $action = SubCategory::insert([
            "subcat_name" => "Action Games",
            "views" => 25000,
            "game" => true,
            "main_image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_3Qh-42wV3rCSE-dtjTgAx_CgDoQIDnMqX1-mYFOcaUF9P4mXfC50b_1brpCra7Kn3sE&usqp=CAU",
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "The Witcher 3",
            "description" => "This the really action game",
            "price" => 39.99,
            "download_link" => "https://uploadhaven.com/download/18983557d6120db874d5f0f9b2b87ca9",
            "sells" => 5000000,
            "main_image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTnCvplVgyRkD8AmdStKMi6iVnrMpwuIzqyq623rnfYyR6RTmSnhYwjiqEDxcavnzAIV0c&usqp=CAU",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "assassin's creed valhalla",
            "description" => "This the really action game",
            "price" => 39.99,
            "download_link" => "https://uploadhaven.com/download/21e3c5f14bc4f127992c6cc914ba6756",
            "sells" => 5000000,
            "main_image" => "https://s1.gaming-cdn.com/images/products/6147/616x353/assassin-s-creed-valhalla-pc-game-ubisoft-connect-europe-cover.jpg",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        Game::insert([
            "name" => "shadow of the tomb raider",
            "description" => "This the really action game",
            "price" => 39.99,
            "download_link" => "https://uploadhaven.com/download/3055a331e34f19370fb04c833c52cba4",
            "sells" => 5000000,
            "main_image" => "https://cdn.cloudflare.steamstatic.com/steam/apps/750920/capsule_616x353.jpg?t=1644931091",
            "sub_cat_id" => SubCategory::latest("id")->first()->id,
            "category_id" => Category::latest("id")->first()->id,
        ]);

        // add those categories to magic word
        $cats = [];
        $cats[] = Category::latest("id")->get()[0]->id;
        $cats[] = Category::latest("id")->get()[1]->id;
        MagicWords::latest("id")->first()->categories()->sync($cats);
    }
}
