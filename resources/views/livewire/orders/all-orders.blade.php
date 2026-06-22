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
        <div class="card text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Total Orders</h6>
                        <h2 class="mb-0">{{ $stats['total'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-shopping-cart fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Pending</h6>
                        <h2 class="mb-0">{{ $stats['pending'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-clock fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Processing</h6>
                        <h2 class="mb-0">{{ $stats['processing'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-cog fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #868f96 0%, #596164 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Shipped</h6>
                        <h2 class="mb-0">{{ $stats['shipped'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-truck fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Delivered</h6>
                        <h2 class="mb-0">{{ $stats['delivered'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-check-circle fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #c94b4b 0%, #4b134f 100%);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50">Cancelled</h6>
                        <h2 class="mb-0">{{ $stats['cancelled'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-times-circle fa-2x text-white-50"></i>
                </div>
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
    <select wire:model.live="status" class="form-select">
        <option value="">All Status</option>
        <option value="pending">🕐 Pending</option>
        <option value="processing">⚙️ Processing</option>
        <option value="shipped">🚚 Shipped</option>
        <option value="delivered">✅ Delivered</option>
        <option value="cancelled">❌ Cancelled</option>
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
                               <td>{{ $order->customer_name ?? $order->user?->name ?? 'Guest' }}</td>
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
                               <td>Rs. {{ number_format($order->total ?? 0, 2) }}</td>
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