<?php

namespace App\Http\Livewire\Admin\Notification\Sms;

use App\Models\Email;
use App\Models\Log;
use App\Models\Payamak;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search,$count_data,$mulitiSelect=[];

    protected $queryString = ['search'];
    public $readyToLoad = false;

    public Email $email;
    public $EmailIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect =Payamak::where('id', 'LIKE', "%{$this->search}%")
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item) => (string)$item)->toArray();

        } else {
            $this->mulitiSelect = [];
        }

    }

    public function loadEmail(){
        $this->readyToLoad=true;
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

    public function confirmEmailRemoval($Id)
    {
        $this->EmailIdBeingRemoved = $Id;
        $this->dispatchBrowserEvent('show-delete-modal');

    }

    public function confirmAllEmailRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function expire($data,$time)
    {
        $timeExpire = explode('/', $data);
        $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
        $now = now();
        $expired = verta("$dateExpired[0]-$dateExpired[1]-$dateExpired[2] $time");

        if (date_timestamp_get($expired) < date_timestamp_get($now)) {
            return true;
        } else {

            return false;
        }
    }

    public function deleteAll(){
        if(Gate::allows('delete_notification')){
            foreach ($this->mulitiSelect as $value){
                $discount=Payamak::find($value);

                $discount->delete();
            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی اس ام اس ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage = false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }

    }

    public function delete(){
        if(Gate::allows('delete_notification')){
            $data_info_id=Payamak::findOrFail($this->EmailIdBeingRemoved);
            $data_info_id->delete();

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن اس ام اس' .'-'. $data_info_id->title,
                'actionType' => 'حذف'
            ]);

            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }

    }

    public function mount()
    {

        $this->count_data=10;
    }


    public function render()
    {

        $smses =Payamak::where('id', 'LIKE', "%{$this->search}%")->
        orderBy($this->sortColumnName, $this->sortDirection)->
        latest()->paginate($this->count_data) ;
        $deleteItem=$this->mulitiSelect;

        return view('livewire.admin.notification.sms.index',compact('deleteItem','smses'));
    }
}
