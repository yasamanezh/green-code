<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable=['title','sell','slug','meta_title','description','meta_description','meta_keyword',
        'price','image',
         'Release_date','warrenty','status','manufacturer',
        'category','countsell','thumbnail','demo'
    ];
    use HasFactory;


     public function productDiscounts(){

        return $this->hasOne(Discount::class);
    }

    public function productDownloads(){

        return $this->hasMany(ProductDownload::class);
    }
     public function videos(){

        return $this->hasMany(ProductVideo::class);
    }

    public function productAtts(){

        return $this->hasMany(ProductAtt::class);
    }
    public function OPtions(){

        return $this->hasMany(Option::class);
    }
   public function productProperties(){

        return $this->hasMany(ProductProperty::class);
    }
   public function productNaghds(){

        return $this->hasMany(productNaghd::class);
    }
   public function productOptions(){

        return $this->hasMany(productOption::class);
    }



}
