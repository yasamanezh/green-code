<?php

namespace App\Http\Livewire\Admin\Users;

use App\Exports\UsersExport;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $search;

    public $count_data=10;
    protected $queryString=['search'];
    public $user;

    public $showEditModal = false;

    public $userIdBeingRemoved = null;

    public $searchTerm = null;


    public $photo;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';
    public $mulitiSelect=[];
    public $IdBeingRemoved = null;
    public $readyToLoad = false;
    public $SelectPage=false;
    public function UpdatedSelectPage($value)
    {
        if ($value){
            $this->mulitiSelect=User::where('name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('phone', 'like', '%'.$this->searchTerm.'%')
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

    public function loadUser()
    {
        $this->readyToLoad = true;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function confirmAllRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll(){
        if(Gate::allows('delete_user')){
            foreach ($this->mulitiSelect as $value){
                $user=User::find($value);
                $user->delete();
            }
            $this->mulitiSelect=[];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی کاربر ',
                'actionType' => 'حذف'
            ]);
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success','رکورد مورد نظر با موفقیت حذف شد');
        }else{
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }


    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved = $userId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        if(Gate::allows('delete_user')){
            $user = User::findOrFail($this->userIdBeingRemoved);

            $user->delete();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کاربر' .'-'. $user->name,
                'actionType' => 'ویرایش'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast','success', 'کاربر با موفقیت حذف شد!');
        }else{
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning','شما اجازه حذف این قسمت را ندارید.');
        }

    }

    public function changeRole(User $user, $role)
    {
        if(Gate::allows('edit_user')){
            Validator::make(['role' => $role], [
                'role' => [
                    'required',
                    Rule::in(User::ROLE_ADMIN, User::ROLE_USER,User::ROLE_HAMKAR),
                ],
            ])->validate();
            $user->update(['role' => $role]);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' تغییر نقش کاربر  '. $user->name,
                'actionType' => 'ویرایش'
            ]);
            $this->emit('toast','success', 'تغییر نقش کاربر با موفقیت انجام شد');
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function export()
    {
        if(Gate::allows('edit_user')){
            return (new UsersExport())->download('users.xlsx');
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('phone', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->count_data);
        $deleteItem=$this->mulitiSelect;

        return view('livewire.admin.users.index',compact('users','deleteItem'));
    }
}
