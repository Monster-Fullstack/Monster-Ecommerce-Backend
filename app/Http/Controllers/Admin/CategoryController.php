<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function AllCategories()
    {
        $cats = Category::orderBy("id", "desc")->get();
        $allCats = [];
        for ($i = 0; $i < count($cats); $i++) {
            $subs = SubCategory::where("category_id", $cats[$i]["id"])->get();
            array_push($allCats, ["cat_name" => $cats[$i], "subs_names" => $subs]);
        }

        return $allCats;
    }

    public function GetSubCategory($id)
    {
        $sub = SubCategory::findOrFail($id);
        $products = SubCategory::findOrFail($id)->products;
        $all = ["cat_name" => $sub->subcat_name, "products" => $products];
        return $all;
    }

    public function GetCategory($id)
    {
        $cat = Category::findOrFail($id);
        $sub = Category::findOrFail($id)->subCats;
        $all = ["cat_name" => $cat, "sub_cats" => $sub];
        return $all;
    }

}
