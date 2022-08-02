<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Brand;
use App\Models\Log;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithPagination;


    public $search;
    public $count_data=10;
    protected $queryString=['search'];
    protected $paginationTheme = 'bootstrap';
    public $categoryIdBeingRemoved = null;


    public $readyToLoad = false;

    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function delete(){


        if(Gate::allows('delete_page')){
            $data_info_id=Page::withTrashed()->findOrFail($this->categoryIdBeingRemoved);
            $data_info_id->forceDelete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن  صفحه سایت' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }
    }

    public function trashedCategory($id)
    {
        if(Gate::allows('edit_page')){
            $page = Page::withTrashed()->where('id', $id)->first();
            $page->restore();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'بازیابی صفحه سایت' .'-'. $page->title,
                'actionType' => 'بازیابی'
            ]);
            $this->emit('toast', 'success', ' صفحه سایت با موفقیت بازیابی شد.');
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {

        $data_info = DB::table('pages')
            ->whereNotNull('deleted_at')
            ->where('title','LIKE',"%{$this->search}%")
            ->latest()->paginate($this->count_data);

        return view('livewire.admin.page.trashed',compact('data_info'));
    }
}
