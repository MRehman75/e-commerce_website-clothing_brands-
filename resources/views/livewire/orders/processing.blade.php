<div>
   <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 text-white"><i class="fas fa-spinner me-2"></i>Processing Orders</h4>
            <small class="text-white-50">Total processing orders</small>
        </div>
        <div class="text-white" style="font-size:2.5rem; font-weight:700;">{{ $total }}</div>
    </div>
</div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Search by order#, name, email..."
                        wire:model.live="search">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control form-control-sm" wire:model.live="dateFrom">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control form-control-sm" wire:model.live="dateTo">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-sm btn-secondary w-100" wire:click="clearFilters">Clear</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size: 0.82rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $order->order_number }}</strong></td>
                                <td>
                                    {{ $order->customer_name }}<br>
                                    <small class="text-muted">{{ $order->customer_email }}</small>
                                </td>
                                <td>{{ $order->product_name }}</td>
                                <td><strong>Rs.{{ number_format($order->total, 2) }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'refunded' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                               <td>
    <div class="btn-group">
       <a href="{{ route('admin.orders.detail', $order->id) }}" 
   wire:navigate
   class="btn btn-sm btn-info text-white" title="View">
    <i class="fas fa-eye"></i>
</a>
        <button wire:click="updateStatus({{ $order->id }}, 'shipped')"
                class="btn btn-sm btn-primary text-white" title="Mark Shipped">
            <i class="fas fa-truck"></i>
        </button>
        <button wire:click="deleteOrder({{ $order->id }})"
                class="btn btn-sm btn-danger" title="Delete"
                onclick="return confirm('Delete karna chahte ho?')">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No processing orders found!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>