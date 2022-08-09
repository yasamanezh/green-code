<?php

namespace App\FrontModels;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable=['title','image','thumbnail','slug','meta_title','description','meta_description','meta_keyword','location','price',
'status','manufacturer'  ];
    use HasFactory;


    public function productDiscounts(){

        return $this->hasMany(Discount::class,'product_id');
    }
    public function currentproductDiscounts(){

        return $this->hasOne(Discount::class,'product_id');
    }


    public function productDownloads(){

        return $this->hasMany(ProductDownload::class);
    }
    public function productAtts(){

        return $this->hasMany(ProductAtt::class);
    }
    public function productOPtions(){

        return $this->hasMany(Option::class);
    }
   public function productProperties(){

        return $this->hasMany(ProductProperty::class);
    }
   public function productNaghds(){

        return $this->hasMany(productNaghd::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function getRouteKeyName(){
        return 'slug';
    }



}
