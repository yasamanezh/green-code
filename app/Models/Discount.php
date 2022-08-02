<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable =['code','status','discount','product_id','percent','price'
        ,'code','date_expire','minimum','count','time_expire','special','max'];
    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
