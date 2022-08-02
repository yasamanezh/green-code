<?php

namespace App\Http\Livewire\Front\Brand;

use App\FrontModels\Manufacturer;
use App\FrontModels\Product;
use App\Models\ProductComment;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $brand;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $readyToLoad = false;
    use WithPagination;
    public $sortColumnName = 'countsell';
    public $sortDirection = 'desc';
    public function sortBy($columnName,$sort)
    {
        $this->sortDirection = $sort;
        $this->sortColumnName = $columnName;
    }
    public function isReady()
    {
        $this->readyToLoad = true;
    }

    public function calculateRate($id){
        $stars=ProductComment::where('product_id',$id)->get();
        $count=count($stars);
        $rate=0;
        if($count > 0){
            foreach ($stars as $star){
                if($star->star != NULL){
                    $rate=$rate+$star->star;
                }
            }
            return (round($rate/$count));
            return ((($rate/$count)*100)/5);
        }
        return 0;
    }

    public function mount($brand){
        $this->brand=Manufacturer::where('slug',$brand)->first();
        SEOMeta::setTitle( $this->brand->title);
    }
    public function render()
    {
        $products=Product::where('manufacturer',$this->brand->id)->orderBy($this->sortColumnName, $this->sortDirection)->paginate(12);
        $options=SiteOption::first();
        return view('livewire.front.brand.index',compact('options','products'))->layout('layouts.front');
    }
}
