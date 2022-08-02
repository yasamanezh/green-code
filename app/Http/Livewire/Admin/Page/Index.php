<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Brand;
use App\Models\Log;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $img;
    public $search;
    public $count_data;
    public $mulitiSelect = [];
    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=Page::where('title', 'LIKE', "%{$this->search}%")->
            orWhere('link', 'LIKE', "%{$this->search}%")
                ->orWhere('id',$this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->mulitiSelect=[];
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

    public function deleteAll()
    {
        if (Gate::allows('delete_page')) {
            foreach ($this->mulitiSelect as $value) {
                $page = Page::where('id', $value)->first();


                $page->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی برگه ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage=false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }


    }

    public function delete()
    {
        if (Gate::allows('delete_page')) {
            $data_info_id = Page::findOrFail($this->categoryIdBeingRemoved);


            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن برگه' . '-' . $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }

    }

    public function mount()
    {
        $this->count_data = 10;
    }

    protected $queryString = ['search'];

    public $readyToLoad = false;

    public Page $site_page;


    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        $pages = $this->readyToLoad ? Page::where('title', 'LIKE', "%{$this->search}%")->
        orWhere('link', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)->
        orderBy($this->sortColumnName, $this->sortDirection)->
        latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.page.index', compact('pages', 'deleteItem'));
    }
}
