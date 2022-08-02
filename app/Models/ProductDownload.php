<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductDownload extends Model
{
    protected $fillable=['title','file','product_id'];
    use HasFactory;
    public function products()
    {
        return $this->belongTo(Product::class);
    }
}
