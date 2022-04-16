<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\MagicWordsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// GET REQUESTS
// get visitor details
Route::get("/visitor", [VisitorController::class, "GetVisitorDetails"]);
// site info page route
Route::get("/siteinfo", [SiteInfoController::class, "AllSites"]);
// all category route
Route::get("/category", [CategoryController::class, "AllCategories"]);
// all category route
Route::get("/categories_only", [CategoryController::class, "CategoriesOnly"]);
// featured product
Route::get("/featured_products", [ProductController::class, "featured"]);
// new product
Route::get("/new_products", [ProductController::class, "newProducts"]);
// collection product
Route::get("/collection_products", [ProductController::class, "collectionProducts"]);
// details product
Route::get("/product/{id}", [ProductController::class, "getProduct"]);
// best sellers products
Route::get("products/best_sellers", [ProductController::class, "BestSellerProducts"]);
// best products under 10 dollars
Route::get("products/under/{price}", [ProductController::class, "UnderXDollars"]);
// best products under 10 dollars
Route::get("products/bestfor/{type}", [ProductController::class, "BestFor"]);
// just premium products
Route::get("products/premium", [ProductController::class, "Premium"]);
// just premium products
Route::get("products/premium/count", [ProductController::class, "CountPremiumProducts"]);
// subcategory
Route::get("/subcategory/{id}", [CategoryController::class, "GetSubCategory"]);
// subcategory games
Route::get("/subcategory-games/{id}", [CategoryController::class, "GetSubCategoryGames"]);
// most views subcategories
Route::get("/subcategories/mostviews", [CategoryController::class, "MostViews"]);
// subcategories only
Route::get("/subcategories_only", [CategoryController::class, "SubCategoriesOnly"]);
// category
Route::get("/category/{id}", [CategoryController::class, "GetCategory"]);
// new categories
Route::get("/new_categories", [CategoryController::class, "GetNewCats"]);
// magic words
Route::get("/magic_words/get_magic/{cat_id}", [CategoryController::class, "GetMagicWords"]);
// get cats of magicword
Route::get("/magic_words/get_cats/{word_name}", [MagicWordsController::class, "GetCatsByMagic"]);
// home slider
Route::resource("/home/slider", HomeSliderController::class);

// -----------------------------------------------------------------
// -----------------------------------------------------------------
// POST REQUESTS
// contact page route
Route::post("/contact", [ContactController::class, "CreateMessage"]);

// -----------------------------------------------------------------
// -----------------------------------------------------------------
