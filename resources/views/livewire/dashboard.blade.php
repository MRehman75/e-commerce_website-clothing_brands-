{{-- ============================================================
     ADMIN DASHBOARD - FULL REDESIGN
     Missing variables needed in Controller:
     - $todayRevenue, $todayOrders, $weekRevenue, $weekOrders
     - $conversionRate, $avgOrderValue
     - $topProducts (collection: name, total_sold, revenue)
     - $topCustomers (collection: name, email, total_spent, orders_count)
     - $orderStatusData (array for donut chart)
     - $monthlyRevenueData, $monthlyLabels (for bar chart)
     - $revenueGrowth, $ordersGrowth, $customersGrowth (% change)
     - $pendingOrdersList (recent pending orders)
     - $lowStockList (collection: name, stock)
     - $failedPayments
============================================================ --}}

<style>
    /* Fix overflow */
.py-1 {
    overflow-x: hidden !important;
}

canvas {
    max-width: 100% !important;
}
/* Naya lagao */
.panel-body {
    overflow: visible;
}
/* Yeh add karo */
.main-content {
    overflow-x: hidden !important;
}

.row {
    margin-right: 0 !important;
    margin-left: 0 !important;
}


/* Chart container fix */
.panel-body canvas {
    max-height: 300px !important;
}

#salesLineChart { max-height: 220px !important; }
#orderDonut { max-height: 250px !important; }
#monthlyBar { max-height: 200px !important; }
#weekBar { max-height: 200px !important; }

