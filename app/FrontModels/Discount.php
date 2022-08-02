<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable =['code','status','discount','category_id','product_id','percent','type'
        ,'price','code','date_expire','minimum','count','special'];
    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
