<?php

namespace App\Livewire\UserManagement;

use Livewire\Component;

class AddNewUser extends Component
{
    public function render()
    {
        return view('livewire.user-management.add-new-user')->layout('layouts.admin');
    }
}
