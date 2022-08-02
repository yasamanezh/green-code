<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Editgroup extends Component
{

    public AttributeGroup $group;
    public $title,$sort,$category_id;
    public function mount($attributeGroup){
        $this->group=AttributeGroup::findOrFail($attributeGroup);
        $this->title=$this->group->title;
        $this->sort=$this->group->sort_order;
        $this->category_id=$this->group->category_id;
    }
    public function saveInfo(){
        if(Gate::allows('edit_attr')){

            $this->validate([
                'title'=>'required|string|min:2',
                'category_id'=>'required',
                'sort'=>'required|numeric|min:0',
            ]);
            $this->group->title=$this->title;
            $this->group->category_id=$this->category_id;
            $this->group->sort_order=$this->sort;
            $this->group->update();
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
        return view('livewire.admin.attribute.editgroup',compact('categories'));
    }
}
