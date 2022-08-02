<?php

namespace App\Http\Livewire\Admin\Menu;


use App\Models\Log;
use App\Models\Menu;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $menu;
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
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect = Menu::where('title', 'LIKE', "%{$this->search}%")
                ->orWhere('link', 'LIKE', "%{$this->search}%")
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

    public function loadMenu()
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

    public function deleteAll()
    {
        if (Gate::allows('delete_option')) {
            foreach ($this->mulitiSelect as $value) {
                $menu = Menu::where('id', $value)->first();

                $menu->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی منو ',
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

    public function delete()
    {
        if (Gate::allows('delete_option')) {
            $data_info_id = Menu::findOrFail($this->IdBeingRemoved);
            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن منو' . '-' . $data_info_id->title,
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
        if (Gate::allows('edit_option')) {
            $data_info_id = Menu::find($id);
            $data_info_id->update([
                'status' => 0
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'غیر فعال کردن منو' . '-' . $data_info_id->title,
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
        if (Gate::allows('edit_option')) {
            $data_info_id = Menu::find($id);
            $data_info_id->update([
                'status' => 1
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' فعال کردن منو' . '-' . $data_info_id->title,
                'actionType' => ' فعال کردن'
            ]);
            $this->emit('toast', 'success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }
    }


    public function render()
    {


        $data_info = $this->readyToLoad ? Menu::where('title', 'LIKE', "%{$this->search}%")
            ->orWhere('link', 'LIKE', "%{$this->search}%")
            ->orWhere('id', $this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;


        return view('livewire.admin.menu.index', compact('data_info', 'deleteItem'));
    }
}
