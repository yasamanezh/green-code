<?php

namespace App\Http\Livewire\admin\category;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;


class EditCategory extends Component
{
    use WithFileUploads;
    public Category $category;
    public $data;
    public $title;
    public $slug;
    public $status;
    public $img1;
    public $level;
    public $parent;
    public $UpdatedPhoto,$meta_description,$meta_keyword,$meta_title;
    public function mount(){
        $this->title=$this->category->title;
        $this->slug=$this->category->slug;
        $this->meta_description=$this->category->meta_description;
        $this->meta_keyword=$this->category->meta_keyword;
        $this->meta_title=$this->category->meta_title;
        $this->status=$this->category->status;
        $this->img=$this->category->img;
        $this->parent=$this->category->parent;
    }

    public function uploadImage(){

        $directory="photos/category";
        $thumb=storage_path('app/public/photos/category/').$this->UpdatedPhoto->getClientOriginalName();
        $name=$this->UpdatedPhoto->getClientOriginalName();
        $oldImage=storage_path().'/app/public/'.$this->category->image;
        $this->UpdatedPhoto->storeAs($directory,$name);
        if(file_exists($oldImage)){
            File::delete($oldImage);
        }
        Image::make($this->UpdatedPhoto->getRealPath())->resize(100,100)->save($thumb);
        $image=["$directory/$name","$directory/$name"];
        return($image);
    }



    public function saveInfo(){
        if(Gate::allows('edit_category')){
            $this->validate([
                'slug' => ['required','string','min:2','max:255', Rule::unique('categories')->ignore($this->category->id)],
                'title' => 'required|string|min:2|max:255',
                'img'=>'nullable',
            ]);

            $this->category->title = $this->title;
            $this->category->slug = $this->slug;
            $this->category->meta_title = $this->meta_title;
            $this->category->meta_keyword = $this->meta_keyword;
            $this->category->meta_description = $this->meta_description;
            if(isset($this->status)){
                $this->category->status = $this->status;
            }
            if($this->UpdatedPhoto){
                $this->validate([
                    'UpdatedPhoto'=>'required|file|max:800|mimes:jpg,bmp,png,jpeg,gif,webp'
                ]);
                $this->category->img=$this->uploadImage()[1];
            }
            if(isset($this->parent)){
                $this->category->parent = $this->parent;
            }else{
                $this->category->parent=0;
            }
            $this->category->update();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ',ویرایش دسته' .'-'. $this->category->title,
                'actionType' => 'ویرایش'
            ]);

            if($this->category){
                $msg = 'ویرایش دسته با موفقیت انجام شد.';
                return redirect(route('categories'))->with('sucsess', $msg);
            }
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }
    public function render()
    {
        if(isset($this->img)){
            $is_image=true;
        }else{
            $is_image=false;
        }

        $categories=Category::where('parent',0)->
        orWhere('parent',NULL)->
        get();
        return view('livewire.admin.category.edit-category',compact('categories'));
    }
}
