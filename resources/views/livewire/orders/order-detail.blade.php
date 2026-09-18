<div>
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded"
         style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white bg-opacity-25 p-2 rounded-circle">
                <i class="fas fa-receipt fa-2x text-white"></i>
            </div>
            <div>
                <h4 class="mb-0 text-white fw-bold">#{{ $order->order_number }}</h4>
                <small class="text-white-50">{{ $order->created_at->format('d M Y h:i A') }}</small>
            </div>
        </div>
        <a href="{{ route('admin.orders.all') }}" wire:navigate class="btn btn-sm fw-bold shadow"
           style="background:white; color:#667eea;">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="row g-3">
        <!-- Left Column -->
        <div class="col-md-8">

            <!-- Order Items -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-header fw-bold text-white p-3"
         style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
        <i class="fas fa-box me-2"></i> Order Items
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td><strong>{{ $item->product_name }}</strong></td>
                    <td>
                        @if($item->size)
                            <span class="badge bg-secondary">{{ $item->size }}</span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @if($item->color)
                            <span class="badge" style="background:{{ $item->color }}; color:{{ $item->color == '#000000' ? '#fff' : '#000' }};">
                                {{ $item->color }}
                            </span>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td><small class="text-muted">{{ $item->product_sku ?? 'N/A' }}</small></td>
                    <td>Rs. {{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td><strong>Rs. {{ number_format($item->total, 2) }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

            <!-- Order Summary -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header fw-bold text-white p-3"
                     style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <i class="fas fa-calculator me-2"></i> Order Summary
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <strong>Rs. {{ number_format($order->subtotal, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <strong>Rs. {{ number_format($order->shipping_cost, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax:</span>
                        <strong>Rs. {{ number_format($order->tax, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Discount:</span>
                        <strong class="text-danger">- Rs. {{ number_format($order->discount, 2) }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total:</span>
                        <strong class="fs-5 text-success">Rs. {{ number_format($order->total, 2) }}</strong>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($order->notes)
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header fw-bold">
                    <i class="fas fa-sticky-note me-2 text-warning"></i> Notes
                </div>
                <div class="card-body">
                    {{ $order->notes }}
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="col-md-4">

            <!-- Status -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header fw-bold text-white p-3"
                     style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                    <i class="fas fa-tasks me-2"></i> Order Status
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-{{ $order->status_color }} fs-6">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="d-grid gap-2">
                        <button wire:click="updateStatus('processing')"
                                class="btn btn-info btn-sm text-white">
                            <i class="fas fa-spinner me-1"></i> Processing
                        </button>
                        <button wire:click="updateStatus('shipped')"
                                class="btn btn-primary btn-sm">
                            <i class="fas fa-truck me-1"></i> Shipped
                        </button>
                        <button wire:click="updateStatus('delivered')"
                                class="btn btn-success btn-sm">
                            <i class="fas fa-check-circle me-1"></i> Delivered
                        </button>
                        <button wire:click="updateStatus('cancelled')"
                                class="btn btn-danger btn-sm">
                            <i class="fas fa-ban me-1"></i> Cancelled
                        </button>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header fw-bold text-white p-3"
                     style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <i class="fas fa-user me-2"></i> Customer Info
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
                    <p class="mb-1"><i class="fas fa-envelope me-1 text-muted"></i> {{ $order->customer_email }}</p>
                    <p class="mb-0"><i class="fas fa-phone me-1 text-muted"></i> {{ $order->customer_phone ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header fw-bold text-white p-3"
                     style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                    <i class="fas fa-map-marker-alt me-2"></i> Shipping Address
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->shipping_address }}</p>
                </div>
            </div>

            <!-- Payment Info -->
           {{-- ✅ Yeh karo --}}
<!-- Payment Info -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-header fw-bold text-white p-3"
         style="background: linear-gradient(135deg, #396afc 0%, #2948ff 100%);">
        <i class="fas fa-credit-card me-2"></i> Payment Info
    </div>
    <div class="card-body">
        <p class="mb-1"><strong>Method:</strong> {{ strtoupper($order->payment_method) }}</p>
        <p class="mb-2">
            <strong>Status:</strong>
            <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : ($order->payment_status == 'refunded' ? 'warning' : 'danger') }}">
                {{ ucfirst($order->payment_status) }}
            </span>
        </p>
        <hr>
        <p class="mb-2 small text-muted fw-semibold">Payment Status Update:</p>
        <div class="d-grid gap-2">
            <button wire:click="updatePaymentStatus('paid')"
                    class="btn btn-success btn-sm">
                <i class="fas fa-check-circle me-1"></i> Paid Mark Karein
            </button>
            <button wire:click="updatePaymentStatus('pending')"
                    class="btn btn-warning btn-sm text-white">
                <i class="fas fa-clock me-1"></i> Pending Mark Karein
            </button>
            <button wire:click="updatePaymentStatus('refunded')"
                    class="btn btn-info btn-sm text-white">
                <i class="fas fa-undo me-1"></i> Refunded Mark Karein
            </button>
            <button wire:click="updatePaymentStatus('failed')"
                    class="btn btn-danger btn-sm">
                <i class="fas fa-times-circle me-1"></i> Failed Mark Karein
            </button>
        </div>
    </div>
</div>
        </div>
    </div>
</div>