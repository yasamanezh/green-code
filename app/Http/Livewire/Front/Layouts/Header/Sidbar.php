<?php

namespace App\Http\Livewire\Front\Layouts\Header;

use App\Models\Category;
use App\Models\Menu;
use App\Models\SiteOption;
use Livewire\Component;

class Sidbar extends Component
{
    public function linkPage($id){
        $slug=explode(',',$id);

        if($slug[0]=='page'){
            $page=\App\FrontModels\Page::where('id',$slug[1])->first();
            if($page){
                $menuRoute=['AllPages',$page->link];
                return $menuRoute;
            }else{
                $HomeRoute=['Home'];
                return $HomeRoute;
            }

            return ('AllPages'.','.$page->link);
        }elseif ($slug[0]=='post'){
            $post=\App\FrontModels\Post::where('id',$slug[1])->first();
            if($post){
                $menuRoute=['FrontPost',$post->slug];
                return $menuRoute;
            }else{
                $HomeRoute=['Home'];
                return $HomeRoute;
            }

        }
        elseif ($slug[0]=='category'){
            $category=\App\FrontModels\Category::where('id',$slug[1])->first();
            if($category){
                $menuRoute=['ProductCategory',$category->slug];
                return $menuRoute;
            }else{
                $HomeRoute=['Home'];
                return $HomeRoute;
            }


        }
        elseif ($slug[0]=='blog'){
            return $menuRoute=[0];;
        }
        elseif ($slug[0]=='blogCategory'){
            $blogs=\App\Models\Blog::where('id',$slug[1])->first();
            if($blogs){
                $menuRoute=['BlogCategory',$blogs->slug];
                return $menuRoute;
            }else{
                $HomeRoute=['Home'];
                return $HomeRoute;
            }


        }



    }
    public function render()
    {
        $options=SiteOption::first();
        $oneLeveles=Category::where('status',1)->where('parent',0)->orWhere('parent',NULL)->get();
        $menus=Menu::orderBy('sort','ASC')->get();
        return view('livewire.front.layouts.header.sidbar',compact('oneLeveles','menus','options'));
    }
}
