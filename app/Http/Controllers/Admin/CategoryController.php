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
        $cats = Category::orderBy("id", "desc")->get();
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
        $all = ["main_cat" => $sub->subcat_name, "products" => $products];
        return $all;
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
        $subs = SubCategory::orderBy("views", "desc")->take(3)->get();
        $allSubs = [];
        for ($i = 0; $i < count($subs); $i++) {
            $products = Product::where("sub_cat_id", $subs[$i]["id"])->get()->take(3);
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
        return ["main_cat" => $subcat->subcat_name, "products" => $games];
    }
}
