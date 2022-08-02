<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productNaghd extends Model
{
    protected $fillable=['title','product_id','description'];
    use HasFactory;

    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
