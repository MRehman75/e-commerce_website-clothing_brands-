@extends('layouts.admin')

@section('title', 'All Orders')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list me-2"></i>All Orders</span>
        <div>
            <input type="text" id="searchOrders" class="form-control form-control-sm" placeholder="Search orders..." style="width: 200px;">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-compact mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders ?? [] as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>${{ number_format($order->amount, 2) }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>
                            <select class="form-select form-select-sm status-select" style="width: 120px;" data-order-id="{{ $order->id }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteOrder({{ $order->id }})">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No orders found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $orders->links() ?? '' }}
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.status-select').forEach(select => {
    select.addEventListener('change', function() {
        const orderId = this.dataset.orderId;
        const status = this.value;
        
        fetch(`/admin/orders/${orderId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Show success message
                alert('Order status updated successfully');
            }
        });
    });
});

function deleteOrder(id) {
    if(confirm('Are you sure you want to delete this order?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush