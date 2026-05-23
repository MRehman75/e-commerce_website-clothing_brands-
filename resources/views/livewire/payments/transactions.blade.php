<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="fas fa-history me-2 text-primary"></i>Transactions</h5>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats -->
    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted mb-1" style="font-size:0.75rem;">Total Transactions</h6>
                <h4 class="mb-0 text-dark">{{ $stats['total'] }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted mb-1" style="font-size:0.75rem;">Completed</h6>
                <h4 class="mb-0 text-success">{{ $stats['completed'] }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted mb-1" style="font-size:0.75rem;">Pending</h6>
                <h4 class="mb-0 text-warning">{{ $stats['pending'] }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted mb-1" style="font-size:0.75rem;">Total Revenue</h6>
                <h4 class="mb-0 text-primary">${{ number_format($stats['total_amount'], 2) }}</h4>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Search by transaction ID, name..."
                        wire:model.live="search">
                </div>
                <div class="col-md-2">
                    <select class="form-select form-select-sm" wire:model.live="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="failed">Failed</option>
                        <option value="refunded">Refunded</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control form-control-sm" wire:model.live="dateFrom">
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control form-control-sm" wire:model.live="dateTo">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-sm btn-secondary w-100" wire:click="clearFilters">Clear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size: 0.82rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Transaction ID</th>
                            <th>Customer</th>
                            <th>Order</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $transaction->transaction_id }}</strong></td>
                                <td>{{ $transaction->user?->name ?? 'N/A' }}</td>
                                <td>#{{ $transaction->order?->order_number ?? 'N/A' }}</td>
                                <td><strong>${{ number_format($transaction->amount, 2) }}</strong></td>
                                <td>{{ ucfirst($transaction->payment_method) }}</td>
                                <td>
                                    <span class="badge bg-{{ $transaction->status_color }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-history fa-2x mb-2 d-block"></i>
                                    No transactions found!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>