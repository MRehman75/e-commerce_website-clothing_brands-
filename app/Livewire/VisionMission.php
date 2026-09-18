<?php

namespace App\Livewire;

use Livewire\Component;

class VisionMission extends Component
{
    public function render()
    {
        return view('livewire.vision-mission')
            ->layout('components.layouts.app'); // adjust to your layout path
    }
}
