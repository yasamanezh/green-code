<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    protected $fillable=['img','product_id'];
    use HasFactory;

    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
