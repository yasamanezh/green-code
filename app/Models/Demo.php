<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['title','meta_description','link','meta_title','meta_keyword'];
}
