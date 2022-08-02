<?php

namespace App\Http\Livewire\Admin\Html;

use App\Models\Html;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Update extends Component
{
    public Html $html;

    public function mount(){

    }

    protected $rules = [
        'html.title' => 'required|string|min:2|max:255',
        'html.description' => 'required|string|min:2',
    ];

    public function saveInfo()
    {
        if(Gate::allows('edit_design')){
            $this->validate();

            $this->html->update();


            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ویرایش html' .'-'. $this->html->title,
                'actionType' => 'ویرایش'
            ]);
            $msg = 'ماژول html با موفقیت ویرایش  شد';
            return redirect(route('Htmls'))->with('sucsess', $msg);
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        return view('livewire.admin.html.update');
    }
}
