<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['label','name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    use HasFactory;
}
