<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagicWords extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_magic_word");
    }
}
