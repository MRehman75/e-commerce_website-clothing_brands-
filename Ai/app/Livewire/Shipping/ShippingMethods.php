<?php

namespace App\Livewire\Shipping;

use App\Models\ShippingMethod;
use App\Models\ShippingZone;
use Livewire\Component;
use Livewire\WithPagination;

class ShippingMethods extends Component
{
    use WithPagination;

    public $shipping_zone_id, $name, $carrier, $rate_type = 'flat';
    public $rate = 0, $min_order_amount, $estimated_days_min, $estimated_days_max;
    public $is_active = true;
    public $editingId = null;
    public $showModal = false;
    public $search = '';
    public $filterZone = '';
    public $confirmingDeleteId = null;

    protected $rules = [
        'shipping_zone_id'   => 'required|exists:shipping_zones,id',
        'name'               => 'required|string|max:100',
        'carrier'            => 'nullable|string|max:100',
        'rate_type'          => 'required|in:flat,weight_based,price_based',
        'rate'               => 'required|numeric|min:0',
        'min_order_amount'   => 'nullable|numeric|min:0',
        'estimated_days_min' => 'nullable|integer|min:1',
        'estimated_days_max' => 'nullable|integer|min:1',
        'is_active'          => 'boolean',
    ];

    public function updatingSearch()  { $this->resetPage(); }
    public function updatingFilterZone() { $this->resetPage(); }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $method = ShippingMethod::findOrFail($id);
        $this->editingId           = $method->id;
        $this->shipping_zone_id    = $method->shipping_zone_id;
        $this->name                = $method->name;
        $this->carrier             = $method->carrier;
        $this->rate_type           = $method->rate_type;
        $this->rate                = $method->rate;
        $this->min_order_amount    = $method->min_order_amount;
        $this->estimated_days_min  = $method->estimated_days_min;
        $this->estimated_days_max  = $method->estimated_days_max;
        $this->is_active           = $method->is_active;
        $this->showModal           = true;
    }

    public function save()
    {
        $this->validate();

        ShippingMethod::updateOrCreate(
            ['id' => $this->editingId],
            [
                'shipping_zone_id'   => $this->shipping_zone_id,
                'name'               => $this->name,
                'carrier'            => $this->carrier,
                'rate_type'          => $this->rate_type,
                'rate'               => $this->rate,
                'min_order_amount'   => $this->min_order_amount,
                'estimated_days_min' => $this->estimated_days_min,
                'estimated_days_max' => $this->estimated_days_max,
                'is_active'          => $this->is_active,
            ]
        );

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $this->editingId ? 'Method updated.' : 'Method created.');
    }

    public function confirmDelete($id) { $this->confirmingDeleteId = $id; }

    public function delete()
    {
        ShippingMethod::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Method deleted.');
    }

    public function toggleActive($id)
    {
        $method = ShippingMethod::findOrFail($id);
        $method->update(['is_active' => !$method->is_active]);
    }

    private function resetForm()
    {
        $this->editingId = $this->shipping_zone_id = $this->name = $this->carrier = null;
        $this->rate_type = 'flat';
        $this->rate = 0;
        $this->min_order_amount = $this->estimated_days_min = $this->estimated_days_max = null;
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.shipping.shipping-methods', [
            'methods' => ShippingMethod::with('shippingZone')
                ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('carrier', 'like', "%{$this->search}%"))
                ->when($this->filterZone, fn($q) => $q->where('shipping_zone_id', $this->filterZone))
                ->latest()
                ->paginate(10),
            'zones' => ShippingZone::active()->get(),
        ])->layout('layouts.admin');
    }
}