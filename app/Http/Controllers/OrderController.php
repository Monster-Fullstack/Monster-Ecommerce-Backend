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
            $all = DB::table("orders")->where("user_id", $user->id)->get();

            $products = $user->orders;
            $totalPrices = [];

            for ($i = 0; $i < count($products); $i++) {
                $products[$i]["color"] = $all[$i]->color;
                $products[$i]["quantity"] = $all[$i]->quantity;
                $products[$i]["status"] = $all[$i]->status;
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
}
