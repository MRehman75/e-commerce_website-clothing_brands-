<?php

namespace App\Livewire\Customers;

use Livewire\Component;

class CustomerGroups extends Component
{
    public function render()
    {
        return view('livewire.customers.customer-groups')->layout('layouts.admin');
    }
}
