<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    protected $fillable=['title','slug','status','img','parent','meta_description','meta_keyword','meta_title'];
    use HasFactory;
    use SoftDeletes;

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
