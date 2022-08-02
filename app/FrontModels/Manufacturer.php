<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable=['title','slug','img'];
    use HasFactory;
    public function getRouteKeyName(){
        return 'slug';
    }

}
