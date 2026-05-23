<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="fas fa-clock me-2 text-warning"></i>Pending Orders
            <span class="badge bg-warning ms-2">{{ $total }}</span>
        </h5>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters -->
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

    <!-- Table -->
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
                                <td><strong>${{ number_format($order->total, 2) }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'refunded' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item small" href="#"><i class="fas fa-eye me-2"></i>View</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item small text-info" wire:click.prevent="updateStatus({{ $order->id }}, 'processing')"><i class="fas fa-spinner me-2"></i>Mark Processing</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item small text-danger" wire:click.prevent="deleteOrder({{ $order->id }})"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No pending orders found!
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