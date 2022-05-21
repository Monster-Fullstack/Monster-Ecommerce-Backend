<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Games()
    {
        return $this->morphedByMany(Game::class, "photoable");
    }

    public function Products()
    {
        return $this->morphedByMany(Product::class, "photoable");
    }
}
