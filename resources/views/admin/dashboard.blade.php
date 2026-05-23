@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row g-3 mb-3">
    <div class="col-md-3 col-6">
        <div class="card stat-card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Orders</h6>
                        <h3 class="fw-bold mb-0">{{ $totalOrders ?? '1,234' }}</h3>
                        <small class="text-success"><i class="fas fa-arrow-up"></i> +12%</small>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Revenue</h6>
                        <h3 class="fw-bold mb-0">${{ number_format($totalRevenue ?? 54200, 2) }}</h3>
                        <small class="text-success"><i class="fas fa-arrow-up"></i> +8%</small>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Customers</h6>
                        <h3 class="fw-bold mb-0">{{ $totalCustomers ?? '5,678' }}</h3>
                        <small class="text-success"><i class="fas fa-arrow-up"></i> +5%</small>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10 text-info">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Products</h6>
                        <h3 class="fw-bold mb-0">{{ $totalProducts ?? '892' }}</h3>
                        <small class="text-danger"><i class="fas fa-arrow-down"></i> -2%</small>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-clock me-2"></i>Recent Orders</span>
        <a href="{{ route('admin.orders.all') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-compact mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders ?? [] as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>${{ number_format($order->amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status_color ?? 'secondary' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">View</a>
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
    </div>
</div>
@endsection