<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerSendHistory extends Model
{
    protected $fillable = [
        'product_id',
        'partnership_id',
        'quantity',
        'size',
        'batch_number',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function partnership()
    {
        return $this->belongsTo(Partnership::class);
    }
}
