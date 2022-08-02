<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithFileUploads;
    use WithPagination;
    public Category $category;
    public $data;
    public $search;
    public $count_data=10;
    protected $queryString=['search'];
    protected $paginationTheme = 'bootstrap';
    public $categoryIdBeingRemoved = null;

    public function mount(){
        $this->data['breadcrumbs_text'] = 'سطل زباله دسته بندی ها';
        $this->data['breadcrumbs_href'] = route('categories');
        $this->data['heading_title'] = ' سطل زباله دسته بندی ها';
    }

    public function trashedCategory($id){
        if(Gate::allows('edit_category')){
        $category=Category::withTrashed()->where('id',$id)->first();
        $category->restore();
        Log::create([
            'user_id' => auth()->user()->id,
            'url' => ',بازگرداندن دسته' .'-'. $category->title,
            'actionType' => 'بازگرداندن'
        ]);
        $this->emit('toast','success', 'دسته با موفقیت بازیابی شد');
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function delete(){


        if(Gate::allows('delete_category')){
            $data_info_id=Category::withTrashed()->findOrFail($this->categoryIdBeingRemoved);

            $oldImage=storage_path().'/app/public/'.$data_info_id->img;
            if($oldImage){
                File::delete($oldImage);
            }
            $data_info_id->forceDelete();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن دسته' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function render()
    {
        $data_info = DB::table('categories')
             ->whereNotNull('deleted_at')
               ->where('title','LIKE',"%{$this->search}%")
            ->latest()->paginate($this->count_data);

        return view('livewire.admin.category.trashed',compact('data_info'));
    }
}
