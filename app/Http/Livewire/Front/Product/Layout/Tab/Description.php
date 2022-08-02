<?php

namespace App\Http\Livewire\Front\Product\Layout\Tab;

use App\Models\Product;
use Livewire\Component;

class Description extends Component
{
    public $product;
    public function mount($id){
        $this->product=Product::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.front.product.layout.tab.description');
    }
}
