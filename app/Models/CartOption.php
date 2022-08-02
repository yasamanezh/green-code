<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartOption extends Model
{
    use HasFactory;
    protected $fillable=['cart_id','option','value'];

    public function options(){

        return $this->hasMany(CartOption::class);
    }
}
