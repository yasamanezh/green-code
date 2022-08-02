<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public Banner $banner;

    public $img;
    public $UpdatedPhoto;

    public function mount(){

        $this->img=$this->banner->img;
    }
    protected $rules = [
        'banner.title' => 'required|string|min:2',
        'banner.link' => 'nullable',
        'banner.style' => 'required',
        'banner.height' => 'nullable|numeric|min:0',
    ];


    public function saveInfo()
    {

        if(Gate::allows('edit_design')){
            $this->validate();
            if ($this->UpdatedPhoto){
                $this->validate([
                    'UpdatedPhoto'=>'image|mimes:jpg,bmp,png,jpeg,gif,webp',
                ]);

                $this->banner->img= $this->uploadImage();
            }
            $this->banner->update();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'آپدیت بنر' .'-'. $this->banner->title,
                'actionType' => 'آپدیت'
            ]);
            $msg= 'بنر مورد نظر با موفقیت آپدیت شد.';
            return redirect(route('banner.index'))->with('sucsess',$msg);

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }
    public function uploadImage()
    {
        $directory = "photos/banner";
        $name = $this->UpdatedPhoto->getClientOriginalName();
        $oldImage=storage_path().'/app/public/'.$this->banner->img;

        if(file_exists($oldImage)){
            File::delete($oldImage);
        }
        $this->UpdatedPhoto->storeAs($directory, $name);
        return "$directory/$name";
    }


    public function render()
    {
        $banner = $this->banner;
        return view('livewire.admin.banner.update',compact('banner'));
    }
}
