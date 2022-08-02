<?php

namespace App\Http\Livewire\Admin\Option;


use App\Models\Question as QuestionModels;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Question extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';

    public $search, $count_data;

    protected $queryString = ['search'];

    public $readyToLoad = false;
    public Question $question;
    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $mulitiSelect = [];
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=QuestionModels::where('question','LIKE',"%{$this->search}%")
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
        if (Gate::allows('delete_product')) {
            foreach ($this->mulitiSelect as $value) {
                $data = QuestionModels::where('id', $value)->first();

                $data->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی پرسش ',
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
            $data_info_id = QuestionModels::findOrFail($this->categoryIdBeingRemoved);
            $data_info_id->delete();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن پرسش' . '-' . $data_info_id->title,
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

    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function disableStatus($id)
    {
        if (Gate::allows('edit_product')) {
            $question = QuestionModels::find($id);

            $question->update([
                'status' => 0
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'غیرفعال کردن پرسش' . '-' . $question->title,
                'actionType' => 'غیر فعال کردن'
            ]);

            $this->emit('toast', 'success', ' پرسش با موفقیت غیرفعال شد.');

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function enableStatus($id)
    {
        if (Gate::allows('edit_product')) {
            $question = QuestionModels::find($id);
            $question->update([
                'status' => 1
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'فعال کردن پرسش' . '-' . $question->title,
                'actionType' => 'فعال کردن'
            ]);
            $this->emit('toast', 'success', ' پرسش با موفقیت فعال شد.');

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {

        $questions = $this->readyToLoad ? QuestionModels::

        orWhere('question', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)->
        orderBy($this->sortColumnName, $this->sortDirection)->
        latest()->paginate($this->count_data) : [];


        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.option.question', compact('questions', 'deleteItem'));
    }
}
