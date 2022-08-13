<?php

namespace App\Http\Livewire\Front\Product\Layout\Tab;

use App\Models\AttributeGroup;
use App\Models\Product;
use App\Models\SiteOption;
use Livewire\Component;

class Attr extends Component
{
    public $product;
    public $i=1;
    public function mount($id){
        $this->product=Product::findOrFail($id);
    }
    public function hasAttr($id)
    {
        $i=0;
        foreach (\App\Models\Attribute::where('group', $id)->where('category_id', $this->product->category)->get() as $value2)

        foreach (\App\Models\ProductProperty::where('product_id', $this->product->id)->where('title', $value2->id)->get() as $value1){
            if (isset($value1->description) && !empty($value1->description)){
                $i++;
            }
        }
        if($i > 0) {
            return true;
        }else{
            return false;
        }
       }

    public function hasValueAttribute($id)
    {
         $description=\App\Models\ProductProperty::where('product_id',$this->product->id)->where('title',$id)->first();
       if(isset($description->description) && !empty($description->description)){
           return true;
       } else{
           return false;
       }
       }

    public function render()
    {
        $siteOption=SiteOption::first();
        $attributeGroup=AttributeGroup::where('category_id',$this->product->category)->get();
        return view('livewire.front.product.layout.tab.attr',compact('attributeGroup','siteOption'));
    }
}
