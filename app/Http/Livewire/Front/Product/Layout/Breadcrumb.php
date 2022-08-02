<?php

namespace App\Http\Livewire\Front\Product\Layout;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Breadcrumb extends Component
{
    public $product;
    public $category,$sub,$child;

    public function mount($id){
        $this->product=Product::findOrFail($id);
        $product=$this->product;
        // دسته و زیر دسته محصول
        if($product){
            $category=Category::where('id',$product->category)->first();

            if($category){
                $this->category=$category;
            }
            if(isset($category->parent)){
                $sub=Category::where('id',$category->parent)->first();
                if($sub){
                    $this->sub=$sub;
                }
                if(isset($this->sub)){
                    if(isset($this->sub->parent)){
                        $child=Category::where('id',$this->sub->parent)->first();
                        if($child){
                            $this->child=$child;
                        }

                    }
                }
            }
            $this->categoryProduct= \App\Models\Product::where('category',$product->category)->get();
        }

    }
    public function render()
    {
        return view('livewire.front.product.layout.breadcrumb');
    }
}
