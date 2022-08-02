<?php

namespace App\Http\Livewire\Front\Module;

use App\Models\Product;
use Livewire\Component;

class Category extends Component
{
    public function productCount($id){
        $count=0;

        $category=\App\Models\Category::where('id',$id)->first();

            $products=Product::where('status',1)->where('category',$category->id)->get();
            $count += count($products);
          $subs = \App\Models\Category::where('status', 1)->where('parent', $category->id)->get();
          if($subs){
            foreach ($subs as $cat) {
                $productsSub=Product::where('status',1)->where('category',$cat->id)->get();
                $count += count($productsSub);
                $childs = \App\Models\Category::where('status', 1)->where('parent', $cat->id)->get();
                if($childs){
                    foreach ($childs as $parent) {
                        $productsChild=Product::where('status',1)->where('category',$parent->id)->get();
                        $count += count($productsChild);

                    }
                }

            }
        }
        return $count;

    }

    public function render()
    {
        $categories=\App\FrontModels\Category::where('status',1)->
            where('parent',0)->
           take(9)->get();
        $products=Product::get();
        return view('livewire.front.module.category',compact('categories','products'));
    }
}
