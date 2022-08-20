<?php

namespace App\Http\Livewire\Admin\Licence;

use App\Models\Licence;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Edit extends Component
{
    public $licence;


    public function mount($edit){
        $this->licence=Licence::FindOrFail($edit);
    }

    protected $rules = [
        'licence.url' => 'required|string|min:2|max:255',
        'licence.licence' => 'required',
        'licence.status' => 'nullable',
    ];

    public function saveInfo()
    {
        if(Gate::allows('edit_licence')){
            $this->validate();

            $this->licence->update();
            $msg = 'لایسنس ویرایش شد ';
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' ایجاد لایسنس  '. $this->licence->title,
                'actionType' => 'ایجاد'
            ]);
            return redirect(route('Licences'))->with('sucsess', $msg);
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }
    public function render()
    {
        return view('livewire.admin.licence.edit');
    }
}
