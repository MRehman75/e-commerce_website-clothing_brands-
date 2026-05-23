@extends('layouts.admin')

@section('title', 'All Products')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-database me-2"></i>All Products</span>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-compact mb-0">
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products ?? [] as $product)
                    <tr>
                        <td><input type="checkbox" class="product-checkbox" value="{{ $product->id }}"></td>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;">
                            @else
                                <i class="fas fa-image text-secondary"></i>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                {{ $product->stock }} in stock
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $product->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                            <button class="btn btn-outline-danger btn-sm" onclick="deleteProduct({{ $product->id }})">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">No products found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bulk Actions -->
<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex gap-2">
            <select id="bulkAction" class="form-select form-select-sm" style="width: 150px;">
                <option value="">Bulk Actions</option>
                <option value="delete">Delete Selected</option>
                <option value="active">Set Active</option>
                <option value="inactive">Set Inactive</option>
            </select>
            <button class="btn btn-sm btn-secondary" onclick="applyBulkAction()">Apply</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('selectAll')?.addEventListener('change', function() {
    document.querySelectorAll('.product-checkbox').forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

function applyBulkAction() {
    const action = document.getElementById('bulkAction').value;
    const selectedProducts = Array.from(document.querySelectorAll('.product-checkbox:checked')).map(cb => cb.value);
    
    if(!action || selectedProducts.length === 0) {
        alert('Please select an action and at least one product');
        return;
    }
    
    if(confirm(`Are you sure you want to ${action} ${selectedProducts.length} product(s)?`)) {
        fetch('{{ route("admin.products.bulk-action") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                action: action,
                products: selectedProducts
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload();
            }
        });
    }
}

function deleteProduct(id) {
    if(confirm('Are you sure you want to delete this product?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush