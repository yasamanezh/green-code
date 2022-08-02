<?php

namespace App\Http\Livewire\Front\Product\Layout;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Like;
use App\Models\Product;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Livewire\Component;

class Gallery extends Component
{
    public $product;

    public function mount($id){
        $this->product=Product::findOrFail($id);

    }

    public function is_special($id){
        // محاسبه  تاریخ انقضاء محصول شگفت انگیز
        $special=false;
        $discounts = Discount::where('status', 1)->where('discount', 1)->get();
        foreach ($discounts as $discount) {
            if ($this->expire($discount) == false) {
                foreach (explode(',', $discount->product_id) as $value) {
                    if($value == $id ){
                        if($discount->special ==1){
                            $timeExpire = explode('/', $discount->date_expire);
                            $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
                            $expired = ("$dateExpired[1]/$dateExpired[2]/$dateExpired[0] $discount->time_expire ");
                            $special= $expired;
                        }
                    }
                }
            }
        }

        return $special;
    }

    public function addToWishlist($id){

        $wishlist=new Like();
        $wishlist->user_id=auth()->user()->id;
        $wishlist->product_id=$id;
        $wishlist->like=1;
        $wishlist->save();
    }

    public function removeToWishlist($id){

        $data_info_id=Like::where('product_id',$id)->where('user_id',auth()->user()->id)->first();

        $data_info_id->delete();
    }

    public function compare(Request $request)
    {
        $category=Category::find($this->product->category);
        if($category){
            redirect(route('compare',$this->product->id));
        }else{
            $this->emit('toast','warning', 'در این دسته بندی محصولی جهت مقایسه وجود ندارد.');
        }


    }

    public function expire($data)
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

    public function render()
    {
        if(auth()->user()){
            $likes=Like::where('user_id',auth()->user()->id)->where('product_id',$this->product->id)->first();

        }else{
            $likes=[];
        }
        return view('livewire.front.product.layout.gallery',compact('likes'));
    }
}
