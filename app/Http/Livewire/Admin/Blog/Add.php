<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;


class Add extends Component
{
    public $title, $slug, $status, $parent, $meta_description, $meta_keyword, $meta_title;


    public function saveInfo()
    {
        if (Gate::allows('edit_blog')) {
            $this->validate([
                'slug' => 'required|unique:blogs,slug',
                'title' => 'required|string|min:2',
            ]);
            $category = new Blog();
            $category->title = $this->title;
            $category->slug = $this->slug;
            $category->status = $this->status;
            $category->meta_description = $this->meta_description;
            $category->meta_keyword = $this->meta_keyword;
            $category->meta_title = $this->meta_title;
            if (isset($this->parent)) {
                $category->parent = $this->parent;
            } else {
                $category->parent = 0;
            }
            $category->save();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ',افزودن دسته بندی وبلاگ' . '-' . $category->title,
                'actionType' => 'افزودن'
            ]);

            if ($category) {
                $msg = 'افزودن دسته با موفقیت انجام شد.';
                return redirect(route('Blogs.blog'))->with('sucsess', $msg);
            }
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $categories = Blog::where('parent', 0)->orWhere('parent', NULL)->get();
        return view('livewire.admin.blog.add', compact('categories'));
    }
}
