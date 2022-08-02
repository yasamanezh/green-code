<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable=['product_id','count','color','option',
        'value','price','anbar','price_prefix','weight','weight_prefix'
        ,'input','date','required'];
    use HasFactory;

    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
