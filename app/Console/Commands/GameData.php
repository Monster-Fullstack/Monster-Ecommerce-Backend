<?php

namespace App\Console\Commands;

use App\Models\Category;
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

        // start for pc games
        $cats = [];
        $cats[] = Category::latest("id")->first()->id;
        MagicWords::latest("id")->first()->categories()->sync($cats);
    }
}
