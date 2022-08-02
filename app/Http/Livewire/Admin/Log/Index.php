<?php

namespace App\Http\Livewire\Admin\Log;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $readyToLoad = false;
    public $search;
    public $mulitiSelect = [];
    public $count_data = 10;
    protected $queryString = ['search'];
    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect =\App\Models\Log::where('actionType', 'LIKE', "%{$this->search}%")->
            orWhere('user_id', 'LIKE', "%{$this->search}%")
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

    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;
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

    public function delete()
    {


        if (Gate::allows('delete_AdminLogs')) {
            $data_info_id = Log::find($this->categoryIdBeingRemoved);
            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گزارش' . '-' . $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }
    }

    public function deleteAll()
    {
        if (Gate::allows('delete_AdminLogs')) {
            foreach ($this->mulitiSelect as $value) {
                $log = Log::where('id', $value)->first();
                $log->delete();
            }
            $this->mulitiSelect = [];
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی گزارش ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage = false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }
    }


    public function render()
    {

        $data_info = $this->readyToLoad ? \App\Models\Log::where('actionType', 'LIKE', "%{$this->search}%")->
        orWhere('user_id', 'LIKE', "%{$this->search}%")->
        orWhere('url', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)->
            latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.log.index', compact('data_info', 'deleteItem'));
    }
}
