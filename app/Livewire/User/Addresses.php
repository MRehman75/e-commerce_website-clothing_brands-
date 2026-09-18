<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\UserAddress;

class Addresses extends Component
{
    public $addresses;

    public $name;
    public $phone;
    public $address;
    public $city;
    public $state;
    public $postal_code;


    public function mount()
    {
        $this->loadAddresses();
    }


    public function loadAddresses()
    {
        $this->addresses = UserAddress::where('user_id', auth()->id())
            ->latest()
            ->get();
    }


    public function save()
    {
        $this->validate([
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'postal_code'=>'required',
        ]);


        UserAddress::create([

            'user_id'=>auth()->id(),

            'name'=>$this->name,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'city'=>$this->city,
            'state'=>$this->state,
            'postal_code'=>$this->postal_code,

            'is_default'=>false,

        ]);


        $this->reset([
            'name',
            'phone',
            'address',
            'city',
            'state',
            'postal_code'
        ]);


        $this->loadAddresses();


        session()->flash('success','Address added successfully.');
    }



    public function delete($id)
    {
        UserAddress::where('id',$id)
            ->where('user_id',auth()->id())
            ->delete();


        $this->loadAddresses();
    }



    public function render()
    {
        return view('livewire.user.addresses')
            ->layout('components.layouts.app');
    }
}