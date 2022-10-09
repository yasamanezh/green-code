<?php


namespace App\Http\Livewire\Front\License;

use App\Models\Licence;
use Illuminate\Http\Request;
use Livewire\Component;
use Validator;

class Index extends Component
{
    public function index(Request $request)
    {
        $data = Validator::make($request->all(),[
            'svr' => 'required|min:3|string|max:190',
            'lic' => 'required|min:3|max:190|string'
        ]);

        if ($data->fails()){
            return response([
                'result' =>'<p>&nbsp;</p>

<p>&nbsp;</p>

<p dir="rtl" style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">متاسفانه مجوز ( لایسنس ) نرم افزار شما معتبر نیست ! جهت فعال سازی لایسنس به فایل راهنما مراجعه فرمایید.</span></span></p>

<hr />
<p dir="ltr" style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">Your Licence is Invalid ! To activate the license, please refer to the help file</span></span></p>

<p dir="ltr" style="text-align:center">&nbsp;</p>

<p dir="ltr" style="text-align:center">&nbsp;</p>
'
            ]);

        }
        $ch = $request->all();
        $url = Licence::where('url', $ch['svr'])->where('status',1)->first();
        if ($url){
            if ($url->licence == $ch['lic']){
                return response([
                    'result' => 'verified'
                ]);
            }
            return response([
                'result' =>'<p>&nbsp;</p>

<p>&nbsp;</p>

<p dir="rtl" style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">متاسفانه مجوز ( لایسنس ) نرم افزار شما معتبر نیست ! جهت فعال سازی لایسنس به فایل راهنما مراجعه فرمایید.</span></span></p>

<hr />
<p dir="ltr" style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">Your Licence is Invalid ! To activate the license, please refer to the help file</span></span></p>

<p dir="ltr" style="text-align:center">&nbsp;</p>

<p dir="ltr" style="text-align:center">&nbsp;</p>
'
            ]);
        }
        return response([
            'result' =>'<p dir="rtl" style="text-align:center">&nbsp;</p>

<p dir="rtl" style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">شما مجوز استفاده از این لایسنس بر روی این دامنه را ندارید.</span></span></p>

<hr />
<p dir="ltr" style="text-align:center"><span style="font-size:14px"><span style="font-family:tahoma,geneva,sans-serif">You do not have permission to use this license on this domain</span></span></p>

<p dir="ltr" style="text-align:center">&nbsp;</p>
']);
    }

    public function render()
    {
        return view('livewire.front.license.index')->layout('layouts.front');
    }
}
