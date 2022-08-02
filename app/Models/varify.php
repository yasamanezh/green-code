<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class varify extends Model
{
    use HasFactory;
    protected $fillable=['receiver','ip','massage','code','count'];
}
