<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $fillable=[
        'url','licence','date','status'
    ];
    use HasFactory;
}
