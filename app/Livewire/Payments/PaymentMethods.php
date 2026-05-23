<?php
namespace App\Livewire\Payments;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\PaymentMethod;

#[Layout('layouts.admin')]
class PaymentMethods extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $editId = null;
    public $name = '';
    public $code = '';
    public $icon = '';
    public $description = '';
    public $is_active = true;
    public $sort_order = 0;

    public function updatingSearch() { $this->resetPage(); }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
        $this->dispatch('payMethodModalOpened', content: ''); // ← Added
    }

    public function editMethod($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $this->editId      = $id;
        $this->name        = $method->name;
        $this->code        = $method->code;
        $this->icon        = $method->icon;
        $this->description = $method->description;
        $this->is_active   = $method->is_active;
        $this->sort_order  = $method->sort_order;
        $this->showModal   = true;
        $this->dispatch('payMethodModalOpened', content: $method->description ?? ''); // ← Added
    }

    public function saveMethod()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
        ]);

        $data = [
            'name'        => $this->name,
            'code'        => strtolower($this->code),
            'icon'        => $this->icon,
            'description' => $this->description,
            'is_active'   => $this->is_active,
            'sort_order'  => $this->sort_order,
        ];

        if ($this->editId) {
            PaymentMethod::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Payment method updated successfully!');
        } else {
            PaymentMethod::create($data);
            session()->flash('message', 'Payment method created successfully!');
        }

        $this->showModal = false;
        $this->resetFields();
    }

    public function deleteMethod($id)
    {
        PaymentMethod::findOrFail($id)->delete();
        session()->flash('message', 'Payment method deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $method = PaymentMethod::findOrFail($id);
        $method->update(['is_active' => !$method->is_active]);
        session()->flash('message', 'Status updated!');
    }

    public function resetFields()
    {
        $this->editId      = null;
        $this->name        = '';
        $this->code        = '';
        $this->icon        = '';
        $this->description = '';
        $this->is_active   = true;
        $this->sort_order  = 0;
    }

    public function render()
    {
        $methods = PaymentMethod::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('sort_order')
            ->paginate(10);

        $total  = PaymentMethod::count();
        $active = PaymentMethod::where('is_active', true)->count();

        return view('livewire.payments.payment-methods', compact('methods', 'total', 'active'));
    }
}