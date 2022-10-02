<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public User $user;
    public $state = [];
    public $name,$phone,$password,$avatar,$photo,$img,$role,$AdminRoles=[];
    public function mount(){
        $this->state = $this->user->toArray();
        $this->img=$this->user->avatar;
        $this->role=$this->user->role;
        if($this->user->roles){
            foreach ($this->user->roles as $key=>$value){
                array_push($this->AdminRoles,$value->id);
            }
        }
    }
    public function uploadImage()
    {
        $directory = "avatars";
        $name = $this->photo->getClientOriginalName();
        $this->photo->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function updateUser()
    {
        if(Gate::allows('edit_user')){
            $this->validate([
                'role'=>'required'
            ]);
            $validatedData = Validator::make($this->state, [
                'name' => 'required',
                'phone' => 'required|digits:11|unique:users,phone,'.$this->user->id,
                'password' => 'sometimes|confirmed',
            ])->validate();
            if($this->role == 'hamkar'){
                $this->validate([
                    'AdminRoles'=>'required'
                ]);
            }

            if(!empty($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            if ($this->photo) {
                $validatedData['avatar'] = $this->uploadImage();
            }

            $this->user->update($validatedData);
            $this->user->update([
                'role'=>$this->role,
            ]);
            if($this->role === 'hamkar'){
                $this->user->roles()->sync($this->AdminRoles);
            }
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' ویرایش کاربر   '. $this->user->name,
                'actionType' => 'ایجاد'
            ]);
            $msg = 'تغییرات با موفقیت ویرایش شد. ';
            return redirect(route('Users'))->with('sucsess', $msg);


        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $roles=Role::get();
        return view('livewire.admin.users.edit',compact('roles'));
    }
}
