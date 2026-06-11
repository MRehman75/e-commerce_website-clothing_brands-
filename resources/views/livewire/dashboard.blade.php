<div>

    <!-- 1. MAIN STATS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Orders</h6>
                        <h2 class="text-white">{{ $totalOrders }}</h2>
                        <small class="text-white-50">All time orders</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-shopping-cart fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Revenue</h6>
                        <h2 class="text-white">Rs. {{ number_format($totalRevenue, 2) }}</h2>
                        <small class="text-white-50">All vendors combined</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-money-bill-wave fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Active Orders</h6>
                        <h2 class="text-white">{{ $activeOrders }}</h2>
                        <small class="text-white-50">Pending + Processing + Shipped</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-fire fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Delivered Orders</h6>
                        <h2 class="text-white">{{ $deliveredOrders }}</h2>
                        <small class="text-white-50">Completed successfully</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-check-circle fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. ORDER STATUS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Pending Orders</h6>
                        <h2 class="text-white">{{ $pendingOrders }}</h2>
                        <small class="text-white-50">Awaiting confirmation</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-clock fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Processing Orders</h6>
                        <h2 class="text-white">{{ $processingOrders }}</h2>
                        <small class="text-white-50">Being prepared</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-spinner fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #396afc 0%, #2948ff 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Shipped Orders</h6>
                        <h2 class="text-white">{{ $shippedOrders }}</h2>
                        <small class="text-white-50">In transit</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-truck fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Cancelled Orders</h6>
                        <h2 class="text-white">{{ $cancelledOrders }}</h2>
                        <small class="text-white-50">Order cancelled</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-ban fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. CUSTOMERS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Customers</h6>
                        <h2 class="text-white">{{ $totalCustomers }}</h2>
                        <small class="text-white-50">Registered users</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">New Customers</h6>
                        <h2 class="text-white">{{ $newCustomersThisMonth }}</h2>
                        <small class="text-white-50">Joined this month</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-user-plus fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Users</h6>
                        <h2 class="text-white">{{ $totalUsers }}</h2>
                        <small class="text-white-50">All registered users</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-user fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Verified Users</h6>
                        <h2 class="text-white">{{ $verifiedUsers }}</h2>
                        <small class="text-white-50">Email verified</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-user-check fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. SALES & PROMOTIONS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Coupons</h6>
                        <h2 class="text-white">{{ $totalCoupons }}</h2>
                        <small class="text-white-50">All coupons</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-tag fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Active Coupons</h6>
                        <h2 class="text-white">{{ $activeCoupons }}</h2>
                        <small class="text-white-50">Currently active</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-ticket-alt fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Flash Sales</h6>
                        <h2 class="text-white">{{ $totalFlashSales }}</h2>
                        <small class="text-white-50">All flash sales</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-bolt fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Active Flash Sales</h6>
                        <h2 class="text-white">{{ $activeFlashSales }}</h2>
                        <small class="text-white-50">Currently running</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-fire fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. PRODUCTS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Products</h6>
                        <h2 class="text-white">{{ $totalProducts }}</h2>
                        <small class="text-white-50">All products</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-box fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #396afc 0%, #2948ff 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Active Products</h6>
                        <h2 class="text-white">{{ $activeProducts }}</h2>
                        <small class="text-white-50">Currently active</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-boxes fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f953c6 0%, #b91d73 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Categories</h6>
                        <h2 class="text-white">{{ $totalCategories }}</h2>
                        <small class="text-white-50">All categories</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-tags fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Brands</h6>
                        <h2 class="text-white">{{ $totalBrands }}</h2>
                        <small class="text-white-50">All brands</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-trademark fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. PAYMENTS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Transactions</h6>
                        <h2 class="text-white">{{ $totalTransactions }}</h2>
                        <small class="text-white-50">All transactions</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-exchange-alt fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Completed Transactions</h6>
                        <h2 class="text-white">{{ $completedTransactions }}</h2>
                        <small class="text-white-50">Successfully completed</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-check-double fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Payment Methods</h6>
                        <h2 class="text-white">{{ $totalPaymentMethods }}</h2>
                        <small class="text-white-50">All methods</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-credit-card fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Active Payment Methods</h6>
                        <h2 class="text-white">{{ $activePaymentMethods }}</h2>
                        <small class="text-white-50">Currently active</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-wallet fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. SHIPPING CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Shipping Zones</h6>
                        <h2 class="text-white">{{ $totalShippingZones }}</h2>
                        <small class="text-white-50">All zones</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-globe fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Active Shipping Zones</h6>
                        <h2 class="text-white">{{ $activeShippingZones }}</h2>
                        <small class="text-white-50">Currently active</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-map-marked-alt fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Shipping Methods</h6>
                        <h2 class="text-white">{{ $totalShippingMethods }}</h2>
                        <small class="text-white-50">All methods</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-truck fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Active Shipping Methods</h6>
                        <h2 class="text-white">{{ $activeShippingMethods }}</h2>
                        <small class="text-white-50">Currently active</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-shipping-fast fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 8. REPORTS CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Sales Revenue</h6>
                        <h2 class="text-white">Rs. {{ number_format($totalSalesRevenue, 2) }}</h2>
                        <small class="text-white-50">Paid orders only</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-chart-line fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Monthly Sales</h6>
                        <h2 class="text-white">Rs. {{ number_format($monthlySales, 2) }}</h2>
                        <small class="text-white-50">This month</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-calendar-alt fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Amount Sold</h6>
                        <h2 class="text-white">Rs. {{ number_format($totalProductsSold, 2) }}</h2>
                        <small class="text-white-50">All orders combined</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-receipt fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Low Stock Products</h6>
                        <h2 class="text-white">{{ $lowStockProducts }}</h2>
                        <small class="text-white-50">Stock less than 10</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-exclamation-triangle fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 9. USER MANAGEMENT CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Users</h6>
                        <h2 class="text-white">{{ $totalUsers }}</h2>
                        <small class="text-white-50">All registered users</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Verified Users</h6>
                        <h2 class="text-white">{{ $verifiedUsers }}</h2>
                        <small class="text-white-50">Email verified</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-user-check fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Unverified Users</h6>
                        <h2 class="text-white">{{ $unverifiedUsers }}</h2>
                        <small class="text-white-50">Email not verified</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-user-times fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">New Users This Month</h6>
                        <h2 class="text-white">{{ $newUsersThisMonth }}</h2>
                        <small class="text-white-50">Joined this month</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-user-plus fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 10. WEBSITE CONTENT CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Home Sliders</h6>
                        <h2 class="text-white">{{ $activeSliders }}/{{ $totalSliders }}</h2>
                        <small class="text-white-50">Active / Total</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-images fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Pages</h6>
                        <h2 class="text-white">{{ $activePages }}/{{ $totalPages }}</h2>
                        <small class="text-white-50">Active / Total</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-file-alt fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Banners</h6>
                        <h2 class="text-white">{{ $activeBanners }}/{{ $totalBanners }}</h2>
                        <small class="text-white-50">Active / Total</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-ad fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Menus</h6>
                        <h2 class="text-white">{{ $totalMenus }}</h2>
                        <small class="text-white-50">Total menus</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-bars fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 11. BLOG CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Blog Posts</h6>
                        <h2 class="text-white">{{ $totalBlogPosts }}</h2>
                        <small class="text-white-50">All posts</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-blog fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Published Posts</h6>
                        <h2 class="text-white">{{ $publishedBlogPosts }}</h2>
                        <small class="text-white-50">Live posts</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-rss fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Payment Gateways</h6>
                        <h2 class="text-white">{{ $activePaymentGateways }}/{{ $totalPaymentGateways }}</h2>
                        <small class="text-white-50">Active / Total</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-credit-card fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0 text-white" style="background: {{ $maintenanceMode ? 'linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%)' : 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)' }};">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Maintenance Mode</h6>
                        <h2 class="text-white">{{ $maintenanceMode ? 'ON' : 'OFF' }}</h2>
                        <small class="text-white-50">{{ $maintenanceMode ? 'Site is down' : 'Site is live' }}</small>
                    </div>
                    <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-tools fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 12. SETTINGS CARDS -->
   <div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Site Name</h6>
                    <h2 class="text-white" style="font-size: 1.5rem;">{{ Str::limit($generalSettings->site_name ?? 'N/A', 10) }}</h2>
                    <small class="text-white-50">{{ $generalSettings->site_email ?? 'No email' }}</small>
                </div>
                <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                    <i class="fas fa-cog fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Currency</h6>
                    <h2 class="text-white" style="font-size: 1.5rem;">{{ $generalSettings->currency_symbol ?? 'Rs.' }}</h2>
                    <small class="text-white-50">{{ $generalSettings->currency_code ?? 'PKR' }}</small>
                </div>
                <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                    <i class="fas fa-money-bill-wave fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
   <div class="col-md-3">
    <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="text-white-50">Site Phone</h6>
                <h2 class="text-white" style="font-size: 1.5rem;">{{ Str::limit($generalSettings->site_phone ?? 'N/A', 12) }}</h2>
                <small class="text-white-50">Contact number</small>
            </div>
            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                <i class="fas fa-phone fa-2x text-white"></i>
            </div>
        </div>
    </div>
</div>
    <div class="col-md-3">
        <div class="card p-3 shadow-sm border-0 text-white" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Maintenance Mode</h6>
                    <h2 class="text-white" style="font-size: 1.5rem;">{{ $maintenanceMode ? 'ON' : 'OFF' }}</h2>
                    <small class="text-white-50">{{ $maintenanceMode ? 'Site is down' : 'Site is live' }}</small>
                </div>
                <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                    <i class="fas fa-tools fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- 13. SALES CHART -->
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

    <!-- 14. RECENT ORDERS TABLE -->
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
                        <td><strong>Rs. {{ number_format($order->total, 2) }}</strong></td>
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
                        label: 'Revenue (Rs.)',
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
                            text: 'Revenue (Rs.)'
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