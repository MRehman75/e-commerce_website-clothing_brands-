<?php

namespace App\Livewire\UserManagement;

use Livewire\Component;

class RolesPermissions extends Component
{
    public function render()
    {
        return view('livewire.user-management.roles-permissions')->layout('layouts.admin');
    }
}
