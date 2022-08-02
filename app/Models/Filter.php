<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
 protected $fillable=['title','category_id','attribute_id','status','attribute'];
    use HasFactory;
}
