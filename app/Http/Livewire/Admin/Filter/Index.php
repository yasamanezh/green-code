<?php

namespace App\Http\Livewire\Admin\Filter;

use App\Models\Category;
use App\Models\Filter;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Attribute;
use App\Models\Filter as FilterModels;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';



    public FilterModels $filter;
    public $search;
    public $count_data = 10;
    public $mulitiSelect = [];
    protected $queryString = ['search'];


    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $readyToLoad = false;
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=FilterModels::where('title','LIKE',"%{$this->search}%")
                ->orWhere('id',$this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->mulitiSelect=[];
        }

    }



    public function loadFilter()
    {
        $this->readyToLoad = true;
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function confirmCategoryRemoval($Id)
    {
        $this->categoryIdBeingRemoved = $Id;
        $categories = Category::get();
        foreach ($categories as $category) {
            if ($category->parent == $this->categoryIdBeingRemoved) {
                $this->level1 = 1;
            }
        }
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllCategoryRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll()
    {
        if (Gate::allows('delete_filter')) {
            foreach ($this->mulitiSelect as $value) {
                $filter = FilterModels::where('id', $value)->first();


                $filter->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی فیلتر ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage=false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {

            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }

    }

    public function getAttribute($id)
    {
        $attributes=explode(',',$id);
        $att='';
        foreach ($attributes as $value){
            $attribute=Attribute::findOrFail($value);
            if($att=''){
                $att =$attribute->title;
            }else{
                $att =$attribute->title.',';
            }
            return $att;

        }
    }

    public function delete()
    {
        if (Gate::allows('delete_filter')) {
            $data_info_id = FilterModels::findOrFail($this->categoryIdBeingRemoved);


            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن فیلتر' . '-' . $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }

    }

    public function statusDisable($id)
    {
        if (Gate::allows('edit_filter')) {
            $data_info_id = FilterModels::find($id);
            $data_info_id->update([
                'status' => 0
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'غیر فعال کردن' . $data_info_id->title,
                'actionType' => 'غیر فعال کردن'
            ]);
            $this->emit('toast', 'success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        } else {

            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function statusEnable($id)
    {
        if (Gate::allows('edit_filter')) {
            $data_info_id = FilterModels::find($id);
            $data_info_id->update([
                'status' => 1
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'فعال کردن ' . $data_info_id->title,
                'actionType' => 'فعال کردن'
            ]);
            $this->emit('toast', 'success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        } else {

            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function saveInfo()
    {
        $attributesave = '';
        foreach ($this->filter_value as $key => $value) {
            if ($attributesave != '') {
                $attributesave = $attributesave . ',' . $this->filter_value[$key];
            } else {
                $attributesave = $this->filter_value[$key];
            }

        }
        $filter = new FilterModels();
        $filter->status = $this->status;
        $filter->title = $this->title;
        $filter->attribute = $this->filter_title;
        $filter->category_id = $this->category_id;
        $filter->attribute_id = $attributesave;
        $filter->save();

        if ($filter) {
            $this->title = '';
            $this->category_id = Null;
            $this->status = '';
            $this->inputFilter = [];
            $this->filter_value = [];
            $this->filter_titlee = '';

            $this->emit('toast', 'success', 'ذخیره سازی موفقیت امیز بود');
            return back();
        }
    }

    public function render()
    {
        $data_info = $this->readyToLoad ? FilterModels::where('title', 'LIKE', "%{$this->search}%")
            ->orWhere('id', $this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) : [];
        $attribute = Attribute::get();
        $categories = Category::get();
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.filter.index', compact('data_info', 'attribute', 'categories', 'deleteItem'));
    }
}
