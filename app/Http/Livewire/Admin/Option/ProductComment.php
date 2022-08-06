<?php

namespace App\Http\Livewire\Admin\Option;


use App\Models\Log;
use App\Models\ProductComment as ProductCommentModels;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

use Livewire\WithPagination;

class ProductComment extends Component
{

    use WithPagination;

    public $Comment;

    public $readyToLoad = false;
    public $search;
    public $mulitiSelect = [];
    public $count_data = 10;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $level;
    public $level1;
    public $photo, $CommentLevel;

    public $CommentIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=ProductCommentModels::where('title','LIKE',"%{$this->search}%")
                ->orWhere('id',$this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->mulitiSelect=[];
        }

    }



    public function loadComment()
    {
        $this->readyToLoad = true;
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

    public function confirmCommentRemoval($CommentId)
    {
        $this->CommentIdBeingRemoved = $CommentId;

        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllCommentRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll()
    {
        if (Gate::allows('delete_product')) {
            foreach ($this->mulitiSelect as $value) {
                $Comment = ProductCommentModels::where('id', $value)->first();

                $Comment->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی دیدگاه ',
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
        if (Gate::allows('delete_product')) {
            $data_info_id = ProductCommentModels::findOrFail($this->CommentIdBeingRemoved);

            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن دیدگاه' . '-' . $data_info_id->title,
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
        if (Gate::allows('edit_product')) {
            $data_info_id = ProductCommentModels::find($id);
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
                'url' => 'تغییر وضعیت دیدگاه' . '-' . $data_info_id->title,
                'actionType' => $action
            ]);
            $this->emit('toast', 'success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function statusEnable($id)
    {
        if (Gate::allows('edit_product')) {
            $data_info_id = ProductCommentModels::find($id);
            $data_info_id->update([
                'status' => 1
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' فعال کردن دیدگاه' . '-' . $data_info_id->title,
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
        $data_info = $this->readyToLoad ? ProductCommentModels::where('title', 'LIKE', "%{$this->search}%")
            ->orWhere('id', $this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.option.product-comment', compact('data_info', 'deleteItem'));
    }
}
