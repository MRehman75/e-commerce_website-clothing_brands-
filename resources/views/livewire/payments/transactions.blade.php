<div>
   <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 text-white"><i class="fas fa-exchange-alt me-2"></i>Transactions</h4>
            <small class="text-white-50">All payment transactions</small>
        </div>
        <i class="fas fa-history fa-2x text-white-50"></i>
    </div>
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
        <div class="card border-0 shadow-sm p-3 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Total Transactions</h6>
                    <h4 class="mb-0 text-white">{{ $stats['total'] }}</h4>
                </div>
                <i class="fas fa-exchange-alt fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-white" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Completed</h6>
                    <h4 class="mb-0 text-white">{{ $stats['completed'] }}</h4>
                </div>
                <i class="fas fa-check-circle fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Pending</h6>
                    <h4 class="mb-0 text-white">{{ $stats['pending'] }}</h4>
                </div>
                <i class="fas fa-clock fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-white" style="background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Total Revenue</h6>
                    <h4 class="mb-0 text-white">Rs.{{ number_format($stats['total_amount'], 2) }}</h4>
                </div>
                <i class="fas fa-rupee-sign fa-2x text-white-50"></i>
            </div>
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
                <div class="col-md-12">
    <div class="d-flex gap-2 flex-wrap">
        <button wire:click="$set('statusFilter', '')" 
                class="btn btn-sm {{ $statusFilter == '' ? 'btn-primary' : 'btn-outline-primary' }}">
            <i class="fas fa-list me-1"></i> All
        </button>
        <button wire:click="$set('statusFilter', 'pending')" 
                class="btn btn-sm {{ $statusFilter == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">
            <i class="fas fa-clock me-1"></i> Pending
        </button>
        <button wire:click="$set('statusFilter', 'completed')" 
                class="btn btn-sm {{ $statusFilter == 'completed' ? 'btn-success' : 'btn-outline-success' }}">
            <i class="fas fa-check-circle me-1"></i> Completed
        </button>
        <button wire:click="$set('statusFilter', 'failed')" 
                class="btn btn-sm {{ $statusFilter == 'failed' ? 'btn-danger' : 'btn-outline-danger' }}">
            <i class="fas fa-times-circle me-1"></i> Failed
        </button>
        <button wire:click="$set('statusFilter', 'refunded')" 
                class="btn btn-sm {{ $statusFilter == 'refunded' ? 'btn-info' : 'btn-outline-info' }}">
            <i class="fas fa-undo me-1"></i> Refunded
        </button>
    </div>
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