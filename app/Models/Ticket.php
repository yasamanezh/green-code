<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable=['part','title','description','status','user_id','file'];
    use HasFactory;

    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }


}
