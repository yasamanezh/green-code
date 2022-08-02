<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductDownload extends Model
{
    protected $fillable=['title','img','file','product_id','sort'];
    use HasFactory;

    public function products()
    {
        return $this->belongTo(Product::class);;
    }
}
