<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAtt extends Model
{
      protected $fillable=['attribue_description','product_id'];
    use HasFactory;

    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
