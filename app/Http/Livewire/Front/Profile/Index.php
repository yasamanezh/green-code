<?php

namespace App\Http\Livewire\Front\Profile;

use App\Models\SiteOption;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;

class Index extends Component
{
    public $user;
    public $state = [];

    public function mount()
    {
        SEOMeta::setTitle('حساب کاربری');
        $this->user = auth()->user();

    }

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    protected $rules = [
        'user.name' => 'required|min:3',
        'user.phone' => 'required',
        'user.email' => 'required|email',
    ];

    public function updateUser()
    {
        $this->validate();
        if (auth()->user()->role != 'hamkar'){
            $this->user->update();
            $this->emit('toast', 'success', 'اطلاعات حساب کاربری شما با موفقیت ویرایش شد.');
            $this->dispatchBrowserEvent('hide-form');
        }elseif (Gate::allows('edit_user')){
            $this->user->update();
            $this->emit('toast', 'success', 'اطلاعات حساب کاربری شما با موفقیت ویرایش شد.');
            $this->dispatchBrowserEvent('hide-form');
        }else{
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }
    public function shoeEdit(){
        $this->dispatchBrowserEvent('show-form');
    }

    public function changePassword(UpdatesUserPasswords $updater)
    {
        if (auth()->user()->role != 'hamkar'){
        $updater->update(
            auth()->user(),
            $attributes = Arr::only($this->state, ['current_password', 'password', 'password_confirmation'])
        );
        collect($attributes)->map(fn($value, $key) => $this->state[$key] = '');
        $this->emit('toast', 'success', 'پسورد با موفقیت ذخیره شد.');
        }elseif (Gate::allows('edit_user')){
            $updater->update(
                auth()->user(),
                $attributes = Arr::only($this->state, ['current_password', 'password', 'password_confirmation'])
            );
            collect($attributes)->map(fn($value, $key) => $this->state[$key] = '');
            $this->emit('toast', 'success', 'پسورد با موفقیت ذخیره شد.');
        }else{
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function render()
    {
        $options = SiteOption::first();

        return view('livewire.front.profile.index', compact('options'))->layout('layouts.front');
    }
}
