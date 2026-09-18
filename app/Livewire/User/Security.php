<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Security extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;


    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);


        $user = Auth::user();


        if(!Hash::check($this->current_password, $user->password)){

            $this->addError(
                'current_password',
                'Current password is incorrect.'
            );

            return;
        }


        $user->update([
            'password' => Hash::make($this->password)
        ]);



        $this->reset([
            'current_password',
            'password',
            'password_confirmation'
        ]);


        session()->flash(
            'success',
            'Password changed successfully.'
        );
    }



    public function render()
    {
        return view('livewire.user.security')
            ->layout('components.layouts.app');
    }
}