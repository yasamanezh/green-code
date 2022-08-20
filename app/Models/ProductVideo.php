<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    protected $fillable=[
        'description','link','sort','title','status','product_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    use HasFactory;
}
