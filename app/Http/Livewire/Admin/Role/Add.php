<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Log;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component
{
    public $role;
    public $edits = [];
    public $shows = [];
    public $delets = [];

    public $SelectShow=false;
    public $SelectEdit=false;
    public $SelectDelete=false;

    public function UpdatedSelectShow($value)
    {
        if ($value){
            $this->shows=Permission::where('label', 'show')
                ->latest()->get()->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->shows=[];
        }

    }
    public function UpdatedSelectEdit($value)
    {
        if ($value){
            $this->edits=Permission::where('label', 'edit')
                ->latest()->get()->pluck('id')->map(fn($item)=>(string) $item)->toArray();

        }else{
            $this->edits=[];
        }

    }
    public function UpdatedSelectDelete($value)
    {
        if ($value){
            $this->delets=Permission::where('label', 'delete')
                ->latest()->get()->pluck('id')->map(fn($item)=>(string) $item)->toArray();
        }else{
            $this->delets=[];
        }

    }



    public function updated($name)
    {
        $this->validateOnly($name);
    }

    protected $rules = [
        'role.name' => 'required|string|min:2|max:255',
        'role.label' => 'required',
    ];

    public function mount()
    {
        $this->role = new Role();
    }

    public function saveInfo()
    {
        if (Gate::allows('edit_role')) {
            $edits = $this->edits;
            $shows = $this->shows;
            $delets = $this->delets;
            $this->validate();

            $this->role->save();
            $this->role->permissions()->attach($edits);
            $this->role->permissions()->attach($shows);
            $this->role->permissions()->attach($delets);
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ایجاد مقام ' . $this->role->name,
                'actionType' => 'ایجاد'
            ]);
            $msg = 'مقام جدید با موفقیت ذخیره شد. ';
            return redirect(route('Roles'))->with('sucsess', $msg);
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $showPermissions = Permission::where('label', 'show')->get();
        $editPermissions = Permission::where('label', 'edit')->get();
        $deletePermissions = Permission::where('label', 'delete')->get();
        return view('livewire.admin.role.add', compact('showPermissions', 'editPermissions','deletePermissions'));
    }
}
