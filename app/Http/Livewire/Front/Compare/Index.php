<?php

namespace App\Http\Livewire\Front\Compare;

use App\Models\AttributeGroup;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    public $category,$sub,$child;

    public $products=[],$firstProduct,$IDproduct;
    public $search;
    protected $queryString = 'search';
    public $pageNumber = 6;
    public function Add()
    {
        $this->dispatchBrowserEvent('show-form');

    }
    public function priceProdct($id)
    {
        $product= \App\FrontModels\Product::find($id);
        if(isset($product->sell)){
            $prcent=$product->sell;
        }else{
            $prcent=0;
        }
        foreach ($this->productDiscount() as $key=>$value){
            if($key == $id){
                $prcent=$prcent+$value;
            }
        }
        $prcent=$prcent+$this->AllProductDiscount();
        return (1-($prcent/100)) ;

    }

    public function productDiscount()
    {
        // محاسبه تخفیف بر روی محصول
        $producriscunt = [];

        $discounts = Discount::where('status', 1)->where('discount', 1)->get();
        foreach ($discounts as $discount) {
            $productsId = array_keys($producriscunt);
            if ($this->expire($discount) == false) {
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

    public function AllProductDiscount()
    {

        // محاسبه تخفیف اعمال شده بر روی کل محصولات
        $discountsAllProducts = Discount::where('status', 1)->where('discount', 3)->get();
        $AllProductpercent = 0;
        foreach ($discountsAllProducts as $value) {
            if ($this->expire($value) == false) {
                $AllProductpercent = $AllProductpercent + $value->percent;
            }

        }
        return $AllProductpercent;
    }

    public function loadMore(){
        $this->pageNumber=$this->pageNumber+2;
    }
    public function expire($data)
    {
        $timeExpire = explode('/', $data->date_expire);
        $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
        $now = Verta::now();
        $expired = verta("$dateExpired[0]-$dateExpired[1]-$dateExpired[2] $data->time_expire");

        if (date_timestamp_get($expired) < date_timestamp_get($now)) {
            return true;
        } else {

            return false;
        }
    }
    public function mount(Request $request)
    {
        SEOMeta::setTitle('مقایسه محصول');
        $id=$request->segment(2);
        $this->IDproduct=$id;
        $product=Product::find($id);
        $this->firstProduct=$product;
          if($product){
            $this->products[0]=$id;
            $category=Category::where('id',$product->category)->first();
            $this->category=$category;
            if(isset($category->parent)){
                $this->sub=Category::where('id',$category->parent)->first();
                if(isset($this->sub)){
                    if(isset($this->sub->parent)){
                        $this->child=Category::where('id',$this->sub->parent)->first();
                    }
                }
            }

        }

    }

    public function addCompare($id,Request $request)
    {
        $idCompaireProduct=$request->segment(2);

        $isProductExit=array_search($id,$this->products);
        $countProducts=\count($this->products);

        if( (! $isProductExit) ){
            if($id != $idCompaireProduct){
                if($countProducts <=3){

                    $this->products[$countProducts]=$id;
                    $this->emit('toast','success','محصول مورد نظر شما به لیست مقایسه افزوده شد.');


                }
            }else{
                $this->emit('toast','success','این محصول قبلا به لیست مقایسه اضافه شده.');
            }

        }else{
            $this->emit('toast','success','این محصول قبلا به لیست مقایسه اضافه شده.');
        }
        $this->dispatchBrowserEvent('hide-form');

    }

    public function remove($id)
    {
        unset($this->products[$id]);

    }

    public function render()
    {
        $product=Product::find($this->IDproduct);
        $counMore=count( Product::where('title', 'LIKE', "%{$this->search}%")->where('category',$product->category)->get());

        $categoryProduct=Product::where('title', 'LIKE', "%{$this->search}%")->
        where('category',$product->category)->take($this->pageNumber)->get();
        $options=SiteOption::first();
        $attribueGroup=AttributeGroup::orderBy('sort_order','ASC')->where('category_id',$this->category->id)->get();
        $showproducts=$this->products;
        return view('livewire.front.compare.index',compact('showproducts','counMore','categoryProduct','attribueGroup','options'))->layout('layouts.front');
    }
}
