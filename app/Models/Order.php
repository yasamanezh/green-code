<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'cart_id', 'user_id',  'status',  'payment_type',
        'copen_code', 'copen_price',  'cart_discount_price', 'payment_price',
        'product_price', 'prices', 'processing', 'transactionId', 'driver','product-id'];

    public function products()
    {
        return $this->hasMany(OrderProdct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->belongsTo(OrderHistory::class);
    }


}
