<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Attribute extends Model
{
    protected $fillable=['title','sort_order','group','category_id'];
    use HasFactory;

    public function Values(){

        return $this->hasMany(AttributeVlue::class);
    }
}
