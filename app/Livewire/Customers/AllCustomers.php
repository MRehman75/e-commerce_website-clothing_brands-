<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class AllCustomers extends Component
{
    use WithPagination;

    // Form fields
    public $name, $email, $phone, $city, $address, $status = 'active';

    // State
    public $editingId       = null;
    public $showModal       = false;
    public $showViewModal   = false;
    public $viewingCustomer = null;
    public $confirmingDeleteId = null;

    // Filters
    public $search       = '';
    public $filterStatus = '';
    public $sortBy       = 'created_at';
    public $sortDir      = 'desc';
    public $perPage      = 10;

    protected $rules = [
        'name'    => 'required|string|max:100',
        'email'   => 'required|email|max:150',
        'phone'   => 'nullable|string|max:20',
        'city'    => 'nullable|string|max:100',
        'address' => 'nullable|string|max:255',
        'status'  => 'required|in:active,inactive,blocked',
    ];

    protected $queryString = [
        'search'       => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    public function updatingSearch()       { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

    public function sortBy($column)
    {
        $this->sortDir = ($this->sortBy === $column && $this->sortDir === 'asc') ? 'desc' : 'asc';
        $this->sortBy  = $column;
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $c = Customer::findOrFail($id);
        $this->editingId = $c->id;
        $this->name      = $c->name;
        $this->email     = $c->email;
        $this->phone     = $c->phone;
        $this->city      = $c->city;
        $this->address   = $c->address;
        $this->status    = $c->status;
        $this->showModal = true;
    }

    public function openView($id)
    {
        $this->viewingCustomer = Customer::findOrFail($id);
        $this->showViewModal   = true;
    }

    public function save()
    {
        
        $rules = $this->rules;

        // Unique email — ignore self on edit
        $rules['email'] = 'required|email|max:150|unique:customers,email' .
                          ($this->editingId ? ",{$this->editingId}" : '');

        $this->validate($rules);

        $wasEditing = $this->editingId;

        Customer::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name'    => $this->name,
                'email'   => $this->email,
                'phone'   => $this->phone,
                'city'    => $this->city,
                'address' => $this->address,
                'status'  => $this->status,
            ]
        );



        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $wasEditing ? 'Customer updated.' : 'Customer added.');
    }

    public function confirmDelete($id) { $this->confirmingDeleteId = $id; }

    public function delete()
    {
        Customer::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Customer deleted.');
    }

    public function updateStatus($id, $status)
    {
        Customer::findOrFail($id)->update(['status' => $status]);
        session()->flash('success', 'Status updated.');
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->name = $this->email = $this->phone = $this->city = $this->address = '';
        $this->status = 'active';
        $this->resetErrorBag();
    }

   public function render()
{
    $customers = Customer::query()
        ->when($this->search, function ($q) {
            $q->where(function ($inner) {
                $inner->where('name',  'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%")
                      ->orWhere('phone', 'like', "%{$this->search}%")
                      ->orWhere('city',  'like', "%{$this->search}%");
            });
        })
        ->when($this->filterStatus, fn($q) =>
            $q->where('status', $this->filterStatus)
        )
        ->orderBy($this->sortBy, $this->sortDir)
        ->paginate($this->perPage);

    $stats = [
        'total'    => Customer::count(),
        'active'   => Customer::where('status', 'active')->count(),
        'inactive' => Customer::where('status', 'inactive')->count(),
        'blocked'  => Customer::where('status', 'blocked')->count(),
    ];

    return view('livewire.customers.all-customers', compact('customers', 'stats'))
        ->layout('layouts.admin');
}
}