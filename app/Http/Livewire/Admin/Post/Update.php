<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Blog;
use App\Models\Log;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;


    public Post $post;

    public $showcategories = [];

    public $uploadImage;

    public $title;

    public function mount()
    {
        foreach ($this->post->blogs as $blog)
            array_push($this->showcategories, $blog->id);
    }

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    protected $rules = [
        'post.title' => 'required|string|min:2|max:255',
        'post.slug' => 'required',
        'post.description' => 'required|string|min:2',
        'post.meta_keyword' => 'nullable',
        'post.status' => 'nullable',
        'post.meta_description' => 'nullable',
        'post.meta_title' => 'nullable|string|min:2|max:255',
        'showcategories' => 'required',
    ];

    public function uploadImage()
    {

        $directory = "photos/posts";
        $thumb = storage_path('app/public/photos/posts/thumbnail_') . $this->uploadImage->getClientOriginalName();
        $oldThumb = storage_path() . '/app/public/' . $this->post->thumbnail;
        $oldImage = storage_path() . '/app/public/' . $this->post->image;
        $name = $this->uploadImage->getClientOriginalName();
        if ( file_exists($oldThumb)) {
            File::delete($oldThumb);
        }
        if (file_exists($oldImage)) {
            File::delete($oldImage);
        }
        $this->uploadImage->storeAs($directory, $name);
        $img = Image::make($this->uploadImage->getRealPath())->resize(500, 500)->save();
        Image::make($this->uploadImage->getRealPath())->resize(250, 250)->save($thumb);
        $image = ["$directory/$name", "$directory/thumbnail_$name"];
        return ($image);
    }

    public function saveInfo()
    {
        $this->validate([
            'post.slug' => ['required', Rule::unique('posts','slug')->ignore($this->post->id)],
        ]);

        if (Gate::allows('edit_post')) {
            $this->validate();
            if ($this->uploadImage) {
                $this->validate([
                    'uploadImage'=>'image|max:800|mimes:jpg,bmp,png,jpeg,gif,webp'
                ]);
                $this->post->image = $this->uploadImage()[0];
                $this->post->thumbnail = $this->uploadImage()[1];
            }
            $this->post->save();
            $this->post->blogs()->sync($this->showcategories);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' ویرایش پست  ' . $this->post->title,
                'actionType' => 'ویرایش'
            ]);
            $msg = 'پست ذخیره شد ';
            return redirect(route('post.blog'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $categories = Blog::get();

        return view('livewire.admin.post.update', compact('categories'));
    }
}
