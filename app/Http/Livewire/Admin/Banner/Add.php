<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\Log;
use App\Models\SiteOption;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $img;

    public Banner $banner;
    public $result = null;
    protected $rules = [
        'banner.title' => 'required|string|min:2',
        'banner.link' => 'nullable',
        'banner.style' => 'required',
        'banner.height' => 'nullable|numeric|min:0',
        'img' => 'required|image|mimes:jpg,bmp,png,jpeg,gif,webp,svg',
    ];

    public function mount()
    {
        $this->banner = new Banner();
        $this->banner->style = 'banners-effect-8';
        $license = SiteOption::first()->license;
        $server = $_SERVER["SERVER_NAME"];
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://panel.green-code.ir/verifyLicense.php");
        curl_setopt($c, CURLOPT_TIMEOUT, 30);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $postfields = 'svr=' . $server . '&lic=' . $license;
        curl_setopt($c, CURLOPT_POSTFIELDS, $postfields);
        $check = curl_exec($c);
        if ($check == "verified") {
        } else {
            $this->result = $check;
            return view('livewire.admin.banner.add');
        }
    }

    public function saveInfo()
    {
        if (Gate::allows('edit_design')) {
            $this->validate();
            $banner = Banner::query()->create([
                'title' => $this->banner->title,
                'link' => $this->banner->link,
                'style' => $this->banner->style,
                'height' => $this->banner->height,
            ]);
            if ($this->img) {
                $banner->update([
                    'img' => $this->uploadImage()
                ]);
            }
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن بنر' . '-' . $this->banner->title,
                'actionType' => 'ایجاد'
            ]);
            $msg = 'بنر مورد نظر با موفقیت آپدیت شد.';
            return redirect(route('banner.index'))->with('sucsess', $msg);
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function uploadImage()
    {
        $directory = "photos/banner";
        $name = $this->img->getClientOriginalName();
        $this->img->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function render()
    {
        return view('livewire.admin.banner.add');
    }
}
