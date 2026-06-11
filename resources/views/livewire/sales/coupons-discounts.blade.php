<div>
   <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0 text-white"><i class="fas fa-ticket-alt me-2"></i>Coupons & Discounts</h4>
            <small class="text-white-50">Manage your coupons</small>
        </div>
        <button class="btn btn-light btn-sm" wire:click="openModal">
            <i class="fas fa-plus me-1"></i> Add Coupon
        </button>
    </div>
</div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats -->
   <div class="row g-3 mb-3">
    <div class="col-md-3">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Total Coupons</h6>
                    <h3 class="mb-0 fw-bold">{{ $total }}</h3>
                </div>
                <i class="fas fa-ticket-alt fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Active Coupons</h6>
                    <h3 class="mb-0 fw-bold">{{ $active }}</h3>
                </div>
                <i class="fas fa-check-circle fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
</div>
    <!-- Search -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" class="form-control form-control-sm"
                        placeholder="Search by coupon code..."
                        wire:model.live="search">
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size: 0.82rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Value</th>
                            <th>Usage</th>
                            <th>Expiry</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coupons as $coupon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $coupon->code }}</strong></td>
                                <td>
                                    <span class="badge bg-{{ $coupon->type == 'percentage' ? 'info' : 'primary' }}">
                                        {{ ucfirst($coupon->type) }}
                                    </span>
                                </td>
                                <td>
                                    @if($coupon->type == 'percentage')
                                        {{ $coupon->value }}%
                                    @else
                                        ${{ number_format($coupon->value, 2) }}
                                    @endif
                                </td>
                                <td>{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}</td>
                                <td>{{ $coupon->end_date?->format('d M Y') ?? 'No Expiry' }}</td>
                                <td>
                                    <span class="badge bg-{{ $coupon->status_color }}">
                                        {{ ucfirst($coupon->status) }}
                                    </span>
                                </td>
                               <td>
    <div class="btn-group">
        <button wire:click="editCoupon({{ $coupon->id }})"
                class="btn btn-sm btn-warning text-white" title="Edit">
            <i class="fas fa-edit"></i>
        </button>
        <button wire:click="toggleStatus({{ $coupon->id }})"
                class="btn btn-sm btn-info text-white" title="Toggle Status">
            <i class="fas fa-toggle-on"></i>
        </button>
        <button wire:click="deleteCoupon({{ $coupon->id }})"
                class="btn btn-sm btn-danger" title="Delete"
                onclick="return confirm('Delete karna chahte ho?')">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-ticket-alt fa-2x mb-2 d-block"></i>
                                    No coupons found!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $coupons->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editId ? 'Edit Coupon' : 'Add New Coupon' }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Coupon Code *</label>
                            <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                wire:model="code" placeholder="e.g. SAVE20">
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Type *</label>
                            <select class="form-select form-select-sm" wire:model="type">
                                <option value="percentage">Percentage (%)</option>
                                <option value="fixed">Fixed ($)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Value *</label>
                            <input type="number" class="form-control form-control-sm @error('value') is-invalid @enderror"
                                wire:model="value" placeholder="e.g. 20">
                            @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Min Order Amount</label>
                            <input type="number" class="form-control form-control-sm"
                                wire:model="min_order_amount" placeholder="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Max Discount</label>
                            <input type="number" class="form-control form-control-sm"
                                wire:model="max_discount" placeholder="Optional">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Usage Limit</label>
                            <input type="number" class="form-control form-control-sm"
                                wire:model="usage_limit" placeholder="Unlimited">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control form-control-sm" wire:model="start_date">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control form-control-sm" wire:model="end_date">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select form-select-sm" wire:model="is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control form-control-sm" wire:model="description" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="$set('showModal', false)">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm" wire:click="saveCoupon">
                        {{ $editId ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>