<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['title','slug','description','meta_keyword','image','thumbnail','status'];
    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}
