<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\Log;
use App\Models\SiteOption;
use Illuminate\Support\Facades\Gate;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $status;
    public $img;
    public $parent, $meta_description, $meta_keyword, $meta_title;
    public $result = null;



    public function saveInfo()
    {

        if (Gate::allows('edit_category')) {

            $this->validate([
                'slug' => 'required|string|min:2|max:255|unique:categories',
                'title' => 'required|string|min:2|max:255',
                'img' => 'required|file|max:800|mimes:jpg,bmp,png,jpeg,gif,webp',
            ]);
            $category = new Category();
            $category->title = $this->title;
            $category->slug = $this->slug;
            $category->meta_description = $this->meta_description;
            $category->meta_keyword = $this->meta_keyword;
            $category->meta_title = $this->meta_title;
            $category->status = $this->status;
            if ($this->img) {
                $category->img = $this->uploadImage()[1];
            }
            if (isset($this->parent)) {
                $category->parent = $this->parent;
            } else {
                $category->parent = 0;
            }
            $category->save();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ',افزودن دسته' . '-' . $category->title,
                'actionType' => 'افزودن'
            ]);
            if ($category) {
                $msg = 'افزودن دسته با موفقیت انجام شد.';
                return redirect(route('categories'))->with('sucsess', $msg);
            }
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function uploadImage()
    {
        $directory = "photos/category";
        $name = $this->img->getClientOriginalName();
        $this->img->storeAs($directory, $name);
        $thumb = storage_path('app/public/photos/category/') . $this->img->getClientOriginalName();
        $this->img->storeAs($directory, $name);
        Image::make($this->img->getRealPath())->resize(100, 100)->save($thumb);
        $image = ["$directory/$name", "$directory/$name"];
        return ($image);
    }

    public function render()
    {
        $categories = Category::where('parent', 0)->
        orWhere('parent', NULL)->
        get();
        return view('livewire.admin.category.add', compact('categories'));
    }
}
