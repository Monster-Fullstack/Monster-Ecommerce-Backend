<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function featured()
    {
        $products = Product::all()->random(6);
        $all = [];

        for ($i = 0; $i < count($products); $i++) {
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
            array_push($all, $products[$i]);

        }

        return $all;
    }

    public function newProducts()
    {
        $products = Product::orderBy("id", "desc")->get()->take(20);
        $all = [];

        for ($i = 0; $i < count($products); $i++) {
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
            array_push($all, $products[$i]);

        }

        return $all;
    }

    public function collectionProducts()
    {
        $products = Product::all()->random(15);
        $all = [];

        for ($i = 0; $i < count($products); $i++) {
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
            array_push($all, $products[$i]);

        }

        return $all;
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        $all = [];
        $category = Category::findOrFail($product->category_id)->cat_name;
        $subcategory = SubCategory::findOrFail($product->sub_cat_id)->subcat_name;
        $photos = $product->Photos;
        foreach ($photos as $photo) {
            if ($photo->main_image === 1) {
                $product["main_image"] = $photo;
            }
        }
        $all = ["cat" => $category, "sub" => $subcategory, "product" => $product];
        return $all;
    }

    public function BestSellerProducts()
    {
        $products = Product::orderBy("sells", "desc")->take(20)->get();
        $all = [];

        for ($i = 0; $i < count($products); $i++) {
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
            array_push($all, $products[$i]);

        }

        return $all;
    }

    public function UnderXDollars($price)
    {
        $string = explode("_", $price);

        $products = Product::where("price", "<=", intval($string[0]))->orderBy("price", $string[1])->take(20)->get();

        $all = [];

        for ($i = 0; $i < count($products); $i++) {
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
            array_push($all, $products[$i]);

        }

        return $all;
    }

    public function BestFor($type)
    {
        $products = Category::where("cat_name", "like", "%" . $type . "%")->first()->products;
        $all = [];
        for ($i = 0; $i < count($products); $i++) {
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
            array_push($all, $products[$i]);

        }

        return $all;
    }

    public function Premium()
    {
        $products = Product::where("premium", 1)->paginate(10);
        $all = [];

        for ($i = 0; $i < count($products); $i++) {
            $category = Category::findOrFail($products[$i]->category_id);
            $subcategory = SubCategory::findOrFail($products[$i]->sub_cat_id);
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
            array_push($all, ["cat" => $category->cat_name, "sub" => $subcategory->subcat_name, "product" => $products[$i]]);

        }

        return $all;
    }

    public function CountPremiumProducts()
    {
        $products = Product::where("premium", 1)->count();
        return $products;
    }

    public function search($key)
    {
        $products = Product::where("name", "LIKE", "%" . $key . "%")->select(array("name", "id"))->get();
        return $products;
    }

    public function searchComplete($key)
    {
        $products = Product::where("name", "LIKE", "%" . $key . "%")->get();
        $all = [];

        for ($i = 0; $i < count($products); $i++) {
            $category = Category::findOrFail($products[$i]->category_id);
            $subcategory = SubCategory::findOrFail($products[$i]->sub_cat_id);
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
            array_push($all, ["cat" => $category->cat_name, "sub" => $subcategory->subcat_name, "product" => $products[$i]]);

        }

        return $all;
    }
}
