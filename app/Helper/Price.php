<?php

namespace App\Helper;

use App\Models\Discount;
use Hekmatinasser\Verta\Verta;

class Price
{

    public static function expire($data)
    {
        $timeExpire = explode('/', $data->date_expire);
        $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
        $now = now();
        $expired = verta("$dateExpired[0]-$dateExpired[1]-$dateExpired[2] $data->time_expire");

        if (date_timestamp_get($expired) < date_timestamp_get($now)) {
            return true;
        } else {

            return false;
        }
    }

    public static  function productDiscount()
    {
        // محاسبه تخفیف بر روی محصول
        $producriscunt = [];

        $discounts = Discount::where('status', 1)->where('discount', 1)->get();
        foreach ($discounts as $discount) {
            $productsId = array_keys($producriscunt);
            if (self::expire($discount) == false) {
                foreach (explode(',', $discount->product_id) as $value) {
                    $exit=array_key_exists($value,$producriscunt);;
                    if($exit){
                        $producriscunt[$value] =$producriscunt[$value]+ $discount->percent;
                    }else{
                        $producriscunt[$value] = $discount->percent;
                    }
                }

            }

        }

        return $producriscunt;
    }

    public static function AllProductDiscount()
    {

        // محاسبه تخفیف اعمال شده بر روی کل محصولات
        $discountsAllProducts = Discount::where('status', 1)->where('discount', 3)->get();
        $AllProductpercent = 0;
        foreach ($discountsAllProducts as $value) {
            if (self::expire($value) == false) {
                $AllProductpercent = $AllProductpercent + $value->percent;
            }

        }
        return $AllProductpercent;
    }

    public static function priceProdct($id)
    {
        $product= \App\FrontModels\Product::find($id);
        if(isset($product->sell) && !empty($product->sell)){
            $prcent=$product->sell;
        }else{
            $prcent=0;
        }
        foreach (self::productDiscount() as $key=>$value){
            if($key == $id){
                $prcent=$prcent+$value;
            }
        }
        $prcent=$prcent+ self::AllProductDiscount();
        return (1-($prcent/100)) ;

    }
}
