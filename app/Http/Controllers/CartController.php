<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function GetProducts()
    {
        try {
            $user = Auth::user();
            $all = DB::table("product_user")->where("user_id", $user->id)->get();

            $products = $user->products;
            $totalPrices = [];

            for ($i = 0; $i < count($products); $i++) {
                $products[$i]["color"] = $all[$i]->color;
                $products[$i]["quantity"] = $all[$i]->quantity;
                $total = intval($all[$i]->total);
                $products[$i]["total"] = $total;
                $photos = $products[$i]->Photos;
                array_push($totalPrices, $total);
                foreach ($photos as $photo) {
                    if ($photo->main_image === 1) {
                        $products[$i]["main_image"] = $photo;
                    }
                }
            }

            // for calculating the total price for all products
            $total = array_sum($totalPrices);

            return response([
                "products" => $products,
                "total" => $total,
            ]);

        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ], 401);
        }
    }

    public function AddProduct(AddToCartRequest $request)
    {
        try {
            $user = Auth::user();
            $total = $request->quantity * $request->price;
            DB::table("product_user")->insert([
                "product_id" => $request->product_id,
                "user_id" => $user->id,
                "quantity" => $request->quantity,
                "color" => $request->color,
                "total" => $total,
            ]);

            return response([
                "message" => "The product is added to the cart successfully",
            ]);

        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ], 401);
        }
    }

    public function RemoveProduct(Request $request)
    {
        $validated = $request->validate([
            "product_id" => "required",
        ]);

        try {
            $product_id = $request->product_id;
            $user = Auth::user();
            $product = DB::table("product_user")
                ->where("user_id", $user->id)
                ->where("product_id", $product_id)
                ->first();
            DB::table("product_user")->delete($product->id);

            return response([
                "message" => "The product removed successfully",
            ]);
        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ], 401);
        }
    }

    public function ProductsCount()
    {
        $user = Auth::user();
        return DB::table("product_user")->where("user_id", $user->id)->count();
    }
}
