<?php

namespace App\Livewire\UserManagement;

use Livewire\Component;

class UserActivityLog extends Component
{
    public function render()
    {
        return view('livewire.user-management.user-activity-log')->layout('layouts.admin');
    }
}
