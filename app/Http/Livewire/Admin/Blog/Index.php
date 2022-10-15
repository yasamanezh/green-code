<?php

namespace App\Http\Livewire\Admin\Blog;


use Illuminate\Support\Facades\Gate;
use App\Models\Log;
use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public Blog $blog;
    public $readyToLoad = false;
    public $search;
    public $count_data = 10;
    protected $queryString = ['search'];
    public $mulitiSelect = [];
    protected $paginationTheme = 'bootstrap';

    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=Blog::where('title', 'LIKE', "%{$this->search}%")
                ->orWhere('slug', 'LIKE', "%{$this->search}%")
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
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllCategoryRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll()
    {
        if (Gate::allows('delete_blog')) {


            foreach ($this->mulitiSelect as $value) {
                $category = Blog::where('id', $value)->first();

                $categories = Blog::get();
                foreach ($categories as $cat) {
                    if ($cat->parent == $category->id) {

                        $cat->update([
                            'parent' => 0,
                        ]);
                    }
                }
                $category->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی دسته ',
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
        if (Gate::allows('delete_blog')) {
            $data_info_id = Blog::findOrFail($this->categoryIdBeingRemoved);
            $categories = Blog::get();
            foreach ($categories as $category) {
                if ($category->parent == $this->categoryIdBeingRemoved) {
                    $category->update([
                        'parent' => 0,
                    ]);
                }
            }

            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن دسته' . '-' . $data_info_id->title,
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
        if (Gate::allows('edit_blog')) {
            $data_info_id = blog::find($id);
            if($data_info_id->status == 1){
                $status=0;
                $action='غیر فعال';
            }else{
                $status=1;
                $action=' فعال';
            }
            $data_info_id->update([
                'status'=>$status
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'تغییر وضعیت دسته بندی وبلاگ . '  . '_'. $data_info_id->title,
                'actionType' => $action
            ]);
            $this->emit('toast', 'success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }



    public function render()
    {
        $data_info = $this->readyToLoad ? Blog::where('title', 'LIKE', "%{$this->search}%")
            ->orWhere('slug', 'LIKE', "%{$this->search}%")
            ->orWhere('id', $this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.blog.index', compact('data_info',  'deleteItem'));
    }
}
