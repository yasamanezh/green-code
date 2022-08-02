<?php

namespace App\Http\Livewire\Admin\Product\Warranty;

use App\Models\Color;
use App\Models\Log;
use App\Models\Warranty;
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
    public $count_data;
    public $mulitiSelect=[];

    protected $queryString = ['search'];

    public $readyToLoad = false;

    public Warranty $warranty;

    public $GarrantyIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect= Warranty::where('name', 'LIKE', "%{$this->search}%")
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

    public function confirmGarrantyRemoval($Id)
    {
        $this->categoryIdBeingRemoved = $Id;

        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllGarrantyRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll(){
        if(Gate::allows('delete_garranty')){
            foreach ($this->mulitiSelect as $value){
                $Garrenty=Warranty::where('id',$value)->first();
                $Garrenty->delete();
            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی گارانتی ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage=false;

            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }


    }

    public function delete(){
        if(Gate::allows('delete_garranty')){
            $data_info_id=Warranty::findOrFail($this->categoryIdBeingRemoved);
            $data_info_id->delete();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گارانتی' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);


            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }

    }

    public function mount()
    {
        $this->warranty = new Warranty();
        $this->count_data=10;
    }

    protected $rules = [
        'warranty.name' => 'required',
        'warranty.status' => 'nullable',
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }



    public function loadGarrenty()
    {
        $this->readyToLoad = true;
    }

    public function updateDisable($id)
    {
        if(Gate::allows('edit_garranty')){
            $warranty = Warranty::find($id);
            $warranty->update([
                'status' => 0
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'غیرفعال کردن وضعیت گارانتی' .'-'. $this->warranty->name,
                'actionType' => 'غیرفعال'
            ]);
            $this->emit('toast', 'success', 'وضعیت گارانتی با موفقیت غیرفعال شد.');

        }else{

            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function updateEnable($id)
    {
        if(Gate::allows('edit_garranty')){
            $warranty = Warranty::find($id);
            $warranty->update([
                'status' => 1
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'فعال کردن وضعیت گارانتی' .'-'. $this->warranty->name,
                'actionType' => 'فعال'
            ]);
            $this->emit('toast', 'success', 'وضعیت گارانتی با موفقیت فعال شد.');
        }else{

            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {

        $warranties = $this->readyToLoad ? Warranty::where('name', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)->
        orderBy($this->sortColumnName, $this->sortDirection) ->
        latest()->paginate($this->count_data) : [];
        $deleteItem=$this->mulitiSelect;
        return view('livewire.admin.product.warranty.index',compact('warranties','deleteItem'));
    }
}
