<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

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
        return $products;
    }

    public function newProducts()
    {
        $newProduct = Product::orderBy("id", "desc")->get()->take(20);
        return $newProduct;
    }

    public function collectionProducts()
    {
        $products = Product::all()->random(15);
        return $products;
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    public function BestSellerProducts()
    {
        $products = Product::orderBy("sells", "desc")->take(20)->get();
        return $products;
    }

    public function UnderXDollars($price)
    {
        $string = explode("_", $price);

        $products = Product::where("price", "<=", intval($string[0]))->orderBy("price", $string[1])->take(20)->get();
        return $products;
    }

    public function BestFor($type)
    {
        $products = Category::where("cat_name", "like", "%" . $type . "%")->first()->products;
        return $products;
    }
}
