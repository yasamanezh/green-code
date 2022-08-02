<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public $user;
    public $state = [
        "name" => "",
        "avatar" => "",
        "role" => "",
        "phone" => "",
        "password" => "",
        "password_confirmation" => "",
    ];
    public $name, $phone, $password, $avatar, $photo, $img, $role, $AdminRoles = [];

    public function mount()
    {
        $this->role = 'user';
    }

    public function updateUser()
    {
        if (Gate::allows('edit_user')) {

            $validatedData = Validator::make($this->state, [
                'name' => 'required|string|min:3',
                'phone' => 'required|digits:11|unique:users,phone',
                'password' => 'required|string|min:6|confirmed',
            ])->validate();
            if ($this->role == 'hamkar') {
                $this->validate([
                    'AdminRoles' => 'required'
                ]);
            }
            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['role'] = $this->role;
            if ($this->photo) {
                $validatedData['avatar'] = $this->uploadImage();
            }
            $user = User::create($validatedData);
            if ($this->role === 'hamkar') {
                $user->roles()->attach($this->AdminRoles);
            }
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => ' ایجاد کاربر   ' . $user->name,
                'actionType' => 'ایجاد'
            ]);
            $msg = 'تغییرات با موفقیت ویرایش شد. ';
            return redirect(route('Users'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function uploadImage()
    {
        $directory = "avatars";
        $name = $this->photo->getClientOriginalName();
        $this->photo->storeAs($directory, $name);
        return "$directory/$name";
    }

    public function render()
    {
        $roles = Role::get();
        return view('livewire.admin.users.add', compact('roles'));
    }
}
