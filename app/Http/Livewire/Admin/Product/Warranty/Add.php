<?php

namespace App\Http\Livewire\Admin\Product\Warranty;

use App\Models\Log;
use App\Models\Warranty;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component
{
    public $warranty,$name,$status;

    public function mount()
    {
      $this->status=1;
    }

    public function saveInfo()
    {
        if(Gate::allows('edit_garranty')){
            $this->validate([
                'name'=>'required|string|min:2|max:255',
            ]);
            $this->warranty=new Warranty();
            $this->warranty->name=$this->name;
            $this->warranty->status=$this->status;
            $this->warranty->save();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ایجاد گارانتی' .'-'. $this->warranty->name,
                'actionType' => 'ایجاد'
            ]);


            $msg = 'ایجاد گارانتی با موفقیت انجام شد.';
            return redirect(route('warrantys'))->with('sucsess', $msg);
        }else{

            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }



    }

    public function render()
    {
        return view('livewire.admin.product.warranty.add');
    }
}
