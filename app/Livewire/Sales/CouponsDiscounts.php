<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Coupon;

#[Layout('layouts.admin')]
class CouponsDiscounts extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $editId = null;

    public $code = '';
    public $type = 'percentage';
    public $value = '';
    public $min_order_amount = 0;
    public $max_discount = '';
    public $usage_limit = '';
    public $start_date = '';
    public $end_date = '';
    public $is_active = true;
    public $description = '';

    public function updatingSearch() { $this->resetPage(); }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function editCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $this->editId = $id;
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->min_order_amount = $coupon->min_order_amount;
        $this->max_discount = $coupon->max_discount;
        $this->usage_limit = $coupon->usage_limit;
        $this->start_date = $coupon->start_date?->format('Y-m-d');
        $this->end_date = $coupon->end_date?->format('Y-m-d');
        $this->is_active = $coupon->is_active;
        $this->description = $coupon->description;
        $this->showModal = true;
    }

    public function saveCoupon()
    {
        $this->validate([
            'code' => 'required|string|max:50',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
        ]);

        $data = [
            'code' => strtoupper($this->code),
            'type' => $this->type,
            'value' => $this->value,
            'min_order_amount' => $this->min_order_amount,
            'max_discount' => $this->max_discount ?: null,
            'usage_limit' => $this->usage_limit ?: null,
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
            'is_active' => $this->is_active,
            'description' => $this->description,
        ];

        if ($this->editId) {
            Coupon::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Coupon updated successfully!');
        } else {
            Coupon::create($data);
            session()->flash('message', 'Coupon created successfully!');
        }

        $this->showModal = false;
        $this->resetFields();
    }

    public function deleteCoupon($id)
    {
        Coupon::findOrFail($id)->delete();
        session()->flash('message', 'Coupon deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update(['is_active' => !$coupon->is_active]);
        session()->flash('message', 'Status updated!');
    }

    public function resetFields()
    {
        $this->editId = null;
        $this->code = '';
        $this->type = 'percentage';
        $this->value = '';
        $this->min_order_amount = 0;
        $this->max_discount = '';
        $this->usage_limit = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->is_active = true;
        $this->description = '';
    }

    public function render()
    {
        $coupons = Coupon::query()
            ->when($this->search, fn($q) => $q->where('code', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate($this->perPage);

        $total = Coupon::count();
        $active = Coupon::where('is_active', true)->count();

        return view('livewire.sales.coupons-discounts', compact('coupons', 'total', 'active'));
    }
}