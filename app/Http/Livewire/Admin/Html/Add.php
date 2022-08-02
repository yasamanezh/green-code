<?php

namespace App\Http\Livewire\Admin\Html;

use App\Models\Html;
use App\Models\Log;
use App\Models\SiteOption;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component
{
    public Html $html;
    public $result = null;
    protected $rules = [
        'html.title' => 'required|string|min:2|max:255',
        'html.description' => 'required|string|min:3',
    ];

    public function mount()
    {
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
            return view('livewire.admin.category.add');
        }
        $this->html = new Html();
    }

    public function saveInfo()
    {
        if (Gate::allows('edit_design')) {
            $this->validate();
            $this->html->save();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن html' . '-' . $this->html->title,
                'actionType' => 'ایجاد'
            ]);
            $msg = 'ماژول html با موفقیت ایجاد  شد';
            return redirect(route('Htmls'))->with('sucsess', $msg);
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        return view('livewire.admin.html.add');
    }
}
