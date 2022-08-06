<?php

namespace App\Http\Livewire\Front\Home;


use App\Models\Colum;
use App\Models\Module;
use App\Models\Page;
use App\Models\RowModule;
use App\Models\SiteOption;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;


class Index extends Component
{
    public $style = [];
    public $sectionclass = [];
    public $options,$homePage;
    public $limitPerPage = 1;
    public $jssections;
    public $readyToLoad=false;

    public function loadHome(){
        $this->readyToLoad=true;
    }

    public function mount()
    {
        $this->options=SiteOption::first();
        $keys=explode(',',$this->options->meta_keyword);
        $url=Request::url();
        $link=URL::to('/');
        $img=$link.'/storage/'. $this->options->logo;
        $title= $this->options->meta_title;
        SEOTools::setTitle($title);
        SEOTools::setDescription($this->options->meta_description);
        SEOTools::opengraph()->setUrl($url);
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage($img);
        SEOMeta::addKeyword($keys);

        $siteHome=$this->options->home;
        if($siteHome){
            $page=Page::where('id',$siteHome)->first();
            if($page){
                $home=$page->title;
            }else{
                $home='home';
            }
        }else{
            $home='home';
        }
      $this->homePage=$home;

        $this->jssections = RowModule::where('page',$home)->get();

        $sections = RowModule::where('page',$home)->get();

        if($sections){
        foreach ($sections as $section) {
            $cols=Colum::where('page',$home)->where('row',$section->sort)->get();
            if($cols){
                foreach ($cols as $col){
                    $modules=Module::where('page',$home)->where('row',$section->sort)->where('col',$col->sort)->get();
                     foreach ($modules as $module){
                         $marginModule = explode(',', $module->margin);
                         $paddingModule = explode(',', $module->padding);
                         $moduleStyle='#homeSection'.$section->sort.$col->sort.$module->sort.'{';
                         if ($marginModule[0] != 'no') {

                             $margintopModule = 'margin-top:'.$marginModule[0].'px;';
                             $moduleStyle=$moduleStyle . $margintopModule;
                         }
                         if ($marginModule[1] != 'no') {
                             $marginrightModule = 'margin-right:'.$marginModule[1].'px;';
                             $moduleStyle=$moduleStyle . $marginrightModule;
                         }
                         if ($marginModule[2]!= 'no') {
                             $marginbottomModule = 'margin-bottom:'.$marginModule[2].'px;';
                             $moduleStyle=$moduleStyle . $marginbottomModule;
                         }
                         if ($marginModule[3] != 'no') {
                             $marginleftModule = 'margin-left:'.$marginModule[3].'px;';
                             $moduleStyle=$moduleStyle . $marginleftModule;
                         }

                         if ($paddingModule[0] != 'no') {
                             $paddingtopModule = 'padding-top:'.$paddingModule[0].'px;';
                             $moduleStyle=$moduleStyle . $paddingtopModule;
                         }
                         if ($paddingModule[1] != 'no') {
                             $paddingrightModule = 'padding-right:'.$paddingModule[1].'px;';
                             $moduleStyle=$moduleStyle . $paddingrightModule;
                         }
                         if ($paddingModule[2]!= 'no') {
                             $paddingbottomModule = 'padding-bottom:'.$paddingModule[2].'px;';
                             $moduleStyle=$moduleStyle . $paddingbottomModule;
                         }
                         if ($paddingModule[3] != 'no') {
                             $paddingleftModule = 'padding-left:'.$paddingModule[3].'px;';
                             $moduleStyle=$moduleStyle . $paddingleftModule;
                         }


                         $moduleStyle=$moduleStyle.'}';
                         array_push($this->sectionclass,$moduleStyle);
                     }

                }

            }
            $sectionId='#section'.$section->sort.'{';
            $margin = explode(',', $section->margin);
            $padding = explode(',', $section->padding);

            if ($margin[0] != 'no') {

                $margintop = 'margin-top:'.$margin[0].'px;';
                $sectionId=$sectionId . $margintop;
            }
            if ($margin[1] != 'no') {
                $marginright = 'margin-right:'.$margin[1].'px;';
                $sectionId=$sectionId . $marginright;
            }
            if ($margin[2]!= 'no') {
                $marginbottom = 'margin-bottom:'.$margin[2].'px;';
                $sectionId=$sectionId . $marginbottom;
            }
            if ($margin[3] != 'no') {
                $marginleft = 'margin-left:'.$margin[3].'px;';
                $sectionId=$sectionId . $marginleft;
            }

             if ($padding[0] != 'no') {
                $paddingtop = 'padding-top:'.$padding[0].'px;';
                $sectionId=$sectionId . $paddingtop;
            }
            if ($padding[1] != 'no') {
                $paddingright = 'padding-right:'.$padding[1].'px;';
                $sectionId=$sectionId . $paddingright;
            }
            if ($padding[2]!= 'no') {
                $paddingbottom = 'padding-bottom:'.$padding[2].'px;';
                $sectionId=$sectionId . $paddingbottom;
            }
            if ($padding[3] != 'no') {
                $paddingleft = 'padding-left:'.$padding[3].'px;';
                $sectionId=$sectionId . $paddingleft;
            }


          if($section->bg_color_status ==1){
              if ($section->bg_color) {
                  $bgColor = 'background-color:'.$section->bg_color.';';
                  $sectionId=$sectionId . $bgColor;
              }
          }
            if ($section->height) {
                $sectionHight = 'height:'.$section->height.'px;';
                $sectionId=$sectionId . $sectionHight;
            }


            $end='}';
            $sectionId=$sectionId . $end;
            array_push($this->sectionclass,$sectionId);
        }
        }
    }

    public function render()
    {
        $options=SiteOption::first();
        $sections=RowModule::where('page',$this->homePage)->get();
        return view('livewire.front.home.index',compact('sections','options'))->layout('layouts.front');
    }
}
