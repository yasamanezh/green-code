<?php

namespace App\Http\Livewire\Admin\Payment;

use App\Models\Email;
use App\Models\Log;
use App\Models\Order;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search,$count_data;

    protected $queryString = ['search'];
    public $readyToLoad = false;

    public Order $order;

    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
        public function loadEmail(){
        $this->readyToLoad=true;
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

    public function mount()
    {
        $this->count_data=10;
    }

    public function render()
    {
        $orders = $this->readyToLoad ? Order::where('order_number', 'LIKE', "%{$this->search}%")->
        orderBy($this->sortColumnName, $this->sortDirection)->
        orWhere('id', $this->search)->
        latest()->paginate($this->count_data) : [];

        return view('livewire.admin.payment.index',compact('orders'));
    }
}
