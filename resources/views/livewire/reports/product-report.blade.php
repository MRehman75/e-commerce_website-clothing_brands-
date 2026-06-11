<div>
    {{-- Header --}}
    <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 text-white"><i class="fas fa-box-open me-2"></i>Product Report</h4>
                <small class="text-white-50">Products ki performance ka overview</small>
            </div>
            <i class="fas fa-chart-bar fa-2x text-white-50"></i>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Total Products</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_products'] }}</h3>
                    </div>
                    <i class="fas fa-box fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Active</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['active_products'] }}</h3>
                    </div>
                    <i class="fas fa-check-circle fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #c94b4b 0%, #4b134f 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Out of Stock</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['out_of_stock'] }}</h3>
                    </div>
                    <i class="fas fa-times-circle fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Low Stock</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['low_stock'] }}</h3>
                    </div>
                    <i class="fas fa-exclamation-triangle fa-2x text-white-50"></i>
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
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.7rem;">Total Sold</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_sold'] }}</h3>
                    </div>
                    <i class="fas fa-shopping-bag fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body py-2">
            <div class="row g-2">
                <div class="col-md-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-tags me-1"></i>
                            {{ $filterCategory ? $categories->find($filterCategory)?->name : 'All Categories' }}
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li><a class="dropdown-item" wire:click="$set('filterCategory', '')"><i class="fas fa-list me-2"></i>All Categories</a></li>
                            @foreach($categories as $cat)
                            <li><a class="dropdown-item" wire:click="$set('filterCategory', '{{ $cat->id }}')"><i class="fas fa-tag me-2 text-primary"></i>{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-trademark me-1"></i>
                            {{ $filterBrand ? $brands->find($filterBrand)?->name : 'All Brands' }}
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li><a class="dropdown-item" wire:click="$set('filterBrand', '')"><i class="fas fa-list me-2"></i>All Brands</a></li>
                            @foreach($brands as $brand)
                            <li><a class="dropdown-item" wire:click="$set('filterBrand', '{{ $brand->id }}')"><i class="fas fa-trademark me-2 text-primary"></i>{{ $brand->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Products Table --}}
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0"><i class="fas fa-list me-2"></i>Products Performance</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:0.82rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Total Sold</th>
                            <th>Revenue</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         width="35" height="35" class="rounded border object-fit-cover">
                                    @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                         style="width:35px;height:35px;">
                                        <i class="fas fa-image text-muted small"></i>
                                    </div>
                                    @endif
                                    <strong>{{ $product->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $product->category?->name ?? '—' }}</td>
                            <td>{{ $product->brand?->name ?? '—' }}</td>
                            <td>Rs. {{ number_format($product->price, 2) }}</td>
                            <td>
                                <span class="badge fs-6 {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $product->order_items_sum_quantity ?? 0 }}</span>
                            </td>
                            <td>
                                <strong>Rs. {{ number_format(($product->order_items_sum_quantity ?? 0) * $product->price, 2) }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-{{ $product->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                                No products found!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>