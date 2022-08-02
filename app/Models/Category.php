<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable=['title','slug','status','img','parent','meta_description','meta_keyword','meta_title'];
    use HasFactory;
	use SoftDeletes;
    public function products(){
        return $this->belongsToMany(Product::class,);
    }
}
