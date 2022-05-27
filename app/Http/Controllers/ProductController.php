<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * RelatedProducts
     *
     * @param request $subcat
     * @return void
     */
    public function RelatedProducts($subcat)
    {
        // to get the products randomly
        $products = Product::where("sub_cat_id", $subcat)->inRandomOrder()->limit(8)->get();

        for ($i = 0; $i < count($products); $i++) {
            $photos = $products[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $products[$i]["main_image"] = $photo;
                }
            }
        }

        return $products;
    }
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

    public function reviews(Product $product)
    {
        $reviews = DB::table("product_reviews")->where("product_id", $product->id)->get();

        $all = [];
        for ($i = 0; $i < count($reviews); $i++) {
            $reviewer = User::where("id", $reviews[$i]->user_id)->first();
            array_push($all, [
                "reviewer_name" => $reviewer->name,
                "reviewer_image" => $reviewer->profile_photo_url,
                "reviewer_comment" => $reviews[$i]->comment,
                "reviewer_rate" => $reviews[$i]->rate,
            ]);
        }

        return $all;
    }

    public function IsUserPayed($product_id)
    {
        $user = Auth::user();
        $checkPayed = DB::table("orders")
            ->where("user_id", $user->id)
            ->where("product_id", $product_id)
            ->first() ? true : false;
        $checkThisIsFirstComment = DB::table("product_reviews")
            ->where("user_id", $user->id)
            ->where("product_id", $product_id)
            ->first() ? false : true;
        // the user can post a review
        if ($checkPayed && $checkThisIsFirstComment) {
            return 1;
        } else {
            return 0;
        }
    }

    public function SendReview(ReviewRequest $request)
    {
        $user = Auth::user();
        $check = $this->IsUserPayed($request->product_id);

        if ($check) {
            DB::table("product_reviews")->insert([
                "product_id" => $request->product_id,
                "user_id" => $user->id,
                "comment" => $request->comment,
                "rate" => $request->rate,
            ]);

            return response([
                "message" => "Your review has been sent successfully",
            ]);
        } else {
            return response([
                "message" => "Your can't send your review, buy this product first",
            ]);
        }

    }

    public function EditReview(ReviewRequest $request)
    {
        $user = Auth::user();
        try {
            DB::table("product_reviews")
                ->where("user_id", $user->id)
                ->where("product_id", $request->product_id)
                ->update([
                    "comment" => $request->comment,
                    "rate" => $request->rate,
                ]);
            return response([
                "message" => "Your review has been updated successfully!",
            ]);
        } catch (Exception $error) {
            return response([
                "message" => $error->getMessage(),
            ]);
        }
    }

    public function DeleteReview($review_id)
    {
        DB::table("product_reviews")->delete($review_id);
        return response([
            "message" => "Your review has been deleted successfully!",
        ]);
    }

    public function Favorite()
    {
        $user = Auth::user();
        $all = [];
        foreach ($user->ProductsFavorites as $product) {
            $category = Category::findOrFail($product->category_id);
            $subcategory = SubCategory::findOrFail($product->sub_cat_id);

            $photos = $product->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $product["main_image"] = $photo;
                }
            }
            array_push($all, ["cat" => $category->cat_name, "sub" => $subcategory->subcat_name, "product" => $product]);
        }
        return $all;
    }

    public function AddToFavorite($product_id)
    {
        $user = Auth::user();

        try {
            $checkIfUserAlreadyHaveInFavorites = DB::table("products_favorites")->where("user_id", $user->id)->where("product_id", $product_id)->exists();
            if (!$checkIfUserAlreadyHaveInFavorites) {
                DB::table("products_favorites")->insert([
                    "user_id" => $user->id,
                    "product_id" => $product_id,
                ]);

                return response([
                    "message" => "The product is added to your favourites successfully",
                ]);
            } else {
                return response([
                    "message" => "This product is already in your favourites!",
                ], 401);
            }
        } catch (Exception $error) {
            return response([
                "message" => $error->getMessage(),
            ]);
        }
    }

    public function RemoveFavorite($id)
    {
        DB::table("products_favorites")->delete($id);

        return response([
            "message" => "The product is removed from your favourites successfully",
        ]);
    }

    public function FavoritesCount()
    {
        $user = Auth::user();
        $favs = DB::table("products_favorites")->where("user_id", $user->id)->count();
        return $favs;
    }

    public function RemoveAllFavorites()
    {
        $user = Auth::user();
        try {
            DB::table("products_favorites")->where("user_id", $user->id)->delete();
            return response([
                "message" => "All the products have been removed from your favourites successfully",
            ]);
        } catch (Exception $error) {
            return response([
                "message" => $error->getMessage(),
            ]);
        }
    }

}
