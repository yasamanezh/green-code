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
    use WithPagination;
    public $serachFilter=[
        'description'
    ];
    protected $paginationTheme = 'bootstrap';
    public Category $category;
    public $sub, $child;
    public Carbon $carbon;
    public $parent, $categories;
    public $options;
    public $likes;
    public $slug;
    public $i = 1;
    public $sortColumnName = 'countsell';
    public $sortDirection = 'desc';
    public $search;
    protected $queryString = 'search';
    public $min_price, $max_price, $Max, $min;
   public $quality;
    public $array=[];


    public $categoryKey, $filterKey = [], $catID = [], $filterID = [], $ProductIds = [];
    public $productProperty=[];


    public function calculateRate($id)
    {
        $stars = ProductComment::where('product_id', $id)->get();
        $count = count($stars);
        $rate = 0;
        if ($count > 0) {
            foreach ($stars as $star) {
                if ($star->star != NULL) {
                    $rate = $rate + $star->star;
                }
            }
            return (round($rate / $count));
            return ((($rate / $count) * 100) / 5);
        }
        return 0;
    }


    public function categoryFilter($value)
    {

        if ($this->categoryKey[$value]) {
            $this->catID[$value] = $value;
        } else {
            unset($this->catID[$value]);
        }

    }
    public $productId=[];

    public function propertyFilter($key, $keyfilter,$id)
    {
        $filte=Filter::find($key);
        if(isset($this->array[$filte->attribute][$id])){
            unset($this->array[$filte->attribute][$id]);
            if(count($this->array[$filte->attribute]) <=0 ){
                unset($this->array[$filte->attribute]);
            }
        }else{
            $this->array[$filte->attribute][$id]= $keyfilter;
        }

    }

    public function sortBy($columnName, $sort)
    {
        $this->sortDirection = $sort;
        $this->sortColumnName = $columnName;
    }



    public function mount()
    {
        $this->quality=0;
        $filters = Filter::where('status',1)->where('category_id', $this->category->id)->get();
        foreach ($filters as $filter){
            $this->serachFilter[$filter->attribute]='';
        }

        $category = $this->category;
        $options = SiteOption::first();
        $url = \Illuminate\Support\Facades\Request::url();
        $link = URL::to('/');
        $keys = explode(',', $category->meta_keyword);
        if ($category->meta_title) {
            $title = $category->meta_title;
        } else {
            $title = $category->title;
        }
        $description = $category->meta_description;
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


        $this->categories[1] = $category->id;
        if (isset($category->parent) && $category->parent != 0) {
            $this->sub = Category::where('id', $category->parent)->first();

            if (isset($this->sub)) {
                if (isset($this->sub->parent) && $this->sub->parent != 0) {
                    $this->child = Category::where('id', $this->sub->parent)->first();

                }
            }
        }
        $AllCategory = Category::where('status', 1)->where('parent', $category->id)->get();
        foreach ($AllCategory as $cat) {
            array_push($this->categories, $cat->id);
            $AllParent = Category::where('status', 1)->where('parent', $cat->id)->get();
            foreach ($AllParent as $parent) {
                array_push($this->categories, $parent->id);
            }
        }

        $max = 0;

        foreach ($this->categories as $cat1) {
            $productsInCategory = Product::where('category', $cat1)->get();
            if ($productsInCategory) {
                foreach ($productsInCategory as $product) {
                    if ($product->price > $max) {
                        $max = $product->price;
                    }
                }
            }

        }
        $this->Max = $max;
        $this->min = 0;
        $this->max_price = $max;
        $this->min_price = 0;


    }


    public function render()
    {


        $filters = Filter::where('status',1)->where('category_id', $this->category->id)->get();
        if ($this->catID) {
            $ProductIds = [];
            $categoriesInFilter=[];
            foreach ($this->catID as $val) {
                array_push($categoriesInFilter, $val);

                $subs=Category::where('status',1)->where('parent',$val)->get();
                if($subs){
                  foreach ($subs as $sub){
                      array_push($categoriesInFilter, $sub->id);
                      $childs=Category::where('status',1)->where('parent',$sub->id)->get();
                      if($childs){
                          foreach ($childs as $child){
                              array_push($categoriesInFilter, $child->id);
                          }
                      }
                }
                }


            }

            $ProductsByCategory = Product::where('status',1)->whereIn('category', $categoriesInFilter)->get();
            foreach ($ProductsByCategory as $pro) {
                array_push($ProductIds, $pro->id);
            }
        }
        else {
            $ProductIds = [];
            foreach ($this->categories as $key => $value) {
                $cats = Category::where('id', $value)->first();
                $productsInAll = Product::where('category', $cats->id)->get();
                foreach ($productsInAll as $pro) {
                    array_push($ProductIds, $pro->id);
                }
            }

        }


        if(count($this->array) >0){
            foreach ($this->array as $key=>$value){
                $propertyid[$key]=[];
                foreach ($this->array[$key] as $value1){
                    $filterProperties = ProductProperty::whereIn('product_id',$ProductIds)
                        ->where('description',$value1)
                        ->where('title',$key)
                        ->get();
                    foreach ($filterProperties as $propertyPro){
                        array_push($propertyid[$key],$propertyPro->product_id);
                    }
                }
                $ProductIds=$propertyid[$key];
            }

        }

        if($this->quality){
            $products = Product::whereIn('id', $ProductIds)
                ->orderBy($this->sortColumnName, $this->sortDirection)->
                where('title', 'LIKE', "%{$this->search}%")
                ->where('title', 'LIKE', "%{$this->search}%")
                ->where('quantity', '<>', 0)
                ->whereBetween('price', [$this->min_price, $this->max_price])
                ->where('status',1)->paginate(12);

        }else{
            $products = Product::whereIn('id', $ProductIds)
                ->orderBy($this->sortColumnName, $this->sortDirection)->
                where('title', 'LIKE', "%{$this->search}%")
                ->where('title', 'LIKE', "%{$this->search}%")
                ->whereBetween('price', [$this->min_price, $this->max_price])
                ->where('status',1)->paginate(12);

        }



        $siteOptions = SiteOption::first();

        $max = $this->Max;

        return view('livewire.front.category.product-category', compact('filters', 'siteOptions', 'products', 'max'))->layout('layouts.front');
    }

}
