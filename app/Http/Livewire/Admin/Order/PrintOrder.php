<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\OrderProdct;
use App\Models\SiteOption;
use Hekmatinasser\Verta\Verta;
use Livewire\Component;

class PrintOrder extends Component
{

    public  $order;
    public $user,$to_inform,$description,$processing;
    public $shipping;
    public function mount($detail){
        $this->order=Order::find($detail);
        $this->user=auth()->user();
    }

    public function render()
    {
        $siteOption=SiteOption::first();
        $counter=1;
        $now = Verta::now();
        $products=OrderProdct::where('id',$this->order->order_id)->get();

        $totalcount=0;
        return view('livewire.admin.order.print-order',compact('products','counter','siteOption','now','totalcount'))->layout('layouts.print');
    }
}
