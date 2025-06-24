<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["name", "price", "description", "image",'image_2','image_3','category_id'];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function stockProduct()
    {
        return $this->hasMany(StockProduct::class);
    }
}
