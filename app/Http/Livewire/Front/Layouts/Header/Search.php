<?php

namespace App\Http\Livewire\Front\Layouts\Header;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search;
    protected $queryString = ['search'];

    public function search(){
    if(!empty($this->search)){
        return redirect(route('Search',$this->search));

    }
   }
    public function render()
    {
        $products =Product::where('status',1)->where('title', 'LIKE', "%{$this->search}%")->
        orWhere('slug', 'LIKE', "%{$this->search}%")->
        latest()->paginate(10) ;
        $categories =Category::where('status',1)->where('title', 'LIKE', "%{$this->search}%")->
        orWhere('slug', 'LIKE', "%{$this->search}%")->
        latest()->paginate(10) ;
        return view('livewire.front.layouts.header.search',compact('categories','products'));
    }
}
