<?php

namespace App\Http\Livewire\Admin\Menu;

use App\FrontModels\Page;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Log;
use App\Models\Menu;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $title, $link, $sort;

    public function saveInfo()
    {
        if (Gate::allows('edit_option')) {
            $this->validate([
                'link' => 'required|string|min:2|max:255',
                'title' => 'required|string|min:2|max:255',
                'sort' => 'required|numeric|min:1',
            ]);
            $menu = new Menu();
            $menu->title = $this->title;
            $menu->link = $this->link;
            $menu->sort = $this->sort;
            $menu->save();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ',افزودن منو' . '-' . $menu->title,
                'actionType' => 'افزودن'
            ]);

            if ($menu) {
                $msg = 'افزودن منو با موفقیت انجام شد.';
                return redirect(route('Menus'))->with('sucsess', $msg);
            }
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $categories=Category::where('parent',0)->
        orWhere('parent',NULL)->
        get();
        $Pages = Page::get();
        $Posts = Post::where('status', 1)->get();
        $blogs = Blog::where('status', 1)->get();

        return view('livewire.admin.menu.add', compact('categories', 'blogs', 'Pages', 'Posts'));
    }
}
