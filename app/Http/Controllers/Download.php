<?php

namespace App\Http\Controllers;

use App\FrontModels\ProductDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Download extends Controller
{
    public function index($file)
    {
        $productDownload=ProductDownload::find($file);
        $hash = env('FILE_HASH_DOWNLOAD') . $productDownload->file . request('t') . request()->ip();
        if(request('t') > now()->timestamp && Hash::check($hash , request('mac'))) {
            $path = 'file/'.$productDownload->file ;
            return Storage::disk('private')->download($path);
        } else {
            return "لینک منقضی شده است، لطفا مجددا بر روی دکمه دانلود کلیک کنید.";
        }

    }
}
