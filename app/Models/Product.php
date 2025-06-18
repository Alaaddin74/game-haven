<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'platform',
        'category_id',
        'price',
        'stock_quantity',
        'description',
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
