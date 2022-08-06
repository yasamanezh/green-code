<?php

namespace App\Http\Livewire\Front\Category;

use App\FrontModels\Category;
use App\FrontModels\Product;
use App\Models\Filter;
use App\Models\ProductComment;
use App\Models\ProductProperty;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class ProductCategory extends Component
{



    public function mount()
    {

        $options=SiteOption::first();
        $description = 'پکیج طراحی سایت فروشگاهی';
        $title = 'پکیج طراحی سایت فروشگاهی';
        $keys='طراحی سایت فروشگاهی';
        $url = \Illuminate\Support\Facades\Request::url();
        $link = URL::to('/');
        $img = $link . '/storage/' . $options->logo;


        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keys);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'category');
        OpenGraph::addProperty('locale', 'fa-ir');
        OpenGraph::addImage(['url' => $img, 'size' => 300]);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('category');
        JsonLd::addImage(['url' => $img, 'size' => 300]);


    }


    public function render()
    {

        $categories=Category::where('status',1)->get();
        $products=Product::where('status',1)->get();
        return view('livewire.front.category.product-category',compact('categories','products'))->layout('layouts.front');
    }

}
