<?php

namespace App\Http\Livewire\admin\Category;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Log;
use App\Models\Category;

use Livewire\WithPagination;

class Categories extends Component
{

    use WithPagination;
	public $category;
	public $data;
    public $readyToLoad = false;
	public $search;
	public $mulitiSelect=[];
    public $count_data=10;
    protected $queryString=['search'];
    protected $paginationTheme = 'bootstrap';
    public $level;
    public $level1;
    public $photo,$categoryLevel;

    public $categoryIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=Category::where('title','LIKE',"%{$this->search}%")
                ->orWhere('slug','LIKE',"%{$this->search}%")
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

    public function loadCategory()
    {
        $this->readyToLoad = true;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;
        $categories=Category::get();
        foreach ($categories as $category){
            if($category->parent == $this->categoryIdBeingRemoved){
                $this->level1=1;
            }
        }
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllCategoryRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function delete(){


        if(Gate::allows('delete_category')){
            $data_info_id=Category::findOrFail($this->categoryIdBeingRemoved);
            $categories=Category::get();
            foreach ($categories as $category){
                if($category->parent == $this->categoryIdBeingRemoved){
                    $category->update([
                        'parent'=>null,
                    ]);
                }
            }
            $oldImage=storage_path().'/app/public/'.$data_info_id->img;
            if(file_exists($oldImage)){
                File::delete($oldImage);
            }

            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن دسته' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

	public function deleteAll(){
        if(Gate::allows('delete_category')){
            foreach ($this->mulitiSelect as $value){
                $category=Category::where('id',$value)->first();
                $oldImage=storage_path().'/app/public/'.$category->img;
                if(file_exists($oldImage)){
                    File::delete($oldImage);
                }

                $categories=Category::get();
                foreach ($categories as $cat){
                    if($cat->parent ==$category->id){
                        $cat->update([
                            'parent'=>null,
                        ]);
                    }
                }
                $category->delete();
            }
            $this->mulitiSelect=[];
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی دسته ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage=false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
	}


    public function statusDisable($id){
        if(Gate::allows('edit_category')){
            $data_info_id=Category::find($id);
            $data_info_id->update([
                'status'=>0
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'غیر فعال کردن دسته' .'-'. $data_info_id->title,
                'actionType' => 'غیر فعال کردن'
            ]);
            $this->emit('toast','success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function statusEnable($id){

          if(Gate::allows('edit_category')){

              $data_info_id=Category::find($id);
              $data_info_id->update([
                  'status'=>1
              ]);
              Log::create([
                  'user_id' => auth()->user()->id,
                  'url' => ' فعال کردن دسته' .'-'. $data_info_id->title,
                  'actionType' => ' فعال کردن'
              ]);
              $this->emit('toast','success', 'تغییر وضعیت با موفقیت انجام شد');
              return back();
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }



    }
	public function mount(){

		$this->data['breadcrumbs_text'] = 'دسته بندی ها';
		$this->data['breadcrumbs_href'] = route('categories');
		$this->data['heading_title'] = ' دسته بندی ها';

	}

   public function render()
    {


		$data_info = $this->readyToLoad ? Category::where('title','LIKE',"%{$this->search}%")
            ->orWhere('slug','LIKE',"%{$this->search}%")
            ->orWhere('id',$this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) :[];
        $categories=Category::get();
        $categoriesId=Category::pluck('id')->all();
        $deleteItem=$this->mulitiSelect;


        return view('livewire.admin.category.category',compact('data_info','categoriesId','categories','deleteItem'));
    }
}
