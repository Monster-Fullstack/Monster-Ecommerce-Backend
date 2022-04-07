<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
