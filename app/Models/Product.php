<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable=['title','sell','anbar','slug','meta_title','description','meta_description','meta_keyword',
        'location','price','image',
         'quantity','minimum','Release_date','warrenty','type','weight','weight_class_id','status','manufacturer',
        'category','countsell','shipping','thumbnail'
    ];
    use HasFactory;

    public function productImages(){

        return $this->hasMany(ProductImage::class);
    }
     public function productDiscounts(){

        return $this->hasOne(Discount::class);
    }

    public function productDownloads(){

        return $this->hasMany(ProductDownload::class);
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
