<?php

namespace App\Http\Livewire\Front\Profile;

use App\Models\Order;
use App\Models\OrderProdct;
use App\Models\Product;
use App\Models\ProductDownload;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use http\Env\Response;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Download extends Component
{
    public $downloads=[];
    public $downloadsIds=[];

    public function downloadFile($id)
    {
        $file_path=ProductDownload::find($id);
        $name=$file_path->file;
            if($file_path->file){
            $timestamp = now()->addHours(3)->timestamp;
            $ip=$_SERVER['REMOTE_ADDR'];
            $hash = Hash::make(env('FILE_HASH_DOWNLOAD') . $name . $timestamp . $ip);
            $file=$id.','. $hash.','. $timestamp;
                return (['file' => $id, 'mac' => $hash, 't' => $timestamp]);
        } else {
            return "#";
        }
    }

    public function mount()
    {
        SEOMeta::setTitle('دانلودها');
        $userID=auth()->user()->id;
        $orders=Order::where('user_id',$userID)->where('status',200)->get();
        foreach ($orders as $order){
            $products=OrderProdct::where('order_id',$order->id)->get();
           foreach ($products as $value){
               $product=Product::where('id',$value->product_id)->first();
               if($product){
                   $downloads=ProductDownload::where('product_id',$product->id)->get();
                   if($downloads){
                       foreach ($downloads as $download){
                           array_push($this->downloads,$download);
                           array_push($this->downloadsIds,$download->id);
                       }
                   }
               }

           }

        }

    }

    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.profile.download',compact('options'))->layout('layouts.front');
    }
}
