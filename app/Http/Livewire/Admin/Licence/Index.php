<?php

namespace App\Http\Livewire\Admin\Licence;

use App\Models\Licence;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;


    public $readyToLoad = false;
    public $search;
    public $mulitiSelect=[];
    public $count_data=10;
    protected $queryString=['search'];
    protected $paginationTheme = 'bootstrap';

    public $photo;

    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;



    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=Licence::where('url','LIKE',"%{$this->search}%")
                ->orWhere('licence','LIKE',"%{$this->search}%")
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

    public function delete(){


        if(Gate::allows('delete_video')){
            $data_info_id=Licence::findOrFail($this->categoryIdBeingRemoved);


            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن لایسنس ها' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function deleteAll(){
        if(Gate::allows('delete_video')){
            foreach ($this->mulitiSelect as $value){
                $video=Licence::where('id',$value)->first();

                $video->delete();
            }
            $this->mulitiSelect=[];
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی لایسنس ها ',
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


    public function statusDisable($id){
        if(Gate::allows('edit_licence')){
            $data_info_id=Licence::find($id);
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
                'url' => 'تغییر وضعیت لایسنس ها' .'-'. $data_info_id->title,
                'actionType' => $action
            ]);
            $this->emit('toast','success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }


    public function render()
    {


        $data_info = $this->readyToLoad ? Licence::where('url','LIKE',"%{$this->search}%")
            ->orWhere('licence','LIKE',"%{$this->search}%")
            ->orWhere('id',$this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) :[];

        $deleteItem=$this->mulitiSelect;


        return view('livewire.admin.licence.index',compact('data_info','deleteItem'));
    }
}
