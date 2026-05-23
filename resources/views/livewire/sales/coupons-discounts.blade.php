<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="fas fa-ticket-alt me-2 text-primary"></i>Coupons & Discounts</h5>
        <button class="btn btn-primary btn-sm" wire:click="openModal">
            <i class="fas fa-plus me-1"></i> Add Coupon
        </button>
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
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted mb-1" style="font-size:0.75rem;">Total Coupons</h6>
                <h4 class="mb-0 text-dark">{{ $total }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted mb-1" style="font-size:0.75rem;">Active Coupons</h6>
                <h4 class="mb-0 text-success">{{ $active }}</h4>
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
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item small" wire:click.prevent="editCoupon({{ $coupon->id }})"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item small" wire:click.prevent="toggleStatus({{ $coupon->id }})"><i class="fas fa-toggle-on me-2"></i>Toggle Status</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item small text-danger" wire:click.prevent="deleteCoupon({{ $coupon->id }})"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                        </ul>
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