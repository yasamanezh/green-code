<?php

namespace App\Http\Controllers;



use Spatie\Sitemap\SitemapGenerator;

class Smpe extends Controller
{
    public function index()
    {
        $path=\Illuminate\Support\Facades\URL::to('/');
        SitemapGenerator::create($path)->writeToFile(public_path('siteMap.xml'));

   }
}
