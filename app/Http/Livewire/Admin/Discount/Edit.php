<?php

namespace App\Http\Livewire\Admin\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Log;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public $discount;
    public $showproducts = [];
    public $selected = [];
    public $isError=false;

    public $selectGroup;

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


    public function mount($edit)
    {
        $this->discount = Discount::find($edit);
        $this->discount->type_discount = $this->discount->discount;
        $time = explode(':', $this->discount->time_expire);
        $this->showproducts = explode(',', $this->discount->product_id);
        $this->selected = $this->showproducts;
        $this->discount->time = $time[0];
        $this->discount->minute = $time[1];
        $this->expire = $this->discount->date_expire . '-' . $time[0] . ':' . $time[1];
    }

    protected $rules = [

        'discount.percent' => 'nullable|numeric|min:0|max:100',
        'discount.price' => 'nullable',
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

        if ($this->discount->type_discount == '5') {
            if((!isset($this->discount->percent)) && (!isset($this->discount->price)) ){
                $this->isError=true;
                return ;
            }
            $this->validate([
                'discount.minimum' => 'required|numeric|min:0',
                'discount.max' => 'required|numeric|min:1',
            ]);

        }
        if ($this->discount->type_discount == '4') {
            if((!isset($this->discount->percent)) && (!isset($this->discount->price) ) ){
                $this->isError=true;
                return ;
            }
            $this->validate([
                'discount.code' => 'required',
                'discount.count' => 'required|numeric',
            ]);

        }
        if ($this->discount->type_discount == '3' || $this->discount->type_discount == '1') {
            $this->validate([
                'discount.percent' => 'required|numeric|min:0|max:100',
            ]);
        }

        $this->showproducts = $this->selected;

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

            $discount = Discount::find($this->discount->id);
            $discount->date_expire = $date_time[0];
            $discount->time_expire = $date_time[1];
            $discount->percent = $this->discount->percent;
            $discount->product_id = $comma_separated;
            $discount->special = $this->discount->special;
            $discount->code = $this->discount->code;
            $discount->count = $this->discount->count;
            $discount->minimum =(int)$this->discount->minimum;
            $discount->max = (int)$this->discount->max;
            $discount->price = $this->discount->price;
            $discount->discount = $type_discount;
            $discount->status = $this->discount->status;
            $discount->update();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ویرایش کد تخفیف' . '-' . $this->discount->id,
                'actionType' => 'ویرایش'
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
        $categories = Category::where('status', 1)->get();
        return view('livewire.admin.discount.edit', compact('products', 'DiscountType', 'categories'));
    }
}
