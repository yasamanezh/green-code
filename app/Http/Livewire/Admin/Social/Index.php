<?php

namespace App\Http\Livewire\Admin\Social;

use App\Models\Log;
use App\Models\Social;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;


class Index extends Component
{

    public $social, $telegram, $whatsapp, $twitter, $linkdin, $instagram, $email;

    public function mount()
    {
        $this->social = Social::first();
        if ($this->social) {
            $this->telegram = $this->social->telegram;
            $this->whatsapp = $this->social->whatsapp;
            $this->twitter = $this->social->twitter;
            $this->linkdin = $this->social->linkdin;
            $this->instagram = $this->social->instagram;
            $this->email = $this->social->email;
        }

    }


    public function categoryForm()
    {
        if (Gate::allows('edit_option')) {

            $socials = Social::first();
            if ($socials) {
                $this->social->update([
                    'telegram' => $this->telegram,
                    'whatsapp' => $this->whatsapp,
                    'twitter' => $this->twitter,
                    'linkdin' => $this->linkdin,
                    'instagram' => $this->instagram,
                    'email' => $this->email,
                ]);
            } else {
                $this->social = new Social();
                $this->social->telegram = $this->telegram;
                $this->social->whatsapp = $this->whatsapp;
                $this->social->twitter = $this->twitter;
                $this->social->linkdin = $this->linkdin;
                $this->social->instagram = $this->instagram;
                $this->social->email = $this->email;
                $this->social->save();
            }

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ویرایش شبکه اجتماعی',
                'actionType' => 'ویرایش'
            ]);
            $this->emit('toast', 'success', ' شبکه اجتماعی با موفقیت ویرایش شد.');

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }


    public function render()
    {

        $this->social = Social::first();
        return view('livewire.admin.social.index');
    }
}
