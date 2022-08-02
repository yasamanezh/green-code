<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payamak extends Model
{
    protected $fillable=['user_ids','content','date_send','time_send','status'];
    use HasFactory;
}
