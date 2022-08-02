<?php

namespace App\Http\Livewire\Front\Product\Layout\Tab;

use App\Jobs\DefaultNotification;
use App\Models\Notification;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\SiteOption;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddComment extends Component
{
    public $product;
    public $title,$content,$is_advice,$rate;
    public $i = 0,$allPositive=[],$positive,$positives=[];
    public $j = 0,$allNegetive=[],$negetive,$negetives=[];
    public $colseModal=false;

    public function AddPositive($i)
    {
        $this->validate([
            'positive'=>'required|string|min:2'
        ]);
        $i = $i + 1;
        $this->i = $i;
        array_push($this->allPositive, $i);
        array_push($this->positives, $this->positive);
        $this->positive='';
    }

    public function AddNegetives($j)
    {
        $this->validate([
            'negetive'=>'required|string|min:2'
        ]);
        $j = $j + 1;
        $this->j = $j;
        array_push($this->allNegetive, $j);
        array_push($this->negetives, $this->negetive);
        $this->negetive='';


    }

    public function removeNegetives($j)
    {

        unset($this->allNegetive[$j]);
        unset($this->negetives[$j]);

    }

    public function removePositive($i)
    {

        unset($this->allPositive[$i]);
        unset($this->positives[$i]);

    }

    public function mount($id){
        $this->product=Product::findOrFail($id);
    }

    public function saveComment($id){


        if(! auth()->user()){
            return redirect(route('login'));

        }
        $this->validate([
            'title'=>'required|string|min:2|max:255',
            'content'=>'required|string|min:3',
            'rate'=>['required',Rule::in(1,2,3,4,5)],
            'is_advice'=>['nullable',Rule::in(0,1,null)],
        ]);
        $comment=new ProductComment();
        if(isset($this->positives)){
            $positives=implode(',',$this->positives);
        }else{
            $positives='';
        }
        if(isset($this->negetives)){
            $negetives=implode(',',$this->negetives);
        }else{
            $negetives='';
        }

        $comment->status=0;
        $comment->product_id=$id;
        $comment->star=$this->rate;
        $comment->title=$this->title;
        $comment->content=$this->content;
        $comment->user_id=auth()->user()->id;
        $comment->is_advice=$this->is_advice;
        $comment->positives=$positives;
        $comment->negetives=$negetives;
        $comment->save();



        $type='comment_product';
        $admins=User::where('role','admin')->get();
        foreach($admins as $admin){
            Notification::create([
                'user_id' => $admin->id,
                'type'=>'comment_product',
                'link'=>$comment->id
            ]);
            DefaultNotification::dispatch($admin,$type);
        }


        $this->emit('toast','success', 'دیدگاه شما ثبت شد و پس از تایید نمایش داده خواهد شد.');
        $this->reset('title','content');
        $this->negetives=[];
        $this->positives=[];
        $this->dispatchBrowserEvent('hide-form');
    }

    public function render()
    {
        $siteOption=SiteOption::first();
        return view('livewire.front.product.layout.tab.add-comment',compact('siteOption'));
    }
}
