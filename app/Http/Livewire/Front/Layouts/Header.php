<?php

namespace App\Http\Livewire\Front\Layouts;


use App\Models\Cart;
use App\Models\Menu;
use App\Models\SiteOption;
use Livewire\Component;
use App\Models\Category;
use App\Models\Product;


class Header extends Component
{


    public function render()
    {

        return view('livewire.front.layouts.header');
    }
}
