<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colum extends Model
{
    protected $fillable=['row','sort','col','col_lg','col_md','col_xs','page'];
    use HasFactory;
}
