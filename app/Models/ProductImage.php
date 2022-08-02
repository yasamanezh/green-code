<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable=['img','product_id'];

    use HasFactory;

    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
