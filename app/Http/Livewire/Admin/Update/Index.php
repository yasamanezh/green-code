<?php

namespace App\Http\Livewire\Admin\Update;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use ZanySoft\Zip\Zip;
use Illuminate\Support\Facades\DB;
use Artisan;

class Index extends Component
{
    use WithFileUploads;

    public $file;
    public $step;
    public $alert = null;
    public $done = null;
    public $maintenance = false;

    public function mount()
    {
        if (Gate::allows('edit_update')) {
            $this->step = 1;
            $dir = 'app/private/updates';
            if (is_dir(storage_path($dir))) {
                /* rmdir($dir);*/
                File::deleteDirectory(storage_path($dir));
                /*mkdir($dir, 0777, true);*/
            }
            if (!file_exists(storage_path() . '/framework/maintenance.php')) {
                $this->maintenance = true;
            }
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function sub1()
    {
        if (Gate::allows('edit_update')) {
            $this->validate([
                'file' => 'required|file|mimes:zip|max:2048',
            ]);
            // Delete update directory.
            $dir = 'app/private/updates';
            if (is_dir(storage_path($dir))) {
                /* rmdir($dir);*/
                File::deleteDirectory(storage_path($dir));
                /*mkdir($dir, 0777, true);*/
            }

            /*  File::makeDirectory($dir);*/
            $filename = Storage::disk('private')->put('updates', $this->file);
            $is_valid = Zip::check(storage_path('app/private/' . $filename));
            if ($is_valid) {
                $zip = Zip::open(storage_path('app/private/' . $filename));
                $zip->extract(storage_path() . '/app/private/updates/files/');
                $zip->close();
                if (File::exists(storage_path() . '/app/private/updates/files/alert.txt')) {
                    $this->alert = File::get(storage_path() . '/app/private/updates/files/alert.txt');
                    $this->step = 2;
                } else {
                    dd('File is Not Exists');
                }
            }

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function sub2()
    {
        if (Gate::allows('edit_update')) {
            if (File::exists(storage_path() . '/app/private/updates/files/install.txt') && File::exists(storage_path() . '/app/private/updates/files/done.txt')) {
                $install = File::get(storage_path() . '/app/private/updates/files/install.txt');
                $this->done = File::get(storage_path() . '/app/private/updates/files/done.txt');
                eval($install);
                Artisan::call('view:clear');
                Artisan::call('cache:clear');
                $this->step = 3;
            } else {
                dd('File is Not Exists');
            }
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        return view('livewire.admin.update.index');
    }
}
