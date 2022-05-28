<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            // products with games
            $all = [];
            // the total price
            $totalPrices = [];
            // get the products
            $allProducts = DB::table("orders_products")->where("user_id", $user->id)->get();

            $products = $user->ProductOrders;

            for ($i = 0; $i < count($products); $i++) {
                $products[$i]["color"] = $allProducts[$i]->color;
                $products[$i]["quantity"] = $allProducts[$i]->quantity;
                $products[$i]["status"] = $allProducts[$i]->status;
                $total = intval($allProducts[$i]->total);
                $products[$i]["total"] = $total;
                $photos = $products[$i]->Photos;
                array_push($totalPrices, $total);
                foreach ($photos as $photo) {
                    if ($photo->main_image === 1) {
                        $products[$i]["main_image"] = $photo;
                    }
                }
                array_push($all, $products[$i]);
            }

            // get the orders of games
            $allGames = DB::table("orders_games")->where("user_id", $user->id)->get();

            // get the games
            $games = $user->GamesOrders;

            for ($i = 0; $i < count($games); $i++) {
                $total = intval($allGames[$i]->total);
                $games[$i]["status"] = $allGames[$i]->status;
                $photos = $games[$i]->Photos;
                array_push($totalPrices, $total);
                foreach ($photos as $photo) {
                    if ($photo->main_image === 1) {
                        $games[$i]["main_image"] = $photo;
                    }
                }
                array_push($all, $games[$i]);
            }

            // for calculating the total price for all products
            $total = array_sum($totalPrices);

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
}