/* h-100 fix */
.col-md-8 .panel,
.col-md-4 .panel {
    height: auto !important;
}
/*.panel-body {
    overflow: hidden;
}*/
/* ===== DESIGN TOKENS ===== */
:root {
    --r: 14px;
    --r-sm: 10px;
    --trans: all 0.28s cubic-bezier(0.4,0,0.2,1);
    --shadow: 0 2px 16px rgba(0,0,0,0.07);
    --shadow-lg: 0 8px 32px rgba(0,0,0,0.13);
    --border: 1px solid #f1f5f9;

    --g-purple:  linear-gradient(135deg,#667eea,#764ba2);
    --g-teal:    linear-gradient(135deg,#11998e,#38ef7d);
    --g-orange:  linear-gradient(135deg,#f7971e,#ffd200);
    --g-red:     linear-gradient(135deg,#ff416c,#ff4b2b);
    --g-blue:    linear-gradient(135deg,#4facfe,#00f2fe);
    --g-pink:    linear-gradient(135deg,#f093fb,#f5576c);
    --g-indigo:  linear-gradient(135deg,#396afc,#2948ff);
    --g-cyan:    linear-gradient(135deg,#43cea2,#185a9d);
    --g-mint:    linear-gradient(135deg,#43e97b,#38f9d7);
    --g-peach:   linear-gradient(135deg,#fa709a,#fee140);
    --g-dark:    linear-gradient(135deg,#1a1a2e,#0f3460);
}

/* ===== STAT CARDS ===== */
.stat-card {
    border-radius: var(--r) !important;
    border: none !important;
    box-shadow: var(--shadow);
    transition: var(--trans);
    position: relative;
    overflow: hidden;
    cursor: default;
}
.stat-card::before {
    content:''; position:absolute; top:-30%; right:-8%;
    width:130px; height:130px;
    background:rgba(255,255,255,0.10); border-radius:50%;
    pointer-events:none;
}
.stat-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: var(--shadow-lg);
    z-index: 2;
}
.stat-card:hover .s-icon { transform: rotate(-10deg) scale(1.15); }
.s-icon {
    width:50px; height:50px; border-radius:12px;
    background:rgba(255,255,255,0.22);
    display:flex; align-items:center; justify-content:center;
    font-size:1.3rem; flex-shrink:0;
    transition: var(--trans);
    backdrop-filter:blur(4px);
}
.s-label { font-size:0.68rem; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; opacity:0.82; }
.s-value { font-size:1.9rem; font-weight:800; line-height:1.1; letter-spacing:-0.02em; }
.s-value.sm { font-size:1.35rem; }
.s-sub   { font-size:0.7rem; opacity:0.75; font-weight:500; margin-top:2px; }
.s-badge {
    display:inline-flex; align-items:center; gap:3px;
    font-size:0.65rem; font-weight:700; padding:2px 7px;
    border-radius:20px; background:rgba(255,255,255,0.25);
    margin-top:4px;
}

/* ===== SECTION LABEL ===== */
.sec-label {
    font-size:0.65rem; font-weight:800; letter-spacing:0.12em;
    text-transform:uppercase; color:#94a3b8;
    margin:1.5rem 0 0.7rem; padding-left:2px;
    display:flex; align-items:center; gap:8px;
}
.sec-label::after { content:''; flex:1; height:1px; background:linear-gradient(90deg,#e2e8f0,transparent); }

/* ===== PANEL CARDS ===== */
.panel {
    border-radius: var(--r) !important;
    border: var(--border) !important;
    box-shadow: var(--shadow);
    transition: var(--trans);
    background: #fff;
}
.panel:hover { box-shadow: var(--shadow-lg); }
.panel-head {
    padding: 1.1rem 1.3rem 0.7rem;
    border-bottom: var(--border);
    display:flex; justify-content:space-between; align-items:center;
}
.panel-title { font-size:0.82rem; font-weight:700; color:#1e293b; }
.panel-body { padding: 1rem 1.3rem; }

/* ===== ALERT STRIP ===== */
.alert-strip {
    border-radius: var(--r-sm);
    padding: 0.6rem 1rem;
    display:flex; align-items:center; gap:10px;
    font-size:0.78rem; font-weight:600;
    margin-bottom:8px;
    transition: var(--trans);
    cursor:pointer;
}
.alert-strip:hover { transform:translateX(4px); }
.alert-strip.warn  { background:#fff7ed; border-left:3px solid #f97316; color:#9a3412; }
.alert-strip.danger{ background:#fef2f2; border-left:3px solid #ef4444; color:#991b1b; }
.alert-strip.info  { background:#eff6ff; border-left:3px solid #3b82f6; color:#1e40af; }

/* ===== TABLE ===== */
.dash-table thead th {
    background:#f8fafc; color:#64748b;
    font-size:0.68rem; letter-spacing:0.07em;
    text-transform:uppercase; border:none;
    padding:0.7rem 1rem; font-weight:700;
}
.dash-table tbody tr {
    transition: var(--trans);
    border-bottom:1px solid #f8fafc;
}
.dash-table tbody tr:hover { background:#f8faff; }
.dash-table tbody td { padding:0.75rem 1rem; vertical-align:middle; font-size:0.8rem; border:none; }

/* ===== PROGRESS BAR ===== */
.prog-wrap { margin-bottom:10px; }
.prog-top  { display:flex; justify-content:space-between; font-size:0.73rem; margin-bottom:4px; }
.prog-name { font-weight:600; color:#334155; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:160px; }
.prog-val  { font-weight:700; color:#4f46e5; }
.prog-bar  { height:6px; border-radius:99px; background:#f1f5f9; overflow:hidden; }
.prog-fill { height:100%; border-radius:99px; transition: width 1s ease; }

/* ===== QUICK ACTIONS ===== */
.qa-btn {
    border-radius: var(--r-sm);
    padding:0.6rem 0.8rem;
    font-size:0.75rem; font-weight:700;
    border:none; transition: var(--trans);
    display:flex; flex-direction:column; align-items:center; gap:5px;
    text-decoration:none; color:#fff !important;
}
.qa-btn:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(0,0,0,0.15); }
.qa-btn i { font-size:1.2rem; }

/* ===== ORDER STATUS BADGE ===== */
.status-dot {
    width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:5px;
}

/* ===== CUSTOMER RANK ===== */
.cust-rank {
    width:28px;height:28px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-size:0.7rem;font-weight:800;color:#fff;flex-shrink:0;
}

/* GRADIENTS for bg */
.bg-purple { background: var(--g-purple); }
.bg-teal   { background: var(--g-teal); }
.bg-orange { background: var(--g-orange); }
.bg-red    { background: var(--g-red); }
.bg-blue   { background: var(--g-blue); }
.bg-pink   { background: var(--g-pink); }
.bg-indigo { background: var(--g-indigo); }
.bg-cyan   { background: var(--g-cyan); }
.bg-mint   { background: var(--g-mint); }
.bg-peach  { background: var(--g-peach); }
.bg-dark   { background: var(--g-dark); }
.bg-lavender { background: linear-gradient(135deg, #a18cd1, #fbc2eb); }
</style>

<div class="py-1">

{{-- ==========================================
     🔔 SMART ALERTS BAR
========================================== --}}
@if($pendingOrders > 0 || $lowStockProducts > 0 || $failedPayments > 0)
<div class="mb-3">
    @if($pendingOrders > 0)
    <a href="{{ route('admin.orders.all') }}" wire:navigate class="alert-strip warn text-decoration-none">
        <i class="fas fa-clock"></i>
        <span>{{ $pendingOrders }} orders pending confirmation — <u>review now</u></span>
        <i class="fas fa-chevron-right ms-auto"></i>
    </a>
    @endif
    @if($lowStockProducts > 0)
    <a href="#" class="alert-strip danger text-decoration-none">
        <i class="fas fa-exclamation-triangle"></i>
        <span>{{ $lowStockProducts }} products have low stock (less than 10) — <u>restock</u></span>
        <i class="fas fa-chevron-right ms-auto"></i>
    </a>
    @endif
    @if(($failedPayments ?? 0) > 0)
    <div class="alert-strip info">
        <i class="fas fa-credit-card"></i>
        <span>{{ $failedPayments }} failed payment transactions today</span>
        <i class="fas fa-chevron-right ms-auto"></i>
    </div>
    @endif
</div>
@endif

{{-- ==========================================
     ⚡ QUICK ACTIONS
========================================== --}}
<div class="panel mb-3">
    <div class="panel-head">
        <span class="panel-title"><i class="fas fa-bolt text-warning me-1"></i> Quick Actions</span>
    </div>
    <div class="panel-body">
        <div class="row g-2">
            <div class="col-6 col-md-2">
                <a href="{{ route('admin.products.create') }}" wire:navigate class="qa-btn bg-purple w-100">
    <i class="fas fa-plus-circle"></i> Add Product
</a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('admin.orders.all') }}" wire:navigate class="qa-btn bg-indigo w-100">
                    <i class="fas fa-list-alt"></i> View Orders
                </a>
            </div>
            <div class="col-6 col-md-2">
               <a href="{{ route('admin.sales.coupons-discounts') }}" wire:navigate class="qa-btn bg-teal w-100">
    <i class="fas fa-ticket-alt"></i> Add Coupon
</a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('admin.customers.all') }}" wire:navigate class="qa-btn bg-orange w-100">
    <i class="fas fa-user-plus"></i> Add Customer
</a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('admin.website.blog-posts') }}" wire:navigate class="qa-btn bg-pink w-100">
    <i class="fas fa-blog"></i> New Post
</a>
            </div>
            <div class="col-6 col-md-2">
                <a href="{{ route('admin.settings.general') }}" wire:navigate class="qa-btn bg-dark w-100">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ==========================================
     📊 TOP 4 KPI STATS
========================================== --}}
<div class="sec-label"><i class="fas fa-tachometer-alt"></i> Today's Overview</div>
<div class="row g-3 mb-3">
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-purple text-white p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="s-label">Today's Revenue</div>
                    <div class="s-value sm">Rs. {{ number_format($todayRevenue ?? 0, 0) }}</div>
                    <div class="s-badge">
                        <i class="fas fa-arrow-{{ ($revenueGrowth ?? 0) >= 0 ? 'up' : 'down' }}"></i>
                        {{ abs($revenueGrowth ?? 0) }}% vs yesterday
                    </div>
                </div>
                <div class="s-icon"><i class="fas fa-rupee-sign"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-blue text-white p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="s-label">Today's Orders</div>
                    <div class="s-value">{{ $todayOrders ?? 0 }}</div>
                    <div class="s-badge">
                        <i class="fas fa-arrow-{{ ($ordersGrowth ?? 0) >= 0 ? 'up' : 'down' }}"></i>
                        {{ abs($ordersGrowth ?? 0) }}% vs yesterday
                    </div>
                </div>
                <div class="s-icon"><i class="fas fa-shopping-bag"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-teal text-white p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="s-label">Avg Order Value</div>
                    <div class="s-value sm">Rs. {{ number_format($avgOrderValue ?? 0, 0) }}</div>
                    <div class="s-sub">Per order avg</div>
                </div>
                <div class="s-icon"><i class="fas fa-chart-pie"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-orange text-white p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="s-label">New Customers</div>
                    <div class="s-value">{{ $newCustomersThisMonth ?? 0 }}</div>
                    <div class="s-badge">
                        <i class="fas fa-arrow-{{ ($customersGrowth ?? 0) >= 0 ? 'up' : 'down' }}"></i>
                        {{ abs($customersGrowth ?? 0) }}% this month
                    </div>
                </div>
                <div class="s-icon"><i class="fas fa-user-plus"></i></div>
            </div>
        </div>
    </div>
</div>

{{-- Week Stats Row --}}
<div class="row g-3 mb-2">
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-indigo text-white p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="s-label">This Week Revenue</div>
                    <div class="s-value sm">Rs. {{ number_format($weekRevenue ?? 0, 0) }}</div>
                    <div class="s-sub">Last 7 days</div>
                </div>
                <div class="s-icon"><i class="fas fa-calendar-week"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-mint text-white p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="s-label">Total Revenue</div>
                    <div class="s-value sm">Rs. {{ number_format($totalRevenue ?? 0, 0) }}</div>
                    <div class="s-sub">All time</div>
                </div>
                <div class="s-icon"><i class="fas fa-money-bill-wave"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-pink text-white p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="s-label">Total Orders</div>
                    <div class="s-value">{{ $totalOrders ?? 0 }}</div>
                    <div class="s-sub">All time</div>
                </div>
                <div class="s-icon"><i class="fas fa-shopping-cart"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card bg-peach text-white p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="s-label">Total Customers</div>
                    <div class="s-value">{{ $totalCustomers ?? 0 }}</div>
                    <div class="s-sub">Registered</div>
                </div>
                <div class="s-icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
    </div>
</div>

{{-- ==========================================
     📈 CHARTS ROW 1 — Sales Line + Order Donut
========================================== --}}
<div class="sec-label"><i class="fas fa-chart-line"></i> Sales & Orders Analytics</div>
<div class="row g-3 mb-3">
    {{-- Sales Line Chart --}}
    <div class="col-md-8">
       <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-chart-line text-primary me-1"></i> Revenue — Last 30 Days</span>
                <span class="badge" style="background:#eff6ff;color:#3b82f6;font-size:0.65rem;padding:4px 10px;border-radius:20px;">Daily</span>
            </div>
            <div class="panel-body pt-2">
                <canvas id="salesLineChart" height="220"></canvas>
            </div>
        </div>
    </div>
    {{-- Order Status Donut --}}
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-circle-notch text-warning me-1"></i> Orders by Status</span>
            </div>
            <div class="panel-body">
                {{-- Naya --}}
<canvas id="orderDonut" height="250"></canvas>
                <div class="mt-2" style="font-size:0.72rem;">
                    <div class="d-flex justify-content-between mb-1">
                        <span><span class="status-dot" style="background:#f7971e"></span>Pending</span>
                        <strong>{{ $pendingOrders ?? 0 }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span><span class="status-dot" style="background:#4facfe"></span>Processing</span>
                        <strong>{{ $processingOrders ?? 0 }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span><span class="status-dot" style="background:#396afc"></span>Shipped</span>
                        <strong>{{ $shippedOrders ?? 0 }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <span><span class="status-dot" style="background:#43e97b"></span>Delivered</span>
                        <strong>{{ $deliveredOrders ?? 0 }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><span class="status-dot" style="background:#ff416c"></span>Cancelled</span>
                        <strong>{{ $cancelledOrders ?? 0 }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ==========================================
     📊 CHARTS ROW 2 — Monthly Bar + Weekly Bar
========================================== --}}
<div class="row g-3 mb-3">
    {{-- Monthly Revenue Bar --}}
    <div class="col-md-7">
        <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-chart-bar text-success me-1"></i> Monthly Revenue — {{ date('Y') }}</span>
            </div>
            <div class="panel-body pt-2">
                <canvas id="monthlyBar" height="200"></canvas>
            </div>
        </div>
    </div>
    {{-- This Week Orders Bar --}}
    <div class="col-md-5">
        <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-calendar-week text-indigo me-1" style="color:#667eea"></i> Orders This Week</span>
            </div>
            <div class="panel-body pt-2">
                <canvas id="weekBar" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- ==========================================
     🏆 TOP PRODUCTS + TOP CUSTOMERS
========================================== --}}
<div class="sec-label"><i class="fas fa-trophy"></i> Top Performers</div>
<div class="row g-3 mb-3">
    {{-- Top Selling Products --}}
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-fire text-danger me-1"></i> Top Selling Products</span>
                <a href="#" style="font-size:0.7rem;color:#4f46e5;">View all</a>
            </div>
            <div class="panel-body">
                @forelse($topProducts ?? [] as $i => $product)
                <div class="prog-wrap">
                    <div class="prog-top">
                        <span class="prog-name">
                            <span class="badge me-1" style="background:{{ ['#667eea','#f7971e','#43e97b','#f093fb','#4facfe'][$i % 5] }};color:#fff;font-size:0.6rem;width:18px;height:18px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;padding:0;">{{ $i+1 }}</span>
                            {{ $product->name }}
                        </span>
                        <span class="prog-val">{{ $product->total_sold ?? 0 }} sold</span>
                    </div>
                    <div class="prog-bar">
                        <div class="prog-fill" style="width:{{ min(100, (($product->total_sold ?? 0) / max(1, ($topProducts->first()->total_sold ?? 1))) * 100) }}%;background:{{ ['var(--g-purple)','var(--g-orange)','var(--g-teal)','var(--g-pink)','var(--g-blue)'][$i % 5] }}"></div>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center py-3" style="font-size:0.8rem;">No product data yet</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Top Customers --}}
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-crown text-warning me-1"></i> Top Customers</span>
                <a href="#" style="font-size:0.7rem;color:#4f46e5;">View all</a>
            </div>
            <div class="panel-body">
                @forelse($topCustomers ?? [] as $i => $customer)
                <div class="d-flex align-items-center gap-2 mb-2 p-2 rounded-2" style="background:#f8fafc;transition:var(--trans);" onmouseover="this.style.background='#f0f4ff'" onmouseout="this.style.background='#f8fafc'">
                    <div class="cust-rank" style="background:{{ ['var(--g-purple)','var(--g-orange)','var(--g-teal)','var(--g-pink)','var(--g-blue)'][$i % 5] }}">{{ $i+1 }}</div>
                    <div class="flex-grow-1 overflow-hidden">
                        <div style="font-size:0.8rem;font-weight:700;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $customer->name }}</div>
                        <div style="font-size:0.68rem;color:#94a3b8;">{{ $customer->orders_count ?? 0 }} orders</div>
                    </div>
                    <div style="font-size:0.78rem;font-weight:800;color:#059669;white-space:nowrap;">Rs. {{ number_format($customer->total_spent ?? 0, 0) }}</div>
                </div>
                @empty
                <p class="text-muted text-center py-3" style="font-size:0.8rem;">No customer data yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ==========================================
     📦 LOW STOCK + ORDER STATUS SUMMARY
========================================== --}}
<div class="row g-3 mb-3">
    {{-- Low Stock Alert --}}
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-exclamation-triangle text-danger me-1"></i> Low Stock Alert</span>
                <span class="badge bg-danger" style="font-size:0.65rem;">{{ $lowStockProducts ?? 0 }}</span>
            </div>
            <div class="panel-body" style="max-height:220px;overflow-y:auto;">
                @forelse($lowStockList ?? [] as $product)
                <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid #f8fafc;font-size:0.78rem;">
                    <span style="color:#334155;font-weight:600;">{{ Str::limit($product->name, 22) }}</span>
                    <span class="badge {{ $product->stock <= 3 ? 'bg-danger' : 'bg-warning text-dark' }}" style="font-size:0.65rem;">{{ $product->stock }} left</span>
                </div>
                @empty
                <p class="text-muted text-center py-3" style="font-size:0.78rem;"><i class="fas fa-check-circle text-success me-1"></i>All products stocked!</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Order Status Summary --}}
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-tasks text-primary me-1"></i> Order Status Summary</span>
            </div>
            <div class="panel-body">
                @php
                $total = max(1, ($totalOrders ?? 1));
                $statuses = [
                    ['label'=>'Pending',    'val'=>$pendingOrders??0,    'color'=>'#f7971e'],
                    ['label'=>'Processing', 'val'=>$processingOrders??0, 'color'=>'#4facfe'],
                    ['label'=>'Shipped',    'val'=>$shippedOrders??0,    'color'=>'#396afc'],
                    ['label'=>'Delivered',  'val'=>$deliveredOrders??0,  'color'=>'#43e97b'],
                    ['label'=>'Cancelled',  'val'=>$cancelledOrders??0,  'color'=>'#ff416c'],
                ];
                @endphp
                @foreach($statuses as $s)
                <div class="prog-wrap">
                    <div class="prog-top">
                        <span class="prog-name"><span class="status-dot" style="background:{{$s['color']}}"></span>{{$s['label']}}</span>
                        <span style="font-size:0.72rem;font-weight:700;color:#334155;">{{$s['val']}}</span>
                    </div>
                    <div class="prog-bar">
                        <div class="prog-fill" style="width:{{ round(($s['val']/$total)*100) }}%;background:{{$s['color']}}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Monthly Target --}}
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-head">
                <span class="panel-title"><i class="fas fa-bullseye text-success me-1"></i> This Month</span>
            </div>
            <div class="panel-body">
                <div class="text-center mb-3">
                    <div style="font-size:0.72rem;color:#94a3b8;font-weight:600;">Monthly Revenue</div>
                    <div style="font-size:1.8rem;font-weight:800;color:#1e293b;">Rs. {{ number_format($monthlySales ?? 0, 0) }}</div>
                </div>
                <div class="d-flex justify-content-between mb-3 text-center">
                    <div>
                        <div style="font-size:1.1rem;font-weight:800;color:#4f46e5;">{{ $weekOrders ?? 0 }}</div>
                        <div style="font-size:0.65rem;color:#94a3b8;">Week Orders</div>
                    </div>
                    <div>
                        <div style="font-size:1.1rem;font-weight:800;color:#059669;">{{ $newCustomersThisMonth ?? 0 }}</div>
                        <div style="font-size:0.65rem;color:#94a3b8;">New Customers</div>
                    </div>
                    <div>
                        <div style="font-size:1.1rem;font-weight:800;color:#dc2626;">{{ $lowStockProducts ?? 0 }}</div>
                        <div style="font-size:0.65rem;color:#94a3b8;">Low Stock</div>
                    </div>
                </div>
                <div style="font-size:0.72rem;color:#94a3b8;margin-bottom:4px;font-weight:600;">Active Products</div>
                <div class="prog-bar" style="height:8px;">
                    <div class="prog-fill" style="width:{{ $totalProducts > 0 ? round(($activeProducts/$totalProducts)*100) : 0 }}%;background:var(--g-teal)"></div>
                </div>
                <div style="font-size:0.7rem;color:#64748b;margin-top:4px;">{{ $activeProducts ?? 0 }} of {{ $totalProducts ?? 0 }} products active</div>
            </div>
        </div>
    </div>
</div>

{{-- ==========================================
     🛒 RECENT ORDERS TABLE
========================================== --}}
<div class="sec-label"><i class="fas fa-receipt"></i> Recent Orders</div>
<div class="panel mb-4">
    <div class="panel-head">
        <span class="panel-title"><i class="fas fa-list me-1 text-primary"></i> Latest Transactions</span>
        <a href="{{ route('admin.orders.all') }}" wire:navigate class="btn btn-sm btn-primary rounded-pill" style="font-size:0.72rem;padding:4px 14px;">
            View All <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table dash-table mb-0">
            <thead>
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
                    <td><span style="font-weight:700;color:#4f46e5;">#{{ $order->order_number }}</span></td>
                    <td>
                        <div style="font-weight:600;">{{ $order->customer_name }}</div>
                        <small class="text-muted">{{ $order->customer_email }}</small>
                    </td>
                    <td>{{ Str::limit($order->product_name, 25) }}</td>
                    <td><strong style="color:#059669;">Rs. {{ number_format($order->total, 2) }}</strong></td>
                    <td>
                        <span class="badge bg-{{ $order->status_color }}" style="font-size:0.68rem;">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td style="color:#94a3b8;">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-2x d-block mb-2 opacity-25"></i>
                        Abhi tak koi orders nahi!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ==========================================
     BOTTOM STATS ROW (existing boxes — compact)
========================================== --}}
<div class="sec-label"><i class="fas fa-th"></i> All Stats</div>
<div class="row g-2 mb-4">
    @php
    $allStats = [
        ['label'=>'Active Orders',     'val'=>$activeOrders??0,          'icon'=>'fa-fire',              'bg'=>'bg-blue'],
        ['label'=>'Total Products',    'val'=>$totalProducts??0,          'icon'=>'fa-box',               'bg'=>'bg-teal'],
        ['label'=>'Active Products',   'val'=>$activeProducts??0,         'icon'=>'fa-boxes',             'bg'=>'bg-indigo'],
        ['label'=>'Categories',        'val'=>$totalCategories??0,        'icon'=>'fa-tags',              'bg'=>'bg-pink'],
        ['label'=>'Brands',            'val'=>$totalBrands??0,            'icon'=>'fa-trademark',         'bg'=>'bg-orange'],
        ['label'=>'Total Users',       'val'=>$totalUsers??0,             'icon'=>'fa-users',             'bg'=>'bg-purple'],
        ['label'=>'Verified Users',    'val'=>$verifiedUsers??0,          'icon'=>'fa-user-check',        'bg'=>'bg-mint'],
        ['label'=>'Unverified',        'val'=>$unverifiedUsers??0,        'icon'=>'fa-user-times',        'bg'=>'bg-red'],
        ['label'=>'Coupons',           'val'=>$totalCoupons??0,           'icon'=>'fa-tag',               'bg'=>'bg-lavender'],
        ['label'=>'Active Coupons',    'val'=>$activeCoupons??0,          'icon'=>'fa-ticket-alt',        'bg'=>'bg-mint'],
        ['label'=>'Flash Sales',       'val'=>$totalFlashSales??0,        'icon'=>'fa-bolt',              'bg'=>'bg-orange'],
        ['label'=>'Transactions',      'val'=>$totalTransactions??0,      'icon'=>'fa-exchange-alt',      'bg'=>'bg-blue'],
        ['label'=>'Pay Gateways',      'val'=>($activePaymentGateways??0).'/'.($totalPaymentGateways??0), 'icon'=>'fa-credit-card','bg'=>'bg-indigo'],
        ['label'=>'Ship Zones',        'val'=>$activeShippingZones??0,    'icon'=>'fa-globe',             'bg'=>'bg-dark'],
        ['label'=>'Blog Posts',        'val'=>$publishedBlogPosts??0,     'icon'=>'fa-blog',              'bg'=>'bg-teal'],
        ['label'=>'Sliders',           'val'=>($activeSliders??0).'/'.($totalSliders??0),'icon'=>'fa-images','bg'=>'bg-blue'],
    ];
    @endphp
    @foreach($allStats as $s)
    <div class="col-6 col-md-3 col-lg-2">
        <div class="card stat-card {{ $s['bg'] }} text-white p-2">
            <div class="d-flex align-items-center gap-2">
                <div class="s-icon" style="width:38px;height:38px;font-size:1rem;border-radius:9px;">
                    <i class="fas {{ $s['icon'] }}"></i>
                </div>
                <div>
                    <div class="s-label" style="font-size:0.6rem;">{{ $s['label'] }}</div>
                    <div style="font-size:1.1rem;font-weight:800;line-height:1.2;">{{ $s['val'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

</div>

{{-- ==========================================
     SCRIPTS
========================================== --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tooltipStyle = {
        backgroundColor: '#1e293b',
        titleColor: '#e2e8f0',
        bodyColor: '#cbd5e1',
        padding: 12,
        cornerRadius: 10,
        borderColor: 'rgba(255,255,255,0.05)',
        borderWidth: 1,
    };

    // 1. SALES LINE CHART
    const salesCtx = document.getElementById('salesLineChart');
    if (salesCtx) {
        new Chart(salesCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($chartLabels ?? []),
                datasets: [{
                    label: 'Revenue (Rs.)',
                    data: @json($revenueData ?? []),
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102,126,234,0.08)',
                    borderWidth: 2.5,
                    tension: 0.4, fill: true,
                    pointBackgroundColor: '#667eea',
                    pointRadius: 3, pointHoverRadius: 6,
                }, {
                    label: 'Orders',
                    data: @json($ordersData ?? []),
                    borderColor: '#f7971e',
                    backgroundColor: 'rgba(247,151,30,0.06)',
                    borderWidth: 2.5,
                    tension: 0.4, fill: true,
                    yAxisID: 'y1',
                    pointBackgroundColor: '#f7971e',
                    pointRadius: 3, pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { labels: { font: { size: 11 }, padding: 16 } }, tooltip: tooltipStyle },
                scales: {
                    x: { grid: { color: 'rgba(0,0,0,0.03)' }, ticks: { font: { size: 10 }, color: '#94a3b8', maxTicksLimit: 10 } },
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)' }, ticks: { font: { size: 10 }, color: '#94a3b8' } },
                    y1: { position: 'right', beginAtZero: true, grid: { drawOnChartArea: false }, ticks: { font: { size: 10 }, color: '#94a3b8' } }
                }
            }
        });
    }

    // 2. ORDER STATUS DONUT
    const donutCtx = document.getElementById('orderDonut');
    if (donutCtx) {
        new Chart(donutCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
                datasets: [{
                    data: [
                        {{ $pendingOrders ?? 0 }},
                        {{ $processingOrders ?? 0 }},
                        {{ $shippedOrders ?? 0 }},
                        {{ $deliveredOrders ?? 0 }},
                        {{ $cancelledOrders ?? 0 }}
                    ],
                    backgroundColor: ['#f7971e','#4facfe','#396afc','#43e97b','#ff416c'],
                    borderWidth: 0,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: tooltipStyle,
                }
            }
        });
    }

    // 3. MONTHLY REVENUE BAR
    const monthCtx = document.getElementById('monthlyBar');
    if (monthCtx) {
        new Chart(monthCtx.getContext('2d'), {
            type: 'bar',
            data: {
                // Naya - sahi
labels: @json($monthlyLabels ?? []),
                datasets: [{
                    label: 'Revenue (Rs.)',
                   // Naya - sahi
data: @json($monthlyRevenueData ?? []),
                    backgroundColor: 'rgba(102,126,234,0.75)',
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: tooltipStyle },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 10 }, color: '#94a3b8' } },
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)' }, ticks: { font: { size: 10 }, color: '#94a3b8' } }
                }
            }
        });
    }

    // 4. WEEK ORDERS BAR
    const weekCtx = document.getElementById('weekBar');
    if (weekCtx) {
        new Chart(weekCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
                datasets: [{
                    label: 'Orders',
                    data: @json($weekOrdersData ?? array_fill(0,7,0)),
                    backgroundColor: [
                        'rgba(247,151,30,0.8)','rgba(247,151,30,0.8)',
                        'rgba(247,151,30,0.8)','rgba(247,151,30,0.8)',
                        'rgba(247,151,30,0.8)','rgba(67,233,123,0.8)',
                        'rgba(67,233,123,0.8)'
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: tooltipStyle },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 10 }, color: '#94a3b8' } },
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)' }, ticks: { font: { size: 10 }, color: '#94a3b8' } }
                }
            }
        });
    }
});
</script>
@endpush