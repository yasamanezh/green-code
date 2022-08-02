<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentUseful extends Model
{
    protected $fillable=['comment_id','ip','useful','no_useful'];
    use HasFactory;
}
