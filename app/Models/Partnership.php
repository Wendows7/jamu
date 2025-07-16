<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'file',
        'company_name',
        'code',
        'reply_file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
