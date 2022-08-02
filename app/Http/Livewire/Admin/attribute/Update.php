<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Update extends Component
{
    public $group;
    public $title,$sort,$category_id,$attribute,$prefix;
    public function mount($attribute){
        $this->attribute=Attribute::find($attribute);
        $this->title=$this->attribute->title;
        $this->sort=$this->attribute->sort_order;
        $this->group=$this->attribute->group;
        $this->category_id=$this->attribute->category_id;
        $this->prefix=$this->attribute->value;
    }
    public function saveInfo(){
        if(Gate::allows('edit_attr')){

            $this->validate([
                'title'=>'required|string|min:2',
                'category_id'=>'required',
                'sort'=>'nullable|numeric|min:0',
                'group'=>'required',
                'prefix'=>'nullable|string',
            ]);
            $this->attribute->title=$this->title;
            $this->attribute->category_id=$this->category_id;
            $this->attribute->sort_order=$this->sort;
            $this->attribute->value=$this->prefix;
            $this->attribute->group=$this->group;
            $this->attribute->save();
            $msg="مشخصات با موفقیت ذخیره شد.";
            return redirect(route('AttributeGroups'))->with('sucsess',$msg);

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }
    public function render()
    {
        $categories=Category::where('parent',0)->
        orWhere('parent',NULL)->
        get();
        return view('livewire.admin.attribute.update',compact('categories'));
    }
}
