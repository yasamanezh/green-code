<?php

namespace App\Http\Livewire\Front\Search;

use App\FrontModels\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Like;
use App\Models\ProductComment;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $readyToLoad = false;
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

    public function mount($productId,$char =""){

        $this->search=$productId;
        SEOMeta::setTitle($this->search);
    }
    public function render()
    {
        $products =$this->readyToLoad ? Product::where('status',1)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->where('title', 'LIKE', "%{$this->search}%")->
        orWhere('slug', 'LIKE', "%{$this->search}%")->
        latest()->paginate(15) :[] ;
        $options=SiteOption::first();
        return view('livewire.front.search.index',compact('products','options'))->layout('layouts.front');;
    }
}
