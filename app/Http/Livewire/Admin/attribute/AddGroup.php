<?php

namespace App\Http\Livewire\Admin\Attribute;

use App\Models\AttributeGroup;
use App\Models\Category;
use App\Models\SiteOption;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class AddGroup extends Component
{

    public $group;
    public $title, $sort, $category_id;
    public $result = null;

    public function mount()
    {

        $this->group = new AttributeGroup();

    }

    public function saveInfo()
    {
        if (Gate::allows('edit_attr')) {
            $this->validate([
                'title' => 'required|string|min:2',
                'category_id' => 'required',
                'sort' => 'required|numeric|min:0',
            ]);
            $this->group->title = $this->title;
            $this->group->category_id = $this->category_id;
            $this->group->sort_order = $this->sort;
            $this->group->save();
            $msg = "مشخصات با موفقیت ذخیره شد.";
            return redirect(route('AttributeGroups'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $categories = Category::where('parent', 0)->
        orWhere('parent', NULL)->
        get();
        return view('livewire.admin.attribute.add-group', compact('categories'));
    }
}
