<?php

namespace App\Http\Livewire\admin\manufacturer;

use App\Models\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Manufacturer;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Manufactor extends Component
{
    use WithFileUploads;
    use WithPagination;
	public  $manufacturer;
	public $data;
	public $title;
	public $slug;
	public $img;
	public $search;
    public $mulitiSelect=[];
    public $readyToLoad = false;
    public $count_data=10;
    protected $queryString=['search'];
    protected $paginationTheme = 'bootstrap';
    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=Manufacturer::where('title','LIKE',"%{$this->search}%")
                ->orWhere('slug','LIKE',"%{$this->search}%")
                ->orWhere('id',$this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->mulitiSelect=[];
        }

    }


    public function loadBrand()
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
    public function confirmCategoryRemoval($Id)
    {

        $this->categoryIdBeingRemoved = $Id;

        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllCategoryRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll(){
        if(Gate::allows('delete_brand')){

            foreach ($this->mulitiSelect as $value){
                $category=Manufacturer::where('id',$value)->first();
                $oldImage=storage_path().'/app/public/'.$category->img;

                if(file_exists($oldImage)){
                    File::delete($oldImage);
                }
                $category->delete();

            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی دسته ',
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
        if(Gate::allows('delete_brand')){
            $data_info_id=Manufacturer::findOrFail($this->categoryIdBeingRemoved);
            $oldImage=storage_path().'/app/public/'.$data_info_id->img;

            if(file_exists($oldImage)){
                File::delete($oldImage);
            }
            $data_info_id->delete();

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


   public function render()
    {


		$data_info =$this->readyToLoad ? Manufacturer::where('title','LIKE',"%{$this->search}%")
            ->orWhere('slug','LIKE',"%{$this->search}%")
            ->orWhere('id',$this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) :[];
        $deleteItem=$this->mulitiSelect;

        return view('livewire.admin.manufacturer.manufacturers',compact('data_info','deleteItem'));
    }
}
