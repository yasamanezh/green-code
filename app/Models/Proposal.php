<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable=['status','count','title','category_id','background','image','link'];
    use HasFactory;
}
