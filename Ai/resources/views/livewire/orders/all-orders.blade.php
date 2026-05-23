<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Orders</h1>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6 class="card-title">Total Orders</h6>
                    <h2 class="mb-0">{{ $stats['total'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h6 class="card-title">Pending</h6>
                    <h2 class="mb-0">{{ $stats['pending'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h6 class="card-title">Processing</h6>
                    <h2 class="mb-0">{{ $stats['processing'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h6 class="card-title">Shipped</h6>
                    <h2 class="mb-0">{{ $stats['shipped'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6 class="card-title">Delivered</h6>
                    <h2 class="mb-0">{{ $stats['delivered'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h6 class="card-title">Cancelled</h6>
                    <h2 class="mb-0">{{ $stats['cancelled'] ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Filters</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" wire:model.live.debounce.300ms="search" 
                           placeholder="Search..." class="form-control">
                </div>
                <div class="col-md-3">
                    <select wire:model.live="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" wire:model.live="dateFrom" class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="date" wire:model.live="dateTo" class="form-control">
                </div>
                <div class="col-md-2">
                    <button wire:click="clearFilters" class="btn btn-secondary btn-block">Clear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th wire:click="sortBy('id')">Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th wire:click="sortBy('total_amount')">Total</th>
                            <th wire:click="sortBy('created_at')">Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user?->name ?? 'Guest' }}</td>
                                <td>
                                    <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" 
                                            class="form-control form-control-sm">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </td>
                                <td>${{ number_format($order->total_amount ?? 0, 2) }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <button wire:click="deleteOrder({{ $order->id }})" 
                                            class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
</div>