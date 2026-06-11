<div>
    {{-- Header --}}
    <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 text-white"><i class="fas fa-chart-bar me-2"></i>Sales Report</h4>
                <small class="text-white-50">Orders aur revenue ka overview</small>
            </div>
            <i class="fas fa-chart-line fa-2x text-white-50"></i>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body py-2">
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">From</label>
                    <input type="date" wire:model.live="dateFrom" class="form-control form-control-sm">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">To</label>
                    <input type="date" wire:model.live="dateTo" class="form-control form-control-sm">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button wire:click="$set('dateFrom', '{{ now()->startOfMonth()->format('Y-m-d') }}'); $set('dateTo', '{{ now()->format('Y-m-d') }}')"
                            class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-redo me-1"></i>This Month
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Total Orders</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_orders'] }}</h3>
                    </div>
                    <i class="fas fa-shopping-cart fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #84fab0 0%, #08aeea 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Total Revenue</h6>
                        <h4 class="mb-0 fw-bold">Rs.{{ number_format($stats['total_revenue'], 0) }}</h4>
                    </div>
                    <i class="fas fa-rupee-sign fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Delivered</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['delivered'] }}</h3>
                    </div>
                    <i class="fas fa-check-circle fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Pending</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['pending'] }}</h3>
                    </div>
                    <i class="fas fa-clock fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #c94b4b 0%, #4b134f 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Cancelled</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['cancelled'] }}</h3>
                    </div>
                    <i class="fas fa-times-circle fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Avg Order</h6>
                        <h4 class="mb-0 fw-bold">Rs.{{ number_format($stats['avg_order_value'], 0) }}</h4>
                    </div>
                    <i class="fas fa-calculator fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="mb-0"><i class="fas fa-chart-line me-2"></i>Last 7 Days Revenue</h6>
        </div>
        <div class="card-body">
            <canvas id="salesChart" height="80"></canvas>
        </div>
    </div>

    {{-- Recent Orders Table --}}
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><i class="fas fa-list me-2"></i>Recent Orders</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:0.82rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $order->order_number }}</strong></td>
                            <td>{{ $order->customer_name }}</td>
                            <td><strong>Rs. {{ number_format($order->total, 2) }}</strong></td>
                            <td>
                                <span class="badge bg-{{ $order->status_color }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
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
        document.addEventListener('livewire:navigated', initChart);
        document.addEventListener('DOMContentLoaded', initChart);

        function initChart() {
            const ctx = document.getElementById('salesChart');
            if (!ctx) return;
            if (window.salesChartInstance) window.salesChartInstance.destroy();

            window.salesChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Revenue (Rs.)',
                        data: @json($chartData['data']),
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102,126,234,0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#667eea',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }
    </script>
    @endpush
</div>