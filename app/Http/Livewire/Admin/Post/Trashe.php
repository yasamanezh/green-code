<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Category;
use App\Models\Log;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

use Livewire\WithPagination;

class Trashe extends Component
{

    use WithPagination;

    public Post $post;
    public $search;
    public $count_data = 10;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';
    public $categoryIdBeingRemoved = null;


    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function delete()
    {


        if (Gate::allows('delete_post')) {
            $data_info_id = Post::withTrashed()->findOrFail($this->categoryIdBeingRemoved);
            $oldImage = storage_path() . '/app/public/' . $data_info_id->image;
            $oldThumb = storage_path() . '/app/public/' . $data_info_id->thumbnail;

            if ($oldImage) {
                File::delete($oldImage);
            }

            if ($oldThumb) {
                File::delete($oldThumb);
            }

            $data_info_id->forceDelete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن پست' . '-' . $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }
    }

    public function trashedCategory($id)
    {
        if (Gate::allows('edit_post')) {
            $post = Post::withTrashed()->where('id', $id)->first();
            $post->restore();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'بازیابی پست' . '-' . $post->title,
                'actionType' => 'بازیابی'
            ]);
            $this->emit('toast', 'success', 'پست با موفقیت بازیابی شد');
        } else {

            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }


    public function render()
    {


        $data_info = DB::table('posts')
            ->whereNotNull('deleted_at')
            ->where('title', 'LIKE', "%{$this->search}%")
            ->latest()->paginate($this->count_data);

        return view('livewire.admin.post.trashe', compact('data_info'));
    }
}
