<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable=['row','col','sort','module_id','margin','padding','page'];
    use HasFactory;
}
