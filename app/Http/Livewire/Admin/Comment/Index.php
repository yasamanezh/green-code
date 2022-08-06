<?php

namespace App\Http\Livewire\Admin\Comment;


use App\Models\Comment;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;


    protected $paginationTheme = 'bootstrap';

    public $search, $count_data;

    protected $queryString = ['search'];

    public $readyToLoad = false;
    public Comment $comment;
    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $mulitiSelect = [];
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect= Comment::where('content', 'LIKE', "%{$this->search}%")
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
        if (Gate::allows('delete_comment')) {

            foreach ($this->mulitiSelect as $value) {
                $data = Comment::where('id', $value)->first();

                $data->delete();
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
        if (Gate::allows('delete_comment')) {
            $data_info_id = Comment::findOrFail($this->categoryIdBeingRemoved);

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

    public function mount()
    {

        $this->count_data = 10;

    }

    public function loadComment()
    {
        $this->readyToLoad = true;
    }

    public function disableStatus($id)
    {
        if (Gate::allows('edit_comment')) {
            $comment = Comment::find($id);

            if($comment->status == 1){
                $status=0;
                $action='غیر فعال';
            }else{
                $status=1;
                $action=' فعال';
            }
            $comment->update([
                'status'=>$status
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'تغییر وضعیت دیدگاه' . '-' . $comment->title,
                'actionType' => $action
            ]);

            $this->emit('toast', 'success', ' تغییر وضعیت با موفقیت انجام شد.');

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function enableStatus($id)
    {
        if (Gate::allows('edit_comment')) {
            $comment = Comment::find($id);

            $comment->update([
                'status' => 1
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'فعال کردن دیدگاه' . '-' . $comment->title,
                'actionType' => 'فعال کردن'
            ]);
            $this->emit('toast', 'success', ' دیدگاه با موفقیت فعال شد.');

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {

        $comments = $this->readyToLoad ? Comment::where('content', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)->
        orderBy($this->sortColumnName, $this->sortDirection)->
        latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.comment.index', compact('deleteItem', 'comments'));
    }
}
