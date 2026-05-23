<?php

namespace App\Livewire\UserManagement;

use Livewire\Component;

class AllUsers extends Component
{
    public function render()
    {
        return view('livewire.user-management.all-users')->layout('layouts.admin');
    }
}
