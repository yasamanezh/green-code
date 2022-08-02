<?php

namespace App\Http\Livewire\Admin\Html;

use App\Models\Html;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $search;

    protected $queryString = ['search'];

    public $readyToLoad = false;
    public $count_data=10;
    public Html $html;
    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $mulitiSelect = [];
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect =Html::where('title', 'LIKE', "%{$this->search}%")
                ->orWhere('id', $this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item) => (string)$item)->toArray();

        } else {
            $this->mulitiSelect = [];
        }

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
    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;

        $this->dispatchBrowserEvent('show-delete-modal');

    }
    public function confirmAllCategoryRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }
    public function deleteAll(){
        if(Gate::allows('edit_design')){
            foreach ($this->mulitiSelect as $value){
                $data=Html::where('id',$value)->first();

                $data->delete();
            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی html ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage = false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success','رکوردهای مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }
    public function delete(){
        if(Gate::allows('edit_design')){
            $data_info_id=Html::findOrFail($this->categoryIdBeingRemoved);

            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن html' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function mount()
    {
        $this->slider = new Html();
    }


    public function loadCategory()
    {
        $this->readyToLoad = true;
    }


    public function render()
    {

        $htmls = $this->readyToLoad ? Html::where('title', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)->
        orderBy($this->sortColumnName, $this->sortDirection)->
        latest()->paginate($this->count_data) : [];
        $deleteItem=$this->mulitiSelect;
        return view('livewire.admin.html.index',compact('htmls','deleteItem'));
    }
}
