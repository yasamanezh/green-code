<?php

namespace App\Http\Livewire\admin\Dashboard;

use App\Models\Contact;
use App\Models\Order;
use App\Models\SiteOption;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $usersCount;
    public $orderPrice;
    public $getOrder;
    public $Price;
    public $result = null;

    public function mount()
    {
        $this->getUsersCount();
        $this->getOrderPrice();
        $this->getOrder();
        $this->Price();
    }

    public function getUsersCount($option = 'TODAY')
    {
        $this->usersCount = User::query()
            ->whereBetween('created_at', $this->getDateRange($option))
            ->count();
    }

    public function getDateRange($option)
    {
        if ($option == 'TODAY') {
            return [now()->today(), now()];
        }
        if ($option == 'MTD') {
            return [now()->firstOfMonth(), now()];
        }
        if ($option == 'YTD') {
            return [now()->firstOfYear(), now()];
        }
        return [now()->subDays($option), now()];
    }

    public function getOrderPrice($option = 'TODAY')
    {
        $this->getOrderPrice = Order::query()
            ->whereBetween('updated_at', $this->getDateRange($option))
            ->count();
    }

    public function getOrder($option = 'TODAY')
    {
        $this->getOrder = Order::query()
            ->where('status', 200)
            ->whereBetween('updated_at', $this->getDateRange($option))
            ->count();
    }

    public function Price($option = 'TODAY')
    {
        $orders = Order::query()
            ->where('status', 200)
            ->whereBetween('updated_at', $this->getDateRange($option))
            ->get();
        $price = 0;
        if ($orders) {
            foreach ($orders as $order) {
                $price += $order->prices;
            }
        }
        $this->Price = $price;
    }

    public function render()
    {
        $contacts = Contact::orderBy('id', 'DESC')->take(10)->get();
        $orders = \App\Models\Order::orderBy('id', 'DESC')->take(10)->get();
        return view('livewire.admin.dashboard.index', compact('orders', 'contacts'));
    }
}
