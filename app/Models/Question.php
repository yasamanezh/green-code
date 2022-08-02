<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=[
        'product_id','question','answer','status','user_id'
    ];
    use HasFactory;
}
