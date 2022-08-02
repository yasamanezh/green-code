<?php

namespace App\Http\Livewire\Front\Profile;

use App\Models\Country;
use App\Models\Option;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use App\Models\Address as AddressModels;
use PhpParser\Builder\Function_;

class Address extends Component
{
    public $address,$state,$city,$code_posti,$name,$lname,$mobile;
    public $addressCreate,$stateCreate,$cityCreate,$code_postiCreate,$nameCreate,$mobileCreate;
    public $editAddress, $AddresID,$deleteId;

    public $showEditModal = false;

    public function createAddress()
    {
        $this->validate([
            'nameCreate' => 'required|string|min:2',
            'mobileCreate' => 'required|digits:11',
            'code_postiCreate' => 'required|digits:10',
            'stateCreate' => 'required',
            'cityCreate' => 'required',
            'addressCreate' => 'required',
        ]);
        $addres = new \App\Models\Address();


        $addres->user_id = auth()->user()->id;
        $addres->name = $this->nameCreate;
        $addres->mobile = $this->mobileCreate;
        $addres->code_posti = $this->code_postiCreate;
        $addres->state = $this->stateCreate;
        $addres->city = $this->cityCreate;
        $addres->address = $this->addressCreate;
        $addres->save();
        $this->reset(
            ['addressCreate','stateCreate','cityCreate','nameCreate','mobileCreate','code_postiCreate']
        );
        $this->dispatchBrowserEvent('hide-form-modal');
        $this->emit('toast', 'success', 'آدرس جدید با موفقیعت ایجاد شد.');

    }

    public function updateAddress()
    {
        $addres = AddressModels::find($this->AddresID);

        $this->validate([
            'name' => 'required|string|min:2',
            'mobile' => 'required|digits:11',
            'code_posti' => 'required|digits:10',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        $addres->update([
            'name' => $this->name,
            'mobile' => $this->mobile,
            'code_posti' => $this->code_posti,
            'state' => $this->state,
            'city' => $this->city,
            'address' => $this->address,
        ]);
        $this->reset(
            ['address','state','city','name','name','mobile','code_posti']
        );
        $this->dispatchBrowserEvent('hide-form');

        $this->emit('toast', 'success', 'آدرس با موفقیعت ویرایش شد.');
    }

    public function editAdress($id)
    {
        $editAddress = AddressModels::find($id);
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form');
        $this->address = $editAddress->address;
        $this->state = $editAddress->state;
        $this->city = $editAddress->city;
        $this->name = $editAddress->name;
        $this->lname = $editAddress->lname;
        $this->mobile = $editAddress->mobile;
        $this->code_posti = $editAddress->code_posti;
        $this->AddresID = $id;


    }

    public function delete(){
        $address=AddressModels::find($this->deleteId);
        $address->delete();
        $this->deleteId='';
        $this->dispatchBrowserEvent('hide-delete-modal');
        $this->emit('toast', 'success', 'آدرس مورد نظر شما با موفقیت حذف شد.');

    }

    public function deleteAddress($id)
    {
        $this->deleteId=$id;
        $this->dispatchBrowserEvent('show-delete-modal');
     }

    public function AddAddress()
    {
        $this->dispatchBrowserEvent('show-form-modal');
    }

    public function mount()
    {
        SEOMeta::setTitle('آدرس ها');
    }

    public function render()
    {
        $addresses=AddressModels::where('user_id',auth()->user()->id)->get();
        $options=SiteOption::first();
        $countries = Country::all();
        return view('livewire.front.profile.address',compact('addresses','options','countries'))->layout('layouts.front');
    }
}
