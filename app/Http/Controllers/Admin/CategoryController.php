<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function AllCategories()
    {
        // get all categories except the games category
        $cats = Category::orderBy("id", "desc")->where("cat_name", "!=", "Games")->get();
        $allCats = [];
        for ($i = 0; $i < count($cats); $i++) {
            $subs = SubCategory::where("category_id", $cats[$i]["id"])->get();
            array_push($allCats, ["main_cat" => $cats[$i], "subs_names" => $subs]);
        }

        return $allCats;
    }
    public function GetSubCategory($id)
    {
        $sub = SubCategory::findOrFail($id);
        $products = SubCategory::findOrFail($id)->products;
        $allProducts = [];

        for ($i = 0; $i < count($products); $i++) {
            $photos = $products[$i]->Photos;
            $photo = "";
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $photo = $photo->name;
                }
            }

            $products[$i]["main_image"] = $photo;
            array_push($allProducts, $products[$i]);

        }

        return ["main_cat" => $sub->subcat_name, "products" => $allProducts];
    }

    public function GetCategory($id)
    {
        $cat = Category::findOrFail($id);
        $sub = Category::findOrFail($id)->subCats;
        $all = ["main_cat" => $cat, "sub_cats" => $sub];
        return $all;
    }

    public function GetNewCats()
    {
        $cats = Category::orderBy("id", "desc")->take(14)->get();
        return ["main_cat" => $cats];
    }

    public function MostViews()
    {
        // get the games category
        $games_cat = Category::where("cat_name", "Games")->first();
        //
        $subs = SubCategory::orderBy("views", "desc")->where("category_id", "!=", $games_cat->id)->take(3)->get();
        $allSubs = [];
        for ($i = 0; $i < count($subs); $i++) {
            $products = Product::where("sub_cat_id", $subs[$i]["id"])->get()->take(3);
            for ($x = 0; $x < count($products); $x++) {
                $photos = $products[$x]->Photos;
                foreach ($photos as $photo) {
                    if ($photo->main_image === 1) {
                        $products[$x]["main_image"] = $photo;
                    }
                }
            }
            array_push($allSubs, ["sub_cat" => $subs[$i], "products" => $products]);
        }

        return $allSubs;
    }

    public function CategoriesOnly()
    {
        $cats = Category::all();
        return $cats;
    }

    public function SubCategoriesOnly()
    {
        $subs = SubCategory::all();
        return $subs;
    }

    public function GetCatAndSubCat($sub_id)
    {
        $sub = SubCategory::findOrFail($sub_id);
        $cat = Category::findOrFail($sub->category_id);
        return ["cat" => $cat->cat_name, "sub" => $sub->subcat_name];
    }

    public function GetMagicWords($cat_id)
    {
        $magics = Category::findOrFail($cat_id)->words;
        return $magics;
    }

    public function GetSubCategoryGames($sub_id)
    {
        $subcat = SubCategory::findOrFail($sub_id);
        $games = $subcat->games;
        foreach ($games as $game) {
            $photos = $game->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $game["main_image"] = $photo;
                }
            }
        }
        return ["main_cat" => $subcat->subcat_name, "games" => $games];
    }
}
