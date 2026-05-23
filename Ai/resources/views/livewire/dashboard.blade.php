<div>
    <!-- MAIN STATS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h6 class="text-white-50">Total Orders</h6>
                <h2 class="text-white">{{ $totalOrders }}</h2>
                <small class="text-white-50">All time orders</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);">
                <h6 class="text-white-50">Total Revenue</h6>
                <h2 class="text-white">${{ number_format($totalRevenue, 2) }}</h2>
                <small class="text-white-50">All vendors combined</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);">
                <h6 class="text-white-50">Active Orders</h6>
                <h2 class="text-white">{{ $activeOrders }}</h2>
                <small class="text-white-50">Pending + Processing + Shipped</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);">
                <h6 class="text-white-50">Delivered Orders</h6>
                <h2 class="text-white">{{ $deliveredOrders }}</h2>
                <small class="text-white-50">Completed successfully</small>
            </div>
        </div>
    </div>

    <!-- ORDER STATUS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Pending Orders</h6>
                        <h2 class="mb-0 text-warning">{{ $pendingOrders }}</h2>
                        <small class="text-muted">Awaiting confirmation</small>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-clock fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Processing Orders</h6>
                        <h2 class="mb-0 text-info">{{ $processingOrders }}</h2>
                        <small class="text-muted">Being prepared</small>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-spinner fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Shipped Orders</h6>
                        <h2 class="mb-0 text-primary">{{ $shippedOrders }}</h2>
                        <small class="text-muted">In transit</small>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-truck fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Cancelled Orders</h6>
                        <h2 class="mb-0 text-danger">{{ $cancelledOrders }}</h2>
                        <small class="text-muted">Order cancelled</small>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                        <i class="fas fa-ban fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SALES CHART -->
    <div class="row g-3 mb-4">
        <div class="col-md-12">
            <div class="card p-3 shadow-sm border-0">
                <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i>Sales Performance (Last 30 Days)</h5>
                <div style="height: 350px;">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- RECENT ORDERS TABLE -->
    <div class="card p-3 shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Recent Orders</h5>
            <a href="{{ route('admin.orders.all') }}" wire:navigate class="btn btn-sm btn-primary">View All Orders</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle" style="font-size: 0.82rem;">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                    <tr>
                        <td><strong>#{{ $order->order_number }}</strong></td>
                        <td>
                            {{ $order->customer_name }}<br>
                            <small class="text-muted">{{ $order->customer_email }}</small>
                        </td>
                        <td>{{ $order->product_name }}</td>
                        <td><strong>${{ number_format($order->total, 2) }}</strong></td>
                        <td>
                            <span class="badge bg-{{ $order->status_color }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            No orders found!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    {
                        label: 'Revenue ($)',
                        data: @json($revenueData),
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Orders Count',
                        data: @json($ordersData),
                        borderColor: 'rgb(255, 159, 64)',
                        backgroundColor: 'rgba(255, 159, 64, 0.1)',
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Revenue ($)'
                        }
                    },
                    y1: {
                        position: 'right',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Orders'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush