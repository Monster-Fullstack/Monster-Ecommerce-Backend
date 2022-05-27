<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\SubCategory;
use Exception;

class GameController extends Controller
{

    public function getGame($id)
    {
        try {
            $game = Game::findOrFail($id);
            $sub = SubCategory::findOrFail($game->sub_cat_id)->subcat_name;
            $photos = $game->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $game["main_image"] = $photo;
                }
            }
            $game["sub"] = $sub;
            $game["photos"] = $photos;
            return $game;
        } catch (Exception $e) {
            return response([
                "message" => $e->getMessage(),
            ]);
        }
    }

    public function getRelatedGames($id)
    {
        $game = Game::findOrFail($id);
        $sub = $game->Subcategory;
        $allGames = $sub->games->where("id", "!=", $id)->take(8);
        $games = [];
        foreach ($allGames as $game) {
            $photos = $game->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $game["main_image"] = $photo;
                }
            }
            $games[] = $game;
        }

        return $games;
    }

    public function getMayLike($id)
    {
        $games = Game::where("id", "!=", $id)->take(8)->get();
        for ($i = 0; $i < count($games); $i++) {
            $photos = $games[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $games[$i]["main_image"] = $photo;
                }
            }
        }

        return $games;
    }

    public function getFree($id)
    {
        $games = Game::where("id", "!=", $id)->where("price", 0)->get()->take(8);
        for ($i = 0; $i < count($games); $i++) {
            $photos = $games[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $games[$i]["main_image"] = $photo;
                }
            }
        }

        return $games;
    }

    public function searchGames($key)
    {
        $games = Game::where("name", "LIKE", "%" . $key . "%")->select(array("name", "id"))->get();
        for ($i = 0; $i < count($games); $i++) {
            $photos = $games[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $games[$i]["main_image"] = $photo;
                }
            }
        }
        return $games;
    }

    public function searchComplete($key)
    {
        $games = Game::where("name", "LIKE", "%" . $key . "%")->get();
        for ($i = 0; $i < count($games); $i++) {
            $photos = $games[$i]->Photos;
            foreach ($photos as $photo) {
                if ($photo->main_image === 1) {
                    $games[$i]["main_image"] = $photo;
                }
            }
        }
        return $games;
    }

}
