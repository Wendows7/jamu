<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ["name","order_id"];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
