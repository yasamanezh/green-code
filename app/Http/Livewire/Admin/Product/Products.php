<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Products extends Component
{
    use WithPagination;
    public Product $product;
 public $data;
    public $title;
    public $slug;
    public $status;
    public $readyToLoad = false;
    public $search;
    public $mulitiSelect=[];
    public $count_data=10;
    protected $queryString=['search'];
    protected $paginationTheme = 'bootstrap';
    public $productIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $price=[],$quantity;
    public $SelectPage=false;

    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=Product::where('title','LIKE',"%{$this->search}%")
                ->orWhere('slug','LIKE',"%{$this->search}%")
                ->orWhere('id',$this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->mulitiSelect=[];
        }

    }

    public function changePrice($id)
    {
        if(Gate::allows('edit_product')){
            $this->validate([
                "price.$id" => 'required|numeric|min:0'],
                [
                    'quantity.*.required' => 'قیمت محصول اجباری است',
                    'quantity.*.numeric' => 'قیمت محصول باید عدد باشد.',
                    'quantity.*.min:0' => 'حداقل قیمت محصول باید صفر باشد.',
                ]);
            $product=Product::where('id',$id)->first();
            $product->update([
                'price'=>$this->price[$id],
            ]);
            $this->emit('toast', 'success','قیمت محصول مورد نظر با موفقیت تغییر یافت.');

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function changeQuantity($id)
    {
        if(Gate::allows('edit_product')){
            $this->validate([
                "quantity.$id" => 'required|numeric|min:0'],
                [
                'quantity.*.required' => 'تعداد محصول اجباری است',
                'quantity.*.numeric' => 'تعداد محصول باید عدد باشد.',
                'quantity.*.min:0' => 'حداقل تعداد محصول باید صفر باشد.',
                'quantity.*.min:0' => 'حداقل تعداد محصول باید صفر باشد.',
            ]);

            $product=Product::where('id',$id)->first();
            $product->update([
                'quantity'=>$this->quantity[$id],
            ]);
            $this->emit('toast', 'success','تعداد محصول مورد نظر با موفقیت تغییر یافت.');


        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function mount()
    {
        $products=Product::get();
        foreach ($products as $product){
            $this->price[$product->id]=$product->price;
            $this->quantity[$product->id]=$product->quantity;
        }
    }

    public function loadProduct()
    {
        $this->readyToLoad = true;
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

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function confirmProductRemoval($Id)
    {
        $this->productIdBeingRemoved = $Id;

        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllProductRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll(){
        if(Gate::allows('delete_product')){
            foreach ($this->mulitiSelect as $value){
                $product=Product::where('id',$value)->first();
                foreach($product->productImages as $image){
                    $oldImage=storage_path().'/app/public/'.$image->img;
                    if(file_exists($oldImage)){
                        File::delete($oldImage);
                    }
                }
                foreach($product->productDownloads as $download){
                    $olddownload=storage_path().'/app/private/file/'.$download->file;

                    if(file_exists($olddownload)){
                        File::delete($olddownload);
                    }
                }

                $product->delete();
                $oldImage=storage_path().'/app/public/'.$product->image;
                $oldThumb=storage_path().'/app/public/'.$product->thumbnail;

                if(file_exists($oldImage)){
                    File::delete($oldImage);
                }
                 if(file_exists($oldThumb)){
                    File::delete($oldThumb);
                }


            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی محصولات ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage=false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }


    }

    public function statusDisable($id){
        if(Gate::allows('edit_product')){
            $data_info_id=Product::find($id);
            $data_info_id->update([
                'status'=>0
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'غیر فعال کردن ' .$data_info_id->title ,
                'actionType' => 'غیر فعال کردن'
            ]);
            $this->emit('toast','success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function statusEnable($id){
        if(Gate::allows('edit_product')){
            $data_info_id=Product::find($id);
            $data_info_id->update([
                'status'=>1
            ]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' فعال کردن ' .$data_info_id->title ,
                'actionType' => 'فعال کردن'
            ]);
            $this->emit('toast','success', 'تغییر وضعیت با موفقیت انجام شد');
            return back();
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function delete(){
        if(Gate::allows('delete_product')){
            $data_info_id=Product::findOrFail($this->productIdBeingRemoved);
            foreach($data_info_id->productImages as $image){

                $oldImage=storage_path().'/app/public/'.$image->img;
                if(file_exists($oldImage)){
                    File::delete($oldImage);
                }
            }
            foreach($data_info_id->productDownloads as $download){
                $olddownload=storage_path().'/app/private/file/'.$download->file;

                if(file_exists($olddownload)){
                    File::delete($olddownload);
                }
            }
            $data_info_id->delete();
            $oldImage=storage_path().'/app/public/'.$data_info_id->image;
            $oldThumb=storage_path().'/app/public/'.$data_info_id->thumbnail;
            if(file_exists($oldImage)){
                File::delete($oldImage);
            }
            if(file_exists($oldThumb)){
                File::delete($oldThumb);
            }
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن محصول' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);


            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $data_info =$this->readyToLoad ? Product::where('title','LIKE',"%{$this->search}%")
            ->orWhere('slug','LIKE',"%{$this->search}%")
            ->orWhere('id',$this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest()->paginate($this->count_data) :[];
        $deleteItem=$this->mulitiSelect;


        return view('livewire.admin.product.products',compact('data_info','deleteItem'));
    }
}
