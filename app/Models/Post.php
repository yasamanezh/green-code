<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['title','slug','thumbnail','description','meta_keyword','meta_description','meta_title','image','status'];
    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }
}
