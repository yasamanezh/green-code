<?php

namespace App\Http\Livewire\Admin\Footer;

use App\Models\Footer;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public  $footer;
    public $icon_1,$icon_11,$icon_2,$icon_22,$icon_3,$icon_33,$icon_4,$icon_44,$icon_5,$icon_55;
    public function mount(){
        $footer=Footer::first();

        if($footer){
            $this->footer=Footer::first();
            if($this->footer->icon_1){
                $this->icon_11=$this->footer->icon_1;
            }
            if($this->footer->icon_2){
                $this->icon_22=$this->footer->icon_2;
            }
            if($this->footer->icon_3){
                $this->icon_33=$this->footer->icon_3;
            }
            if($this->footer->icon_4){
                $this->icon_44=$this->footer->icon_4;
            }
            if($this->footer->icon_5){
                $this->icon_55=$this->footer->icon_5;
            }
        }else{
            $this->footer=new Footer();
        }

    }
    public function updated($name)
    {
        $this->validateOnly($name);
    }
    protected $rules=[
        'footer.footer_bottom'=>'required',
        'footer.title_1'=>'nullable',
        'footer.title_2'=>'nullable',
        'footer.title_3'=>'nullable',
        'footer.title_4'=>'nullable',
        'footer.title_5'=>'nullable',
        'footer.link_1'=>'nullable',
        'footer.link_2'=>'nullable',
        'footer.link_3'=>'nullable',
        'footer.link_4'=>'nullable',
        'footer.link_5'=>'nullable',
        'footer.category_1'=>'nullable',
        'footer.category_2'=>'nullable',
        'footer.category_3'=>'nullable',
        'footer.title_sub_31'=>'nullable',
        'footer.title_sub_32'=>'nullable',
        'footer.title_sub_33'=>'nullable',
        'footer.title_sub_34'=>'nullable',
        'footer.title_sub_35'=>'nullable',
        'footer.title_sub_21'=>'nullable',
        'footer.title_sub_22'=>'nullable',
        'footer.title_sub_23'=>'nullable',
        'footer.title_sub_24'=>'nullable',
        'footer.title_sub_25'=>'nullable',
        'footer.title_sub_1'=>'nullable',
        'footer.title_sub_2'=>'nullable',
        'footer.title_sub_3'=>'nullable',
        'footer.title_sub_4'=>'nullable',
        'footer.title_sub_5'=>'nullable',
        'footer.link_sub_31'=>'nullable',
        'footer.link_sub_32'=>'nullable',
        'footer.link_sub_33'=>'nullable',
        'footer.link_sub_34'=>'nullable',
        'footer.link_sub_35'=>'nullable',
        'footer.link_sub_21'=>'nullable',
        'footer.link_sub_22'=>'nullable',
        'footer.link_sub_23'=>'nullable',
        'footer.link_sub_24'=>'nullable',
        'footer.link_sub_25'=>'nullable',
        'footer.link_sub_1'=>'nullable',
        'footer.link_sub_2'=>'nullable',
        'footer.link_sub_3'=>'nullable',
        'footer.link_sub_4'=>'nullable',
        'footer.link_sub_5'=>'nullable',

    ];
    public function uploadImage($icon){

        $directory="photos/footer";
        $name=$icon->getClientOriginalName();
        $icon->storeAs($directory,$name);
        return "$directory/$name";
    }
    public function saveInfo(){
        if(Gate::allows('edit_option')){
            $this->validate();

            $oldoption=Footer::first();
            if($oldoption){
                if(isset($this->icon_1)){
                    $this->footer->icon_1=$this->uploadImage($this->icon_1);
                }
                if(isset($this->icon_2)){
                    $this->footer->icon_2=$this->uploadImage($this->icon_2);
                }
                if(isset($this->icon_3)){
                    $this->footer->icon_3=$this->uploadImage($this->icon_3);
                }
                if(isset($this->icon_4)){
                    $this->footer->icon_4=$this->uploadImage($this->icon_4);
                }
                if(isset($this->icon_5)){
                    $this->footer->icon_5=$this->uploadImage($this->icon_5);
                }
                $this->footer->update();
                $this->emit('toast', 'success','تنظیمات فوتر با موفقیت ذخیره شد.');
            }else{
                if(isset($this->icon_1)){
                    $this->footer->icon_1=$this->uploadImage($this->icon_1);
                }
                if(isset($this->icon_2)){
                    $this->footer->icon_2=$this->uploadImage($this->icon_2);
                }
                if(isset($this->icon_3)){
                    $this->footer->icon_3=$this->uploadImage($this->icon_3);
                }
                if(isset($this->icon_4)){
                    $this->footer->icon_4=$this->uploadImage($this->icon_4);
                }
                if(isset($this->icon_5)){
                    $this->footer->icon_5=$this->uploadImage($this->icon_5);
                }
                $this->footer->save();

                $this->emit('toast', 'success','تنظیمات فوتر با موفقیت ذخیره شد.');
            }

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }



    }
    public function render()
    {
        return view('livewire.admin.footer.index');
    }
}
