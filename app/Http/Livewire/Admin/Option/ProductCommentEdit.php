<?php

namespace App\Http\Livewire\Admin\Option;

use App\Models\ProductComment;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class ProductCommentEdit extends Component
{
    public   $productComment;
    public $i = 0,$allPositive=[],$positive,$positives=[];
    public $j = 0,$allNegetive=[],$negetive,$negetives=[];

    public function AddPositive($i)
    {
        $this->validate([
            'positive'=>'required|string|min:2|max:255'
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
            'negetive'=>'required|string'
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
    public function mount($edit){

        $this->productComment=ProductComment::where('id',$edit)->first();
        $positives=explode(',',$this->productComment->positives);
        if(count($positives) >1){
            foreach ($positives as $positive){
                array_push($this->positives,$positive);
            }
        }

         $negetives=explode(',',$this->productComment->negetives);
        if(count($negetives)>1){
            foreach ($negetives as $negetive){
                array_push($this->negetives,$negetive);
            }
        }
     }
    protected $rules=[
        'productComment.title'=>'required|string|min:2|max:255',
        'productComment.content'=>'nullable|string|min:3',
        'productComment.status'=>'nullable',
        'productComment.is_advice'=>'nullable',
    ];
    public function saveComment(){
        if(Gate::allows('edit_product')){
            $this->validate();

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
            $this->productComment->positives=$positives;
            $this->productComment->negetives=$negetives;
            $this->productComment->update();
            $msg='ویرایش با موفقیت انجام شد';

            return (redirect(route('ProductComment')))->with('sucsess',$msg);
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function render()
    {
        return view('livewire.admin.option.product-comment-edit');
    }
}
