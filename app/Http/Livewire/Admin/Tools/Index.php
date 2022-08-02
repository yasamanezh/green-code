<?php

namespace App\Http\Livewire\Admin\Tools;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Index extends Component
{
    public $key;

    public function secret()
    {

        if(Gate::allows('edit_tools')){
            $this->validate([
                'key' => 'required|string|min:4',
            ]);

            Artisan::call('down', ['--secret' => $this->key]);
            $this->emit('toast', 'success', ' حالت تعمیرات با کلید با موفقیت انجام شد.');

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function down()
    {
        if(Gate::allows('edit_tools')){
            Artisan::call('down');
            $this->emit('toast', 'success', ' حالت تعمیرات عمومی با موفقیت انجام شد.');

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
      }

    public function up()
    {
        if(Gate::allows('edit_tools')){
            Artisan::call('up');
            $this->emit('toast', 'success', ' خروج حالت تعمیرات با موفقیت انجام شد.');

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function cache()
    {
        if(Gate::allows('edit_tools')){
            Artisan::call('cache:clear');
            $this->emit('toast', 'success', ' خالی کردن کش با موفقیت انجام شد.');

        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }
       }

    public function render()
    {
        return view('livewire.admin.tools.index');
    }
}
