<?php

namespace App\Http\Livewire\Admin\Blog;


use App\Models\Blog;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{

    use WithPagination;

    public Blog $blog;
    public $search;
    public $count_data = 10;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';


    public function trashedCategory($id)
    {
        if (Gate::allows('edit_blog')) {
            $blog = Blog::withTrashed()->where('id', $id)->first();
            $blog->restore();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' بازیابی دسته بندی وبلاگ' . '-' . $blog->title,
                'actionType' => 'بازیابی'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'بلاگ با موفقیت بازیابی شد');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function delete()
    {
        if (Gate::allows('delete_blog')) {
            $data_info_id = Blog::withTrashed()->findOrFail($this->categoryIdBeingRemoved);
            $data_info_id->forceDelete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن دسته  بندی وبلاگ' . '-' . $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }
    }

    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function render()
    {
        $data_info = DB::table('blogs')
            ->whereNotNull('deleted_at')
            ->where('title', 'LIKE', "%{$this->search}%")
            ->latest()->paginate($this->count_data);
        return view('livewire.admin.blog.trashed', compact('data_info'));
    }
}
