<?php

namespace App\Http\Livewire\Admin\Noproduct;

use App\Models\Log;
use App\Models\Product;
use App\Models\NoProduct;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public Product $product;

    public $readyToLoad = false;
    public $search;
    public $mulitiSelect=[];
    public $count_data=10;
    protected $queryString=['search'];
    protected $paginationTheme = 'bootstrap';
    public $productIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;
    public function loadProduct()
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
    public function User($id){
        return User::findOrFail($id);
    }

      public function Product($id){
        return Product::findOrFail($id);
    }


    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function confirmProductRemoval($Id)
    {
        $this->productIdBeingRemoved = $Id;

        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllProductRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll(){
        if(Gate::allows('delete_product')){
            foreach ($this->mulitiSelect as $value){
                $product=NoProduct::where('id',$value)->first();


                $product->delete();


            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی لیست اطلاع از موجودی ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage=false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }


    }

    public function delete(){
        if(Gate::allows('delete_product')){
            $data_info_id=NoProduct::findOrFail($this->productIdBeingRemoved);

            $data_info_id->delete();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن به من اطلاع بده' .'-'. $data_info_id->title,
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
        $data_info =$this->readyToLoad ? NoProduct::where('user_id','LIKE',"%{$this->search}%")
            ->orWhere('product_id','LIKE',"%{$this->search}%")
            ->orWhere('email','LIKE',"%{$this->search}%")
            ->orWhere('phone','LIKE',"%{$this->search}%")
            ->orWhere('id',$this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) :[];
        $deleteItem=$this->mulitiSelect;


        return view('livewire.admin.noproduct.index',compact('data_info','deleteItem'));
    }
}
