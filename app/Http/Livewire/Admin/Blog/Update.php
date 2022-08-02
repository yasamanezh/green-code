<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use Illuminate\Support\Facades\Gate;
use App\Models\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;


class Update extends Component
{
    public $title, $slug, $status, $parent, $meta_description, $meta_keyword, $meta_title;
    public Blog $blog;

    public function mount()
    {
        $this->title = $this->blog->title;
        $this->slug = $this->blog->slug;
        $this->status = $this->blog->status;
        $this->slug = $this->blog->slug;
        $this->parent = $this->blog->parent;
        $this->meta_description = $this->blog->meta_description;
        $this->meta_keyword = $this->blog->meta_keyword;
        $this->meta_title = $this->blog->meta_title;
    }


    public function saveInfo()
    {
        if (Gate::allows('edit_blog')) {
            $this->validate([
                'slug' => ['required', Rule::unique('blogs')->ignore($this->blog->id)],
                'title' => 'required|string|min:2',
            ]);
            $category = $this->blog;
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
            $category->update();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ',ویرایش دسته بندی وبلاگ' . '-' . $category->title,
                'actionType' => 'ویرایش'
            ]);

            if ($category) {
                $msg = 'ویرایش دسته با موفقیت انجام شد.';
                return redirect(route('Blogs.blog'))->with('sucsess', $msg);
            }
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $categories = Blog::where('parent', 0)->orWhere('parent', NULL)->get();
        return view('livewire.admin.blog.update', compact('categories'));
    }
}
