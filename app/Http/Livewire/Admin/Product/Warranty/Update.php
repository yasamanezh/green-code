<?php

namespace App\Http\Livewire\Admin\Product\Warranty;

use App\Models\Log;
use App\Models\Warranty;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{

    public Warranty $warranty;
    protected $rules = [
        'warranty.name' => 'required|string|min:2|max:255',
        'warranty.status' => 'required',
    ];
    public function saveInfo()
    {
        if(Gate::allows('edit_garranty')){
            $this->validate();

            $this->warranty->update($this->validate());

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'آپدیت گارانتی' .'-'. $this->warranty->name,
                'actionType' => 'آپدیت'
            ]);


            $msg = 'ویرایش گارانتی با موفقیت انجام شد.';
            return redirect(route('warrantys'))->with('sucsess', $msg);
        }else{

            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function render()
    {
        return view('livewire.admin.product.warranty.update');
    }
}
