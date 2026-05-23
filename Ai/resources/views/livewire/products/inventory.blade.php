<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0"><i class="fas fa-warehouse me-2 text-primary"></i>Inventory</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #198754 !important;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">In Stock</p>
                        <h3 class="mb-0 fw-bold text-success">{{ number_format($inStock) }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-check-circle text-success fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #ffc107 !important;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Low Stock (≤10)</p>
                        <h3 class="mb-0 fw-bold text-warning">{{ number_format($lowStock) }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-exclamation-triangle text-warning fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #dc3545 !important;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Out of Stock</p>
                        <h3 class="mb-0 fw-bold text-danger">{{ number_format($outOfStock) }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-times-circle text-danger fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input wire:model.live.debounce.300ms="search" type="text"
                           class="form-control" placeholder="Search by name or SKU...">
                </div>
                <div class="col-md-3">
                    <select wire:model.live="filterCategory" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="filterStock" class="form-select">
                        <option value="">All Stock Levels</option>
                        <option value="in">In Stock (&gt;10)</option>
                        <option value="low">Low Stock (1–10)</option>
                        <option value="out">Out of Stock</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         width="40" height="40"
                                         class="rounded border object-fit-cover">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                         style="width:40px;height:40px">
                                        <i class="fas fa-image text-muted small"></i>
                                    </div>
                                @endif
                                <span class="fw-semibold">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td><code class="text-muted small">{{ $product->sku ?? '—' }}</code></td>
                        <td>{{ $product->category?->name ?? '—' }}</td>
                        <td>Rs. {{ number_format($product->price, 2) }}</td>
                        <td>
                            <span class="badge fs-6 {{ $product->stock > 10 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            @if($product->stock === 0)
                                <span class="badge bg-danger">Out of Stock</span>
                            @elseif($product->stock <= 10)
                                <span class="badge bg-warning">Low Stock</span>
                            @else
                                <span class="badge bg-success">In Stock</span>
                            @endif
                        </td>
                        <td>
                            <button wire:click="openStockEdit({{ $product->id }})"
                                    class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit me-1"></i> Update Stock
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-warehouse fs-2 d-block mb-2"></i>No products found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white">{{ $products->links() }}</div>
    </div>

    {{-- Stock Edit Modal --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5)">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Stock</h5>
                    <button wire:click="$set('showModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label fw-semibold">New Stock Quantity</label>
                    <input wire:model="editStock" type="number" min="0"
                           class="form-control @error('editStock') is-invalid @enderror">
                    @error('editStock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showModal', false)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="updateStock" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>