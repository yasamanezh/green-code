<?php

namespace App\Http\Livewire\Front\Product;

use App\Models\SiteOption;
use App\Models\UserHistory;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use App\FrontModels\Product;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;


class SingleProduct extends Component
{

    public Product $product;

    public function mount()
    {

        $product=$this->product;
        $url=Request::url();
        $link=URL::to('/');
        $keys=explode(',',$this->product->meta_keyword);
        if($product->meta_title){
            $title=$product->meta_title;
        }else{
            $title=$product->title;
        }
        if($product->meta_description){
            $description=$product->meta_description;
        }else{
            $description=$product->description;
        }


        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keys);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'product');
        OpenGraph::addProperty('locale', 'fa-ir');
        OpenGraph::addImage(['url' =>$link.'/storage/'.$product->thumbnail, 'size' => 300]);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('product');
        JsonLd::addImage(['url' =>$link.'/storage/'.$product->thumbnail, 'size' => 300]);


        if(! $product){
            abort(404);
        }
        // تاریخچه
        if(auth()->user()){

            $isHistory=UserHistory::where('user_id',auth()->user()->id)->where('product_id',$this->product->id)->first();
           if($isHistory){
               $isHistory->delete();
           }
            $userHistory=UserHistory::where('user_id',auth()->user()->id)->get();
            if(count($userHistory) >=503){
                $oldhistory=UserHistory::orderBy('id', 'desc')->where('user_id',auth()->user()->id)->first();
                $oldhistory->delete();

            }
                $history=new UserHistory();
                $history->user_id=auth()->user()->id;
                $history->product_id=$this->product->id;
                $history->save();

        }
    }


    public function render()
    {
        $siteOption=SiteOption::first();
        return view('livewire.front.product.single-product',compact('siteOption',))->layout('layouts.front');;;
    }
}
