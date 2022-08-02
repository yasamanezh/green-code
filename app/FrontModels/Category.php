<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable=['title','slug','status','img','parent','level','twoParent'];
    use HasFactory;
	use SoftDeletes;
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function getRouteKeyName(){

        return 'slug';
    }
}
