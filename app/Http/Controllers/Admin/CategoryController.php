<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function AllCategories()
    {
        $cats = Category::all();
        $allCats = [];
        for ($i = 0; $i < count($cats); $i++) {
            $subs = SubCategory::where("cat_name", $cats[$i]["cat_name"])->get();
            array_push($allCats, ["cat_name" => $cats[$i], "subs_names" => $subs]);
        }

        return $allCats;
    }

}
