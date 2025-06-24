<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduct extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'product_id',
            'stock',
            'size',
            'price'
        ];

    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
