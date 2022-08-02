<?php

namespace App\Http\Livewire\Admin\Filter;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Attribute;
use App\Models\Filter as FilterModels;

class Update extends Component
{

    public FilterModels $filter;
    public $data,$title,$category_id,$status;
    public $search;
    public $count_data=10;
    public $inputFilter = [], $filter_title, $filter_value=[],$i=1;
    protected $queryString=['search'];
    public function AddFilter($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputFilter ,$i);
    }
    public function removeFilter($i)
    {

        unset($this->inputFilter[$i]);
        unset($this->filter_value[$i]);
        unset($this->filter_title);

    }

    public function mount()
    {
        $this->status = $this->filter->status;
        $this->title = $this->filter->title;
        $this->filter_title = $this->filter->attribute;
        $this->category_id = $this->filter->category_id;
        if ($this->filter->attribute_id) {
            $arrayattr = explode(',', $this->filter->attribute_id);
            foreach ($arrayattr as $value) {
                array_push($this->inputFilter, $value);
                array_push($this->filter_value, $value);

            }

        }
    }
    public function saveInfo(){
        if(Gate::allows('edit_filter')){
            $this->validate([
                'title'=>'required|string|min:2|max:255',
                'filter_title'=>'required',
                'category_id'=>'required',
            ]);
            $attribute='';
            foreach ($this->filter_value as $key=>$value){
                if($attribute !=''){
                    $attribute=$attribute .','.$this->filter_value[$key];
                }else{
                    $attribute=$this->filter_value[$key];
                }

            }
            if(! $attribute){
                $this->emit('toast', 'warning', 'لطفا برای فیلتر مورد نظر مقدار مشخص کنید.');
                return ;
            }

            $this->filter->status=$this->status;
            $this->filter->title=$this->title;
            $this->filter->attribute=$this->filter_title;
            $this->filter->category_id=$this->category_id;
            $this->filter->attribute_id=$attribute;
            $this->filter->update();

            if($this->filter){
                Log::create([
                    'user_id' => auth()->user()->id,
                    'url' => 'ویرایش فیلتر '.$this->title,
                    'actionType' => 'ویرایش'
                ]);
                $msg = 'فیلتر با موفقیت ویرایش شد.';
                return redirect(route('Filters'))->with('sucsess', $msg);


            }
        }else{

            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }
    public function render()
    {
        $attribute=Attribute::get();
        $categories=Category::where('parent',0)->
        orWhere('parent',NULL)->
        get();
        return view('livewire.admin.filter.update',compact('categories','attribute'));
    }
}
