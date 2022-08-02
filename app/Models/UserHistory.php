<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    protected $fillable = ['user_id','product_id'];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    use HasFactory;
}
