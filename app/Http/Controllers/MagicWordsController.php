<?php

namespace App\Http\Controllers;

use App\Models\MagicWords;

class MagicWordsController extends Controller
{
    public function GetCatsByMagic($word_name)
    {
        $word = MagicWords::where("word_name", $word_name)->first()->categories;
        return $word;
    }
}
