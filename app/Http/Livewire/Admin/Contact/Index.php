<?php

namespace App\Http\Livewire\Admin\Contact;


use App\Models\Contact;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Index extends Component
{

    protected $paginationTheme = 'bootstrap';

    public $search,$count_data;

    protected $queryString = ['search'];

    public $readyToLoad = false;
    public Contact $contact;
    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $mulitiSelect = [];
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect = Contact::where('name','LIKE',"%{$this->search}%")->
            orWhere('email','LIKE',"%{$this->search}%")
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
    public function deleteAll(){
        if(Gate::allows('edit_option')){
            foreach ($this->mulitiSelect as $value){
                $data=Contact::where('id',$value)->first();

                $data->delete();
            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی پیام  ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage=false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
    }
    public function delete(){
        if(Gate::allows('edit_option')){
            $data_info_id=Contact::findOrFail($this->categoryIdBeingRemoved);
            $data_info_id->delete();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن پیام ' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }
    public function mount()
    {

        $this->count_data=10;

    }
    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {

        $contacts = $this->readyToLoad ? Contact::where('name','LIKE',"%{$this->search}%")->
        orWhere('email','LIKE',"%{$this->search}%")->
        orderBy($this->sortColumnName, $this->sortDirection)->
        latest()->paginate($this->count_data) : [];


        $deleteItem=$this->mulitiSelect;

        return view('livewire.admin.contact.index',compact('contacts','deleteItem'));
    }
}
