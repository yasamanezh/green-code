<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Blog;
use App\Models\Log;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;


class Index extends Component
{
    public $search;
    public $count_data = 10;
    protected $queryString = ['search'];
    protected $paginationTheme = 'bootstrap';

    public Post $post;

    public $mulitiSelect = [];
    public $IdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $readyToLoad = false;
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=  Post::where('title', 'LIKE', "%{$this->search}%")
                ->orWhere('slug', 'LIKE', "%{$this->search}%")
                ->orWhere('id',$this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->mulitiSelect=[];
        }

    }




    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function loadPost()
    {
        $this->readyToLoad = true;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function confirmyRemoval($Id)
    {
        $this->IdBeingRemoved = $Id;
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll()
    {
        if (Gate::allows('delete_post')) {
            foreach ($this->mulitiSelect as $value) {
                $post = Post::where('id', $value)->first();
                $oldImage = storage_path() . '/app/public/' . $post->image;
                $oldThumb = storage_path() . '/app/public/' . $post->thumbnail;
                if ( file_exists($oldThumb)) {
                    File::delete($oldThumb);
                }
                if (file_exists($oldImage)) {
                    File::delete($oldImage);
                }

                $post->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی پست ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage=false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }


    }

    public function delete()
    {
        if (Gate::allows('delete_post')) {
            $data_info_id = Post::findOrFail($this->IdBeingRemoved);
            $oldImage = storage_path() . '/app/public/' . $data_info_id->image;
            $oldThumb = storage_path() . '/app/public/' . $data_info_id->thumbnail;

            if ( file_exists($oldThumb)) {
                File::delete($oldThumb);
            }
            if (file_exists($oldImage)) {
                File::delete($oldImage);
            }
            $data_info_id->delete();

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

    public function statusDisable($id)
    {
        if (Gate::allows('edit_post')) {
            $data_info_id = Post::find($id);
            $data_info_id->update([
                'status' => 0
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'غیر فعال کردن پست  ' . $data_info_id->title,
                'actionType' => 'غیر فعال کردن'
            ]);
            $this->emit('toast', 'success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function statusEnable($id)
    {
        if (Gate::allows('edit_post')) {
            $data_info_id = Post::find($id);
            $data_info_id->update([
                'status' => 1
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' فعال کردن پست  ' . $data_info_id->title,
                'actionType' => 'فعال کردن'
            ]);
            $this->emit('toast', 'success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {


        $data_info = $this->readyToLoad ? Post::where('title', 'LIKE', "%{$this->search}%")
            ->orWhere('slug', 'LIKE', "%{$this->search}%")
            ->orWhere('id', $this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) : [];
        $category = Blog::where('status', '1')->get();
        $deleteItem = $this->mulitiSelect;

        return view('livewire.admin.post.index', compact('data_info', 'deleteItem'));
    }
}
