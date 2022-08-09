<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductProperty extends Model
{
    protected $fillable=['title','product_id','description'];
    use HasFactory;

    public function products()
    {
        return $this->belongTo(Product::class);;
    }

}