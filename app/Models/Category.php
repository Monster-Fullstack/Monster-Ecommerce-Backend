<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subCats()
    {
        return $this->hasMany(SubCategory::class, "category_id");
    }

    public function products()
    {
        return $this->hasMany(Product::class, "category_id");
    }

    public function games()
    {
        return $this->hasMany(Game::class, "category_id");
    }

    public function words()
    {
        return $this->belongsToMany(MagicWords::class, "category_magic_word");
    }
}
