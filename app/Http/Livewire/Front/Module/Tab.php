<?php

namespace App\Http\Livewire\Front\Module;

use App\FrontModels\Category;
use App\FrontModels\Product;
use App\Models\Discount;
use App\Models\Like;
use App\Models\ProductComment;
use App\Models\Social;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Livewire\Component;


class Tab extends Component
{
    public $tabs;
    public Carbon $carbon;
    public $parent,$categories=[];
    public $sortColumnName = 'countsell';
    public $sortDirection = 'desc';

    public $categoryKey,$filterKey=[],$catID=[],$filterID=[],$ProductIds=[];


    public function mount($tab){
        $this->tabs=\App\Models\Tab::find($tab);
        if($this->tabs->category == 'all'){
            $categories=Category::where('status',1)->get();
            if($categories){
                foreach($categories as $cat1){
                    array_push($this->categories,$cat1->id);
                }
            }

        }else{
            $category=Category::where('id',$this->tabs->category)->first();
            $this->categories[1]=$category->id;
            if(isset($category->parent) && $category->parent !=0 ){
                $this->sub=Category::where('id',$category->parent)->first();

                if(isset($this->sub)){
                    if(isset($this->sub->parent) &&  $this->sub->parent !=0){
                        $this->child=Category::where('id',$this->sub->parent)->first();

                    }
                }
            }
            $AllCategory=Category::where('status',1)->where('parent',$category->id)->get();
            foreach ($AllCategory as $cat){
                array_push($this->categories,$cat->id);
                $AllParent=Category::where('status',1)->where('parent',$cat->id)->get();
                foreach ($AllParent as $parent){
                    array_push($this->categories,$parent->id);
                }
            }
        }


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

    public function sortBy($columnName,$sort)
    {
        $this->sortDirection = $sort;
        $this->sortColumnName = $columnName;
    }

    public function calculateRate($id){
        $stars=ProductComment::where('product_id',$id)->get();
        $count=count($stars);
        $rate=0;
        if($count > 0){
            foreach ($stars as $star){
                if($star->star != NULL){
                    $rate=$rate+$star->star;
                }
            }
            return (round($rate/$count));
            return ((($rate/$count)*100)/5);
        }
        return 0;
    }

    public function isLike($id)
    {
        if(auth()->user()){
            $like=Like::where('product_id',$id)->where('user_id',auth()->user()->id)->where('like',1)->first();
            if($like){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }


    }

    public function addToWishlist($id){
        if(auth()->user()){
            $wishlist=new Like();
            $wishlist->user_id=auth()->user()->id;
            $wishlist->product_id=$id;
            $wishlist->like=1;
            $wishlist->save();
        }else{
            return redirect(route('login'));
        }

    }

    public function removeToWishlist($id){
        if(auth()->user()){
            $data_info_id=Like::where('product_id',$id)->where('user_id',auth()->user()->id)->first();
            $data_info_id->delete();
        }else{
            return redirect(route('login'));
        }


    }

    public function compare(Request $request,$id)
    {
        $product=Product::find($id);
        $category= \App\Models\Category::find($product->category);
        if($category){
            redirect(route('compare',$product->id));
        }else{
            $this->emit('toast','warning', 'در این دسته بندی محصولی جهت مقایسه وجود ندارد.');

        }


    }

    public function render()
    {
        $social=Social::first();
        $ProductIds=[];
        foreach ($this->categories as $key=>$value){
            $cats=Category::where('id',$value)->first();
            if($this->tabs->type == 'all'){
                $products=Product::where('category',$cats->id)->get();
                foreach ($products as $pro){
                    array_push($ProductIds, $pro->id);
                }
            }
            elseif ($this->tabs->type == 'special'){
                $products=Product::where('category',$cats->id)->where('status', 1)->get();
                foreach($products as $product){
                    if($this->is_special($product->id) != false){
                        array_push($ProductIds, $product->id);
                    }
                }

            }
            elseif ($this->tabs->type == 'anbar'){

                $products=Product::where('category',$cats->id)->where('status', 1)->where('quantity','<>',0)->get();
                foreach ($products as $pro){
                    array_push($ProductIds, $pro->id);
                }

            }
            elseif($this->tabs->type == 'discount'){

                $products=Product::where('status', 1)->get();
                foreach($products as $product){
                    if(Price::AllProductDiscount() !=0){
                        $products=Product::where('category',$cats->id)->get();
                        foreach ($products as $pro){
                            array_push($ProductIds, $pro->id);
                        }
                    }else{
                        if(isset($product->sell) && !empty($product->sell)){
                            $ProductIds[]=$product->id;
                        }else{
                            if(Price::priceProdct($product->id) != 1){
                                $ProductIds[]=$product->id;
                            }

                        }
                    }

                }

            }





        }
        $Newproducts = Product::whereIn('id',$ProductIds)
            ->orderBy('id', 'DESC')->
            where('status', 1)->take($this->tabs->count)->get();

        $bestellers = Product::whereIn('id',$ProductIds)
            ->orderBy('countsell', 'DESC')->
            where('status', 1)->take($this->tabs->count)->get();


        $cheeps = Product::whereIn('id',$ProductIds)
            ->orderBy('price', 'ASC')->
            where('status', 1)->take($this->tabs->count)->get();

        $products = Product::whereIn('id',$ProductIds) ->
        where('status', 1)->take($this->tabs->count)->get();

        return view('livewire.front.module.tab',compact('social','Newproducts','bestellers','cheeps','products'));
    }
}
