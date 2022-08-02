<?php

namespace App\Http\Livewire\admin\manufacturer;

use App\Models\Log;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;
 use Livewire\WithFileUploads;
 use Image;


class EditManufactor extends Component
{
    use WithFileUploads;
    public Manufacturer $manufacturer;
    public $data, $title,$slug,$img, $UpdatedPhoto;
    public function mount(){
        $this->title=$this->manufacturer->title;
        $this->slug=$this->manufacturer->slug;
        $this->img=$this->manufacturer->img;

    }
    public function uploadImage(){
        $directory="photos/brand";
        $thumb=storage_path('app/public/photos/brand/').$this->UpdatedPhoto->getClientOriginalName();
        $name=$this->UpdatedPhoto->getClientOriginalName();
        $this->UpdatedPhoto->storeAs($directory,$name);
        $oldImage=storage_path().'/app/public/'.$this->manufacturer->img;
        if($oldImage){
            File::delete($oldImage);
        }
        Image::make($this->UpdatedPhoto->getRealPath())->resize(160, 160)->save($thumb);
        return "$directory/$name";
    }
    public function saveInfo(){
        if(Gate::allows('edit_brand')){
            $this->validate([
                'title' => ['required','string','min:2','max:255', Rule::unique('manufacturers')->ignore($this->manufacturer->id)],
                'slug' => ['required','string','min:2','max:255', Rule::unique('manufacturers')->ignore($this->manufacturer->id)],
            ]);
            $this->manufacturer->title = $this->title;
            $this->manufacturer->slug = $this->slug;


            if(isset($this->UpdatedPhoto)){
                $this->validate([
                    'UpdatedPhoto'=>'image|max:800|mimes:jpg,bmp,png,jpeg,gif,webp'
                ]);
                $img=$this->uploadImage();
            }else{

                $img=$this->manufacturer->img;
            }
            $this->manufacturer->update([
                'img'=>$img
            ]);
            if($this->manufacturer){
                Log::create([
                    'user_id' => auth()->user()->id,
                    'url' => 'ویرایش برند' .'-'. $this->manufacturer->title,
                    'actionType' => 'ویرایش'
                ]);
                $msg = 'ویرایش  با موفقیت انجام شد.';
                return redirect(route('Manufacturers'))->with('sucsess', $msg);
            }
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }
    public function render()
    {

        $data_info=$this->manufacturer;
        return view('livewire.admin.manufacturer.edit-manufacturer',compact('data_info'));
    }
}
