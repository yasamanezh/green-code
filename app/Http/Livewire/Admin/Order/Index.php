<?php

namespace App\Http\Livewire\Admin\Order;


use App\Models\Log;
use App\Models\Order;
use App\Models\ReceiptCenter;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $orderIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $count_data;
    public $mulitiSelect = [];
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=Order::where('address', 'LIKE', "%{$this->search}%")->
                orWhere('order_number', 'LIKE', "%{$this->search}%")->
                orWhere('transactionId', 'LIKE', "%{$this->search}%")
                ->orWhere('id',$this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->mulitiSelect=[];
        }

    }



    public function mount()
    {
        $this->count_data = 10;
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

    public function confirmOrderRemoval($orderId)
    {
        $this->orderIdBeingRemoved = $orderId;

        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllOrderRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll()
    {
        if (Gate::allows('delete_order')) {
            foreach ($this->mulitiSelect as $value) {
                $order = Order::where('id', $value)->first();

                $order->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی سفارش ',
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
        if (Gate::allows('delete_order')) {
            $data_info_id = Order::findOrFail($this->orderIdBeingRemoved);
            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن سفارش' . '-' . $data_info_id->title,
                'actionType' => 'حذف'
            ]);


            $this->dispatchBrowserEvent('hide-delete-modal');


            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }

    }


    protected $listeners = [
        'order.added' => '$refresh'
    ];
    protected $paginationTheme = 'bootstrap';
    public $search;

    protected $queryString = ['search'];

    public $readyToLoad = false;

    public function loadOrder()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $orders = $this->readyToLoad ? Order::where('address', 'LIKE', "%{$this->search}%")->
        orWhere('order_number', 'LIKE', "%{$this->search}%")->
        orWhere('transactionId', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)->
        orderBy($this->sortColumnName, $this->sortDirection)->
        latest()->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.order.index', compact('orders', 'deleteItem'));
    }
}
