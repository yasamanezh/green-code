<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Blog;
use App\Models\Log;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class Add extends Component
{
    use WithFileUploads;


    public $post;

    public $showcategories=[];

    public $image;
    public $title;

    public function mount(){
        $this->post=new Post();
    }

    public function updated($title)
    {
        $this->validateOnly($title);
    }
    protected $rules = [
        'post.title' => 'required|string|min:2|max:255',
        'post.slug' => 'required|unique:posts,slug',
        'post.description' => 'required|string|min:2',
        'post.meta_keyword' => 'nullable',
        'post.meta_description' => 'nullable|string|min:3',
        'post.meta_title' => 'nullable|string|min:2|max:255',
        'post.status' => 'nullable',
        'image'=>'required|image|max:800|mimes:jpg,bmp,png,jpeg,gif,webp',
        'showcategories' =>'required'

    ];
    public function uploadImage(){

        $directory="photos/posts";
        $thumb=storage_path('app/public/photos/posts/thumbnail_').$this->image->getClientOriginalName();
        $name=$this->image->getClientOriginalName();
        $this->image->storeAs($directory,$name);
        $img=Image::make($this->image->getRealPath())->resize(500, 500)->save();
        Image::make($this->image->getRealPath())->resize(250, 250)->save($thumb);
        $image=["$directory/$name","$directory/thumbnail_$name"];
        return($image);
    }
    public function saveInfo()
    {
        if(Gate::allows('edit_post')){
            $this->validate();
            if($this->image){
                $this->post->image=$this->uploadImage()[0];
                $this->post->thumbnail=$this->uploadImage()[1];
            }
            $this->post->save();
            $this->post->blogs()->attach($this->showcategories);
            $msg = 'پست ذخیره شد ';
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' ایجاد پست  '. $this->post->title,
                'actionType' => 'ایجاد'
            ]);
            return redirect(route('post.blog'))->with('sucsess', $msg);
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }
    public function render()
    {
        $categories=Blog::get();

        return view('livewire.admin.post.add',compact('categories'));
    }
}
