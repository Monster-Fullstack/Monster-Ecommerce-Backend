<?php

namespace App\Http\Controllers;

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
}
