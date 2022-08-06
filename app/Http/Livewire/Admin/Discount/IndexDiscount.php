<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\Discount;
use App\Models\Log;
use App\Models\Product;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class IndexDiscount extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search,$count_data,$mulitiSelect=[];

    protected $queryString = ['search'];
    public $readyToLoad = false;
    public $showproducts=[];
    public Discount $discount;
    public $DiscountIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect =Discount::where('code', 'LIKE', "%{$this->search}%")->
            orWhere('percent', 'LIKE', "%{$this->search}%")->
            orWhere('product_id', 'LIKE', "%{$this->search}%")
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

    public function confirmDiscountRemoval($Id)
    {
        $this->DiscountIdBeingRemoved = $Id;
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllDiscountRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }
    public function expire($data)
    {
        $timeExpire = explode('/', $data->date_expire);
        $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
        $now = now();
        $expired = verta("$dateExpired[0]-$dateExpired[1]-$dateExpired[2] $data->time_expire");

        if (date_timestamp_get($expired) < date_timestamp_get($now)) {
            return true;
        } else {

            return false;
        }
    }
    public function deleteAll(){
        if(Gate::allows('delete_discount')){
            foreach ($this->mulitiSelect as $value){
                $discount=Discount::findOrFail($value);

                $discount->delete();
            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی تخفیف ',
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
        if(Gate::allows('delete_discount')){
            $data_info_id=Discount::findOrFail($this->DiscountIdBeingRemoved);
            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن تخفیف' .'-'. $data_info_id->title,
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
        $this->discount = new Discount();
        $this->count_data=10;
    }

    public function loadDiscount()
    {
        $this->readyToLoad = true;
    }

    public function disableStatus($id)
    {
        if(Gate::allows('edit_discount')){
            $discount = Discount::find($id);
            if($discount->status == 1){
                $status=0;
                $action='غیر فعال';
            }else{
                $status=1;
                $action=' فعال';
            }
            $discount->update([
                'status'=>$status
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'تغییر وضعیت کد تخفیف' . '-' . $discount->code,
                'actionType' => $action
            ]);

            $this->emit('toast', 'success', ' تغییر وضعیت با موفقیت انجام شد.');

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }


    public function render()
    {

        $discounts = $this->readyToLoad ? Discount::where('code', 'LIKE', "%{$this->search}%")->
        orWhere('percent', 'LIKE', "%{$this->search}%")->
        orWhere('product_id', 'LIKE', "%{$this->search}%")->
        orderBy($this->sortColumnName, $this->sortDirection)->
        orWhere('id', $this->search)->
        latest()->paginate($this->count_data) : [];
        $DiscountType=$this->discount->type_discount;
        $products=Product::where('status',1)->get();
        $deleteItem=$this->mulitiSelect;


        return view('livewire.admin.discount.index-discount',compact('discounts','deleteItem','products','DiscountType'));
    }
}
