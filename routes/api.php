<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\MagicWordsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Start Authentication Routes
// Login Route
Route::post("/login", [AuthController::class, "Login"]);
// Register Route
Route::post("/register", [AuthController::class, "Register"]);
// Forget Route
Route::post("/forget", [AuthController::class, "Forget"]);
// Reset Route
Route::post("/reset", [AuthController::class, "Reset"]);
// Reset Route
Route::post("/logout", [AuthController::class, "Logout"]);
// to get the user data by the user token
Route::get("/user", [AuthController::class, "UserData"])->middleware("auth:api");
// End Authentication Routes

// Cart Section
// get the products of the cart
Route::get("/cart", [CartController::class, "GetProducts"])->middleware("auth:api");
// get the count of products in cart
Route::get("/cart/count", [CartController::class, "ProductsCount"])->middleware("auth:api");
// add the product to the cart
Route::post("/cart", [CartController::class, "AddProduct"])->middleware("auth:api");
// remove the product from the cart
Route::post("/cart_delete", [CartController::class, "RemoveProduct"])->middleware("auth:api");
// Cart Section

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
/**
 * Games
 */
// details game
Route::get("/game/{id}", [GameController::class, "getGame"]);
// related games
Route::get("games/related/{id}", [GameController::class, "getRelatedGames"]);
// may like games
Route::get("games/maylike/{id}", [GameController::class, "getMayLike"]);
// may like games
Route::get("games/free/{id}", [GameController::class, "getFree"]);
/**
 * Products
 */
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
/**
 * Sub Category
 */
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
// notifications
Route::get("/notifications", [NotificationController::class, "history"]);
// search products api
Route::get("/search/{key}", [ProductController::class, "search"]);
// search games api
Route::get("/search_games/{key}", [GameController::class, "searchGames"]);
// search for the everything in product
Route::get("/search_product/{key}", [ProductController::class, "searchComplete"]);
// search for the everything in game
Route::get("/search_game/{key}", [GameController::class, "searchComplete"]);

// home slider
Route::resource("/home/slider", HomeSliderController::class);

// -----------------------------------------------------------------
// -----------------------------------------------------------------
// POST REQUESTS
// contact page route
Route::post("/contact", [ContactController::class, "CreateMessage"]);

// -----------------------------------------------------------------
// -----------------------------------------------------------------
