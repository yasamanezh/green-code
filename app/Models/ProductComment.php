<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{

    protected $fillable=[
        'product_id','status','title','content','is_advice','positives','negetives','user_id','star'
    ];
    use HasFactory;
}
