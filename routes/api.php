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
use App\Http\Controllers\MyFatoorahController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(["verify" => true]);
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

// Verify the user
Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');
// Verify the user

// Payments
Route::get('pay/{price}', [MyFatoorahController::class, 'index'])->middleware("auth:api");
Route::get('payment/callback', [MyFatoorahController::class, 'callback']);
Route::get('payment/error', [MyFatoorahController::class, 'error']);
// Payments

// to get the image from database to the api
Route::get('photo/{photoName}', [PhotoController::class, "image"]);

// Cart Section
// get the items of the cart
Route::get("/cart", [CartController::class, "GetItems"])->middleware("auth:api");
// get the count of products in cart
Route::get("/cart/count", [CartController::class, "itemsCount"])->middleware("auth:api");
// add the product to the cart
Route::post("/cart/product", [CartController::class, "AddProduct"])->middleware("auth:api");
// add the game to the cart
Route::post("/cart/game", [CartController::class, "AddGame"])->middleware("auth:api");
// remove the product from the cart
Route::post("/cart/product/delete", [CartController::class, "RemoveProduct"])->middleware("auth:api");
// remove the game from the cart
Route::post("/cart/game/delete", [CartController::class, "RemoveGame"])->middleware("auth:api");
// Cart Section
// Orders
Route::get("/orders", [OrderController::class, "index"])->middleware("auth:api");

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
// related products
Route::get("products/related/{subcat}", [ProductController::class, "RelatedProducts"]);
// best sellers products
Route::get("products/best_sellers", [ProductController::class, "BestSellerProducts"]);
// best products under 10 dollars
Route::get("products/under/{price}", [ProductController::class, "UnderXDollars"]);
// best products under 10 dollars
Route::get("products/bestfor/{type}", [ProductController::class, "BestFor"]);
// just premium products
Route::get("products/premium", [ProductController::class, "Premium"]);
// just premium products count
Route::get("products/premium/count", [ProductController::class, "CountPremiumProducts"]);
// user favourite products
Route::get("products/favorites", [ProductController::class, "Favorite"])->middleware("auth:api");
// user favourite products
Route::get("products/favorites/add/{product_id}", [ProductController::class, "AddToFavorite"])->middleware("auth:api");
// user favourite products
Route::get("products/favorites/delete/{id}", [ProductController::class, "RemoveFavorite"])->middleware("auth:api");
// get the count of products in favs
Route::get("products/favorites/count", [ProductController::class, "FavoritesCount"])->middleware("auth:api");
// to delete all the products that in the favorites
Route::get("products/favorites/all", [ProductController::class, "RemoveAllFavorites"])->middleware("auth:api");
// product reviews
Route::get("reviews/product/{product}", [ProductController::class, "reviews"]);
// product reviews
Route::post("reviews/product", [ProductController::class, "SendReview"])->middleware("auth:api");
// edit review
Route::post("reviews/edit", [ProductController::class, "EditReview"])->middleware("auth:api");
// delete review
Route::get("reviews/delete/{review_id}", [ProductController::class, "DeleteReview"])->middleware("auth:api");
// product reviews
Route::get("reviews/is_user_payed_product/{product_id}", [ProductController::class, "IsUserPayed"])->middleware("auth:api");
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
