<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RowModule extends Model
{
    protected $fillable=['sort','margin','padding','bg_color','bg_color_status','height','fullpage','page'];
    use HasFactory;
}
