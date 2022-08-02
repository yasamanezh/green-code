<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Category;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $category;
    public $readyToLoad = false;
    public $search;
    public $mulitiSelect = [];
    public $count_data = 10;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $IdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=Role::where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('label', 'LIKE', "%{$this->search}%")
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

    public function loadRole()
    {
        $this->readyToLoad = true;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function confirmRemoval($Id)
    {
        $this->IdBeingRemoved = $Id;
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function delete()
    {
        if (Gate::allows('delete_role')) {
            $data_info_id = Role::findOrFail($this->IdBeingRemoved);

            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن مقام' . '-' . $data_info_id->name,
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
        if (Gate::allows('delete_role')) {
            foreach ($this->mulitiSelect as $value) {
                $data_info = Role::where('id', $value)->first();

                $data_info->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی مقام ',
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


    public function render()
    {
        $data_info = $this->readyToLoad ? Role::where('name', 'LIKE', "%{$this->search}%")
            ->orWhere('label', 'LIKE', "%{$this->search}%")
            ->orWhere('id', $this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.role.index', compact('data_info', 'deleteItem'));
    }
}
