<?php

namespace App\Http\Livewire\Admin\Option;

use App\Models\Country;
use App\Models\Page;
use App\Models\SiteOption;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public SiteOption $siteOption;
    public $logo, $icon, $uploadlogo, $uploadads, $uploadicon, $ads, $Signature, $uploadSignature;
    public $status = null;
    protected $rules = [
        'siteOption.name' => 'required',
        'siteOption.home' => 'required',
        'siteOption.address' => 'nullable',
        'siteOption.geocode' => 'nullable',
        'siteOption.ads_status' => 'nullable',
        'siteOption.email' => 'nullable|email',
        'siteOption.telephone' => 'nullable',
        'siteOption.sms_password' => 'nullable',
        'siteOption.sms_usename' => 'nullable',
        'siteOption.sms_panel' => 'nullable',
        'siteOption.offline_pay' => 'nullable',
        'siteOption.city' => 'nullable',
        'siteOption.meta_title' => 'nullable',
        'siteOption.meta_description' => 'nullable',
        'siteOption.meta_keyword' => 'nullable',
        'siteOption.zone' => 'nullable',
        'logo' => 'nullable',
        'icon' => 'nullable',
        'siteOption.mail_parameter' => 'nullable',
        'siteOption.mail_username' => 'nullable',
        'siteOption.mail_password' => 'nullable',
        'siteOption.mail_mailer' => 'nullable',
        'siteOption.mail_host' => 'nullable',
        'siteOption.mail_port' => 'nullable',
        'siteOption.mail_encription' => 'nullable',
        'siteOption.header_code' => 'nullable',
        'siteOption.footer_code' => 'nullable',
        'siteOption.custome_css' => 'nullable',
        'siteOption.custome_js' => 'nullable',
        'siteOption.samandehi' => 'nullable',
        'siteOption.enamad' => 'nullable',
        'siteOption.saderat_terminal' => 'nullable',
        'siteOption.meli_terminal' => 'nullable',
        'siteOption.meli_merchent' => 'nullable',
        'siteOption.meli_key' => 'nullable',
        'siteOption.ads_link' => 'nullable',
        'siteOption.meli_status' => 'nullable',
        'siteOption.saderat_status' => 'nullable',
        'siteOption.zarrinpall_merchent' => 'nullable',
        'siteOption.zarrinpall_status' => 'nullable',
        'siteOption.register_sms' => 'nullable',
        'siteOption.register_email' => 'nullable',
        'siteOption.order_sms' => 'nullable',
        'siteOption.order_email' => 'nullable',
        'siteOption.order_complate_email' => 'nullable',
        'siteOption.order_complate_sms' => 'nullable',
        'siteOption.register_sms_admin' => 'nullable',
        'siteOption.register_email_admin' => 'nullable',
        'siteOption.order_sms_admin' => 'nullable',
        'siteOption.order_email_admin' => 'nullable',
        'siteOption.comment_sms' => 'nullable',
        'siteOption.comment_email' => 'nullable',
        'siteOption.question_sms' => 'nullable',
        'siteOption.question_email' => 'nullable',
        'siteOption.comment_product_sms' => 'nullable',
        'siteOption.comment_product_email' => 'nullable',
        'siteOption.contact_email' => 'nullable',
        'siteOption.contact_sms' => 'nullable',
        'siteOption.comment_answer_sms' => 'nullable',
        'siteOption.comment_answer_email' => 'nullable',
        'siteOption.question_answer_sms' => 'nullable',
        'siteOption.question_answer_email' => 'nullable',
        'siteOption.license' => 'nullable',
    ];

    public function mount()
    {
        $options = SiteOption::first();

        if ($options) {
            $this->siteOption = $options;
            $license = $this->siteOption->license;
            $server = $_SERVER["SERVER_NAME"];
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, "https://panel.green-code.ir/verifyLicense.php");
            curl_setopt($c, CURLOPT_TIMEOUT, 30);
            curl_setopt($c, CURLOPT_POST, 1);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            $postfields = 'svr=' . $server . '&lic=' . $license;
            curl_setopt($c, CURLOPT_POSTFIELDS, $postfields);
            $this->result = curl_exec($c);
            if ($this->result == "verified") {
                $this->status = 1;

            } else {
                $this->status = 0;
            }
            if (isset($options->logo)) {
                $this->uploadlogo = $options->logo;
            }
            if (isset($options->Signature)) {
                $this->uploadSignature = $options->Signature;
            }
            if (isset($options->icon)) {
                $this->uploadicon = $options->icon;
            }
            if (isset($options->ads_img)) {
                $this->uploadads = $options->ads_img;
            }

        }

    }

    public function CheckLicense()
    {
        if (Gate::allows('edit_option')) {
        $license = $this->siteOption->license;
        $server = $_SERVER["SERVER_NAME"];
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://panel.green-code.ir/verifyLicense.php");
        curl_setopt($c, CURLOPT_TIMEOUT, 30);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $postfields = 'svr=' . $server . '&lic=' . $license;
        curl_setopt($c, CURLOPT_POSTFIELDS, $postfields);
        $this->result = curl_exec($c);
        if ($this->result == "verified") {
            $this->status = 1;

        } else {
            $this->status = 0;
        }
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function saveInfo()
    {

        if (Gate::allows('edit_option')) {

            $this->validate();
            if (isset($this->siteOption)) {
                if (isset($this->logo)) {
                    $this->siteOption->logo = $this->uploadImage($this->logo);
                }
                if (isset($this->icon)) {
                    $this->siteOption->icon = $this->uploadImage($this->icon);
                }
                if (isset($this->Signature)) {
                    $this->siteOption->Signature = $this->uploadImage($this->Signature);
                }
                if (isset($this->ads)) {
                   // dd($this->ads);
                    $this->siteOption->ads_img = $this->uploadImage($this->ads);
                }
                $this->siteOption->update();
                $this->emit('toast', 'success', 'تنظیمات سایت با موفقیت ویرایش شد.');
            } else {
                $this->siteOption = new SiteOption();
                if (isset($this->logo)) {
                    $this->siteOption->logo = $this->uploadImage($this->logo);
                }
                if (isset($this->icon)) {
                    $this->siteOption->icon = $this->uploadImage($this->icon);
                }
                if (isset($this->ads)) {
                    $this->siteOption->ads_img = $this->uploadImage($this->ads);
                }
                if (isset($this->Signature)) {
                    $this->siteOption->Signature = $this->uploadImage($this->Signature);
                }
                $this->siteOption->save();
                $this->emit('toast', 'success', 'تنظیمات سایت با موفقیت ویرایش شد.');
            }

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function uploadImage($img)
    {
        $directory = "photos/option";
        $name = $img->getClientOriginalName();
        $img->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function render()
    {
        $pages = Page::get();
        $countries = Country::get();
        return view('livewire.admin.option.index', compact('pages', 'countries'));
    }
}
