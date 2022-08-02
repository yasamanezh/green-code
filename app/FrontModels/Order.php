<?php

namespace App\FrontModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['order_number','cart_id','user_id','address','status','send_factor','payment_type','shipping_type',
        'copen_code','copen_price','description','code_posti','cart_discount_price','payment_price','product_price','prices','processing','transactiuctonId','driver','city','zone','mobile'];

    public function products()
    {
        return $this->hasMany(OrderProdct::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getRouteKeyName(){
        return 'order_number';
    }



}
