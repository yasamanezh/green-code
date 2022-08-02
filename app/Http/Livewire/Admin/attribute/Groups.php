<?php

namespace App\Http\Livewire\admin\attribute;

use App\Models\Attribute;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\AttributeGroup;


class Groups extends Component
{


    public $title;
    public $sort_order;
    public $search;
    public $group;
    public $readyToLoad = false;
    public $mulitiSelect=[];
    public $count_data=10;
    protected $queryString=['search'];
    public $photo;

    public $groupIdBeingRemoved = null;
    public $attrIdBeingRemoved = null;
    public $searchTerm = null;


    public function loadCategory()
    {
        $this->readyToLoad = true;
    }


    public function confirmCategoryRemoval($groupId)
    {
        $this->groupIdBeingRemoved = $groupId;
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAttributeRemoval($attributeid)
    {
        $this->attrIdBeingRemoved = $attributeid;
        $this->dispatchBrowserEvent('show-form');
    }

    public function delete(){


        if(Gate::allows('delete_group')){
            $data_info_id=AttributeGroup::findOrFail($this->groupIdBeingRemoved);

            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروه مشخصات' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
    }
    public function deleteAttr(){
        if(Gate::allows('delete_group')){
            $data_info_id=Attribute::findOrFail($this->attrIdBeingRemoved);

            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن مشخصه' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function render()
    {

        $data_info = AttributeGroup::where('title','LIKE',"%{$this->search}%")
            ->orWhere('id',$this->search)
            -> orderBy('sort_order', 'Asc')
            ->latest()->get();
        $deleteItem=$this->mulitiSelect;

        return view('livewire.admin.attribute.groups',compact('data_info','deleteItem'));
    }
}
