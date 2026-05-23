<?php

namespace App\Livewire\Shipping;

use App\Models\ShippingZone;
use Livewire\Component;
use Livewire\WithPagination;

class ShippingZones extends Component
{
    use WithPagination;

    public $name, $region, $countries = [], $is_active = true;
      public $countriesString = '';  // 👈 1. YAHAN add karo (line 2 ke baad)
    public $editingId = null;
    public $showModal = false;
    public $search = '';
    public $confirmingDeleteId = null;

    protected $rules = [
        'name'       => 'required|string|max:100',
        'region'     => 'nullable|string|max:100',
        'countries'  => 'nullable|array',
        'is_active'  => 'boolean',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $zone = ShippingZone::findOrFail($id);
        $this->editingId  = $zone->id;
        $this->name       = $zone->name;
        $this->region     = $zone->region;
        $this->countries  = $zone->countries ?? [];
         $this->countriesString = implode(', ', $zone->countries ?? []);  // 👈 2. YAHAN
        $this->is_active  = $zone->is_active;
        $this->showModal  = true;
    }

    public function save()
    {
        $this->countries = array_filter(array_map('trim', explode(',', $this->countriesString)));
        $this->validate();

        ShippingZone::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name'      => $this->name,
                'region'    => $this->region,
                'countries' => $this->countries,
                'is_active' => $this->is_active,
            ]
        );

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $this->editingId ? 'Zone updated.' : 'Zone created.');
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        ShippingZone::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Zone deleted.');
    }

    public function toggleActive($id)
    {
        $zone = ShippingZone::findOrFail($id);
        $zone->update(['is_active' => !$zone->is_active]);
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->name      = '';
        $this->region    = '';
        $this->countries = [];
         $this->countriesString = '';  // 👈 4. YAHAN
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.shipping.shipping-zones', [
            'zones' => ShippingZone::query()
                ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('region', 'like', "%{$this->search}%"))
                ->latest()
                ->paginate(10),
        ])->layout('layouts.admin');
    }
}