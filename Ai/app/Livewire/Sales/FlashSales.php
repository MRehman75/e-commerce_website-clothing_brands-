<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\FlashSale;

#[Layout('layouts.admin')]
class FlashSales extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $editId = null;

    public $title = '';
    public $description = '';
    public $discount_percentage = '';
    public $start_time = '';
    public $end_time = '';
    public $is_active = true;

    public function updatingSearch() { $this->resetPage(); }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function editFlashSale($id)
    {
        $flashSale = FlashSale::findOrFail($id);
        $this->editId = $id;
        $this->title = $flashSale->title;
        $this->description = $flashSale->description;
        $this->discount_percentage = $flashSale->discount_percentage;
        $this->start_time = $flashSale->start_time->format('Y-m-d\TH:i');
        $this->end_time = $flashSale->end_time->format('Y-m-d\TH:i');
        $this->is_active = $flashSale->is_active;
        $this->showModal = true;
    }

    public function saveFlashSale()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'discount_percentage' => $this->discount_percentage,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'is_active' => $this->is_active,
        ];

        if ($this->editId) {
            FlashSale::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Flash Sale updated successfully!');
        } else {
            FlashSale::create($data);
            session()->flash('message', 'Flash Sale created successfully!');
        }

        $this->showModal = false;
        $this->resetFields();
    }

    public function deleteFlashSale($id)
    {
        FlashSale::findOrFail($id)->delete();
        session()->flash('message', 'Flash Sale deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $flashSale = FlashSale::findOrFail($id);
        $flashSale->update(['is_active' => !$flashSale->is_active]);
        session()->flash('message', 'Status updated!');
    }

    public function resetFields()
    {
        $this->editId = null;
        $this->title = '';
        $this->description = '';
        $this->discount_percentage = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->is_active = true;
    }

    public function render()
    {
        $flashSales = FlashSale::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate($this->perPage);

        $total = FlashSale::count();
        $active = FlashSale::where('is_active', true)->count();

        return view('livewire.sales.flash-sales', compact('flashSales', 'total', 'active'));
    }
}