<?php

namespace App\Http\Livewire\Front\Product\Layout\Tab;

use App\Jobs\DefaultNotification;
use App\Models\Notification;
use App\Models\Product;
use App\Models\SiteOption;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class Question extends Component
{
    use WithPagination;
    public $product;
    protected $paginationTheme = 'bootstrap';
    public $question;

    public function mount($id){
        $this->product=Product::findOrFail($id);
    }
    public function saveQuestion(){


        $this->validate([
            'question'=>'required|string|min:2',
        ]);
        $question=new \App\Models\Question();
        $question->question=$this->question;
        $question->product_id=$this->product->id;
        $question->status=0;
        if(auth()->user()){
            $question->user_id=auth()->user()->id;
        }
        $question->save();


        $admins=User::where('role','admin')->get();
        $option=SiteOption::first();
        $type='question';

        if($admins){
            foreach($admins as $admin){
                Notification::create([
                    'user_id' => $admin->id,
                    'type'=>$type,
                    'link'=>$question->id
                ]);
                DefaultNotification::dispatch($admin,$type);
            }
        }



        $this->question='';

        $this->emit('toast','success', 'پرسش شما ثبت شد در اولین فرصت پاسخ داده خواهد شد.');

    }
    public function render()
    {
        $questions= \App\Models\Question::orderBy('id','desc')->where('status',1)->where('product_id',$this->product->id)->paginate(12);
        $siteOption=SiteOption::first();
        return view('livewire.front.product.layout.tab.question',compact('questions','siteOption'));
    }
}
