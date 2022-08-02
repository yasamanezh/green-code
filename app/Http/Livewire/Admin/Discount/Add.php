<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Log;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\Component;

class Add extends Component
{
    public $discount;
    public $showproducts = [];
    public $expire;
    public $selected = [],$selectGroup;
    public $isError=false;


    public function updated($key, $value)
    {
        $explode = Str::of($key)->explode('.');
        if ($explode[0] === 'selectGroup' && is_numeric($value)) {
            $productIds = Product::where('category', $value)->pluck('id')->map(fn($id) => (string)$id)->toArray();
            $this->selected = array_values(array_unique(array_merge_recursive($this->selected, $productIds)));
        } elseif ($explode[0] == 'selectGroup' && empty($value)) {
            $productIds = Product::where('category', $explode[1])->pluck('id')->map(fn($id) => (string)$id)->toArray();
            $this->selected = array_merge(array_diff($this->selected, $productIds));
        }

    }

    public function mount()
    {
        $this->discount = new Discount();
    }

    protected $rules = [

        'discount.percent' => 'nullable|numeric|min:0|max:100',
        'discount.price' => 'nullable|numeric|min:0',
        'discount.product_id' => 'nullable',
        'discount.status' => 'nullable',
        'discount.code' => 'nullable',
        'discount.count' => 'nullable',
        'discount.minimum' => 'nullable',
        'discount.max' => 'nullable',
        'discount.type_discount' => 'required',
        'discount.special' => 'nullable',
    ];


    public function categoryForm()
    {
        if($this->discount->type_discount == '5'){
            if((!isset($this->discount->percent)) && (!isset($this->discount->price)) ){
                $this->isError=true;
                return ;
            }

            $this->validate([
                'discount.minimum'=>'required|numeric|min:0',
                'discount.max'=>'required|numeric|min:1',
            ]);

        }
        if($this->discount->type_discount == '4'){
            if((!isset($this->discount->percent) ) && (!isset($this->discount->price)) ){
                $this->isError=true;
                return ;
            }
            $this->validate([
                'discount.code'=>'required',
                'discount.count'=>'required|numeric|min:1',
            ]);

        }
        if($this->discount->type_discount == '3' || $this->discount->type_discount == '1'  ){
            $this->validate([
                'discount.percent'=>'required',
            ]);
        }



        $this->showproducts=$this->selected;

        if (Gate::allows('edit_discount')) {
            $this->validate([
                'expire' => "required|date_format:Y/m/d-H:i",
            ]);
            $date_time = explode('-', $this->expire);
            $comma_separated = implode(",", $this->showproducts);
            $type_discount = (int)($this->discount->type_discount);
            if ($this->discount->type_discount == 1) {
                $type_discount = 1;
            } elseif ($this->discount->type_discount == 2) {
                $type_discount = 2;
            } elseif ($this->discount->type_discount == 3) {
                $type_discount = 3;
            } elseif ($this->discount->type_discount == 4) {
                $type_discount = 4;
            }

            $this->validate();
            $gift = Discount::query()->create([
                'date_expire' => $date_time[0],
                'time_expire' => $date_time[1],
                'special' => $this->discount->special,
                'price' => $this->discount->price,
                'percent' => $this->discount->percent,
                'product_id' => $comma_separated,
                'code' => $this->discount->code,
                'count' => $this->discount->count,
                'minimum' => $this->discount->minimum,
                'max' => $this->discount->max,
                'discount' => $type_discount,
                'status' => $this->discount->status,
            ]);

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن کد تخفیف' . '-' . auth()->user()->name,
                'actionType' => 'ایجاد'
            ]);
            $msg = 'تخفیف با موفقیت ایجاد شد.';
            return redirect(route('discounts'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function render()
    {
        $DiscountType = $this->discount->type_discount;
        $products = Product::where('status', 1)->get();
        $categories=Category::where('status',1)->get();

        return view('livewire.admin.discount.add', compact('products', 'DiscountType','categories'));
    }
}
