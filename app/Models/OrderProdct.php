<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProdct extends Model
{
    use HasFactory;
    protected $fillable=['order_id','title','price','count','options','options_id','product_id'];

    public function Product(){
        return $this->belongsTo(Product::class);
    }


}
