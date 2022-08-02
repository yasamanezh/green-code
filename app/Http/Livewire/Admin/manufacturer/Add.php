<?php

namespace App\Http\Livewire\Admin\Manufacturer;

use App\Models\Log;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;


class Add extends Component
{
    use WithFileUploads;
    public  $manufacturer;
    public $data,$title,$slug,$img;

    public function uploadImage(){
        $directory="photos/brand";
        $thumb=storage_path('app/public/photos/brand/').$this->img->getClientOriginalName();
        $name=$this->img->getClientOriginalName();
        $this->img->storeAs($directory,$name);
        Image::make($this->img->getRealPath())->resize(160, 160)->save($thumb);
        return "$directory/$name";
    }

    public function saveInfo(){
        if(Gate::allows('edit_brand')){
            $this->validate([
                'title'=>'required|min:3|max:255|unique:manufacturers',
                'slug'=>'required|min:3|max:255|unique:manufacturers',
                'img'=>'required|image|max:800|mimes:jpg,bmp,png,jpeg,gif,webp',
            ]);

            $this->manufacturer=new Manufacturer();
            $this->manufacturer->title=$this->title;
            $this->manufacturer->slug=$this->slug;
            if(isset($this->img)){
                $this->manufacturer->img=$this->uploadImage();
            }
            $this->manufacturer->save();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' ایجاد برند' .'-'. $this->manufacturer->title,
                'actionType' => 'ایجاد'
            ]);
            if($this->manufacturer){
                $msg = 'ذخیره سازی با موفقیت انجام شد.';
                return redirect(route('Manufacturers'))->with('sucsess', $msg);
            }


        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }
    public function render()
    {
        return view('livewire.admin.manufacturer.add');
    }
}
