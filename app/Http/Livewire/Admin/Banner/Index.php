<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $img;
    public $search;
    public $count_data = 10;
    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $mulitiSelect = [];
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    protected $queryString = ['search'];

    public $readyToLoad = false;

    public Banner $banner;
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect = Banner::where('title', 'LIKE', "%{$this->search}%")->
            orWhere('link', 'LIKE', "%{$this->search}%")
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

    public function deleteAll()
    {
        if (Gate::allows('delete_design')) {

            foreach ($this->mulitiSelect as $value) {
                $data = Banner::where('id', $value)->first();
                $oldImage=storage_path().'/app/public/'.$data->img;
                if(file_exists($oldImage)){
                    File::delete($oldImage);
                }
                $data->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی بنر ',
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
        if (Gate::allows('delete_design')) {
            $data_info_id = Banner::findOrFail($this->categoryIdBeingRemoved);
            $oldImage=storage_path().'/app/public/'.$data_info_id->img;
            if(file_exists($oldImage)){
                File::delete($oldImage);
            }
            $data_info_id->delete();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن بنر' . '-' . $data_info_id->title,
                'actionType' => 'حذف'
            ]);


            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }

    }

    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        $banners = $this->readyToLoad ? Banner::where('title', 'LIKE', "%{$this->search}%")->
        orWhere('link', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)->
        orderBy($this->sortColumnName, $this->sortDirection)->
        latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.banner.index', compact('banners', 'deleteItem'));
    }
}
