<?php

namespace App\Livewire\Reports;

use Livewire\Component;

class ProductReport extends Component
{
    public function render()
    {
        return view('livewire.reports.product-report')->layout('layouts.admin');
    }
}
