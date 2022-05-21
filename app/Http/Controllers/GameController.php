<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\SubCategory;

class GameController extends Controller
{

    public function getGame($id)
    {
        $game = Game::findOrFail($id);
        $sub = SubCategory::findOrFail($game->sub_cat_id)->subcat_name;
        $photos = $game->Photos;
        $game["sub"] = $sub;
        $game["photos"] = $photos;
        return $game;
    }

    public function getRelatedGames($id)
    {
        $game = Game::findOrFail($id);
        $sub = $game->Subcategory;
        $allGames = $sub->games->where("id", "!=", $id)->take(8);
        $games = [];
        foreach ($allGames as $game) {
            $games[] = $game;
        }

        return $games;
    }

    public function getMayLike($id)
    {
        $game = Game::where("id", "!=", $id)->get()->take(8);
        return $game;
    }

    public function getFree($id)
    {
        $game = Game::where("id", "!=", $id)->where("price", 0)->get()->take(8);
        return $game;
    }

    public function searchGames($key)
    {
        $games = Game::where("name", "LIKE", "%" . $key . "%")->select(array("name", "id"))->get();
        return $games;
    }

    public function searchComplete($key)
    {
        $games = Game::where("name", "LIKE", "%" . $key . "%")->get();
        return $games;
    }

}
