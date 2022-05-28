<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddGamesToCartRequest;
use App\Http\Requests\AddToCartRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function GetItems()
    {
        try {
            $user = Auth::user();
            $all = [];

            $allProducts = DB::table("product_user")->where("user_id", $user->id)->get();

            $products = $user->products;

            $totalPrice = [];

            for ($i = 0; $i < count($products); $i++) {
                $products[$i]["color"] = $allProducts[$i]->color;
                $products[$i]["quantity"] = $allProducts[$i]->quantity;
                $total = intval($allProducts[$i]->total);
                $products[$i]["total"] = $total;
                $photos = $products[$i]->Photos;
                array_push($totalPrice, $total);
                foreach ($photos as $photo) {
                    if ($photo->main_image === 1) {
                        $products[$i]["main_image"] = $photo;
                    }
                }

                array_push($all, $products[$i]);
            }

            // all games that exists in the cart
            $games = $user->games;

            // loop to get prices and put them in the $totalPrices
            for ($i = 0; $i < count($games); $i++) {
                $total = intval($games[$i]->price);
                $photos = $games[$i]->Photos;
                array_push($totalPrice, $total);
                foreach ($photos as $photo) {
                    if ($photo->main_image === 1) {
                        $games[$i]["main_image"] = $photo;
                    }
                }
                array_push($all, $games[$i]);
            }

            // for calculating the total price for all products & games
            $total = array_sum($totalPrice);

            // return the items [ games, products ] and the total
            return response([
                "all" => $all,
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

    public function AddGame(AddGamesToCartRequest $request)
    {
        try {
            $user = Auth::user();
            $total = $request->price;
            DB::table("game_user")->insert([
                "game_id" => $request->game_id,
                "user_id" => $user->id,
                "total" => $total,
            ]);

            return response([
                "message" => "The game is added to the cart successfully",
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
            DB::table("product_user")
                ->where("user_id", $user->id)
                ->where("product_id", $product_id)
                ->delete();

            return response([
                "message" => "The product removed successfully",
            ]);
        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ], 401);
        }
    }

    public function RemoveGame(Request $request)
    {
        $validated = $request->validate([
            "game_id" => "required",
        ]);

        try {
            $game_id = $request->game_id;
            $user = Auth::user();

            DB::table("game_user")
                ->where("user_id", $user->id)
                ->where("game_id", $game_id)
                ->delete();

            return response([
                "message" => "The game removed successfully",
            ]);
        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ], 401);
        }
    }

    public function itemsCount()
    {
        $user = Auth::user();
        $products = DB::table("product_user")->where("user_id", $user->id)->count();
        $games = DB::table("game_user")->where("user_id", $user->id)->count();

        // calc them
        $total = $products + $games;
        return $total;
    }
}
