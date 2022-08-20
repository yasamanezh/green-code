<?php

namespace App\Http\Livewire\Admin\Video;

use App\Models\Log;
use App\Models\Product;
use App\Models\ProductVideo;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component
{
    public $video;


    public function mount(){
        $this->video=new ProductVideo();
    }

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    protected $rules = [
        'video.title' => 'required|string|min:2|max:255',
        'video.link' => 'required',
        'video.description' => 'nullable|string|min:2',
        'video.product_id' => 'required',
        'video.sort' => 'required',
        'video.status' => 'nullable',
    ];

    public function saveInfo()
    {
        if(Gate::allows('edit_video')){
            $this->validate();

            $this->video->save();
            $msg = 'ویدئو ذخیره شد ';
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' ایجاد ویدئو  '. $this->video->title,
                'actionType' => 'ایجاد'
            ]);
            return redirect(route('Videos'))->with('sucsess', $msg);
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }
    public function render()
    {
        $products=Product::get();
        return view('livewire.admin.video.add',compact('products'));
    }
}
