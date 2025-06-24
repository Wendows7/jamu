<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ["payment_id","user_id", "product_id", "quantity", "total_price", "status","order_id",'size','price'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
