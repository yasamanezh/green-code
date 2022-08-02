<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductAtt extends Model
{
    protected $fillable=['attribue_description','product_id'];
    use HasFactory;

    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
