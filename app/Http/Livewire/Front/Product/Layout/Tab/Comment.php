<?php

namespace App\Http\Livewire\Front\Product\Layout\Tab;


use App\Models\commentUseful;
use App\Models\Order;
use App\Models\OrderProdct;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\SiteOption;
use Livewire\Component;
use Livewire\WithPagination;


class Comment extends Component
{
    use WithPagination;
    public $product;
    protected $paginationTheme = 'bootstrap';

    public function Add()
    {
        $this->dispatchBrowserEvent('show-form');

    }
    public function mount($id){
        $this->product=Product::findOrFail($id);
    }

    public function calculateRate(){
        $stars=ProductComment::where('product_id',$this->product->id)->get();
        $count=count($stars);
        $rate=0;
        if($count >=1){
            foreach ($stars as $star){
                if($star->star != NULL){
                    $rate=$rate+$star->star;
                }
            }
            return ((($rate/$count)*100)/5);
        }

        return 0;
    }

    public function is_good(){
        if($this->calculateRate() <=20){
            return '';
        }elseif($this->calculateRate() >20 && $this->calculateRate() <=40   ){
            return 'بد';
        }
        elseif($this->calculateRate() >40 && $this->calculateRate() <=60   ){
            return 'معمولی';
        }
        elseif($this->calculateRate() >60 && $this->calculateRate() <=80   ){
            return 'خوب';
        }
        elseif($this->calculateRate() >80 && $this->calculateRate() <=100   ){
            return 'عالی';
        }
    }

    public function is_buyyer($id)
    {
        $orders=Order::where('user_id',$id)->where('status',200)->get();

        if($orders){
            foreach ($orders as $order){

                $products=OrderProdct::where('order_id',$order->id)->where('product_id',$this->product->id)->first();

                if($products){
                    return true;
                }else{
                    return false;
                }

            }

        }else{
            return false;
        }

    }

    public function counUsefullComment($id){
        $data=commentUseful::where('comment_id',$id)->where('useful',1)->get();
        return (count($data));
    }

    public function counNoUsefullComment($id){
        $data=commentUseful::where('comment_id',$id)->where('no_useful',1)->get();
        return (count($data));
    }

    public function render()
    {
        $comments= ProductComment::orderBy('id','desc')->where('status',1)->where('product_id',$this->product->id)->paginate(12);
        $siteOption=SiteOption::first();
        return view('livewire.front.product.layout.tab.comment',compact('comments','siteOption'));
    }
}
