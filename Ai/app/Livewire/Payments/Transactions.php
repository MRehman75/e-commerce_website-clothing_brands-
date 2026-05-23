<?php

namespace App\Livewire\Payments;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Transaction;

#[Layout('layouts.admin')]
class Transactions extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $perPage = 10;
    public $dateFrom = '';
    public $dateTo = '';

    public function updatingSearch() { $this->resetPage(); }

    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->dateFrom = '';
        $this->dateTo = '';
        $this->resetPage();
    }

    public function render()
    {
        $transactions = Transaction::with(['order', 'user'])
            ->when($this->search, function ($query) {
                $query->where('transaction_id', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', fn($q) => $q->where('name', 'like', '%' . $this->search . '%'));
            })
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->latest()
            ->paginate($this->perPage);

        $stats = [
            'total' => Transaction::count(),
            'completed' => Transaction::where('status', 'completed')->count(),
            'pending' => Transaction::where('status', 'pending')->count(),
            'failed' => Transaction::where('status', 'failed')->count(),
            'total_amount' => Transaction::where('status', 'completed')->sum('amount'),
        ];

        return view('livewire.payments.transactions', compact('transactions', 'stats'));
    }
}