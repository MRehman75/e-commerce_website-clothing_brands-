<div>

    {{-- Stats Cards --}}
   <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Total Customers</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total'] }}</h3>
                </div>
                <i class="fas fa-users fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Active</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['active'] }}</h3>
                </div>
                <i class="fas fa-user-check fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Inactive</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['inactive'] }}</h3>
                </div>
                <i class="fas fa-user-clock fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #c94b4b 0%, #4b134f 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Blocked</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['blocked'] }}</h3>
                </div>
                <i class="fas fa-user-slash fa-2x text-white-50"></i>
            </div>
        </div>
    </div>
</div>

    {{-- Toolbar --}}
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
        <div class="d-flex gap-2 flex-wrap">
            <input wire:model.live.debounce.300ms="search"
                   type="text" placeholder="Search name, email, phone..."
                   class="form-control" style="width:250px" />

            <div class="dropdown">
    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="fas fa-filter me-1"></i>
        {{ $filterStatus ? ucfirst($filterStatus) : 'All Status' }}
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" wire:click="$set('filterStatus', '')"><i class="fas fa-list me-2 text-secondary"></i>All Status</a></li>
        <li><a class="dropdown-item text-success" wire:click="$set('filterStatus', 'active')"><i class="fas fa-user-check me-2"></i>Active</a></li>
        <li><a class="dropdown-item text-warning" wire:click="$set('filterStatus', 'inactive')"><i class="fas fa-user-clock me-2"></i>Inactive</a></li>
        <li><a class="dropdown-item text-danger" wire:click="$set('filterStatus', 'blocked')"><i class="fas fa-user-slash me-2"></i>Blocked</a></li>
    </ul>
</div>

            <select wire:model.live="perPage" class="form-select w-auto">
                <option value="10">10 / page</option>
                <option value="25">25 / page</option>
                <option value="50">50 / page</option>
            </select>
        </div>
        <button wire:click="openCreate" class="btn btn-primary">
            <i class="fas fa-user-plus me-1"></i> Add Customer
        </button>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th wire:click="sortBy('name')" style="cursor:pointer">
                                Name
                                @if($sortBy === 'name')
                                    <i class="fas fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('email')" style="cursor:pointer">
                                Email
                                @if($sortBy === 'email')
                                    <i class="fas fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th>Phone</th>
                            <th>City</th>
                            <th wire:click="sortBy('total_orders')" style="cursor:pointer">
                                Orders
                                @if($sortBy === 'total_orders')
                                    <i class="fas fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('total_spent')" style="cursor:pointer">
                                Spent
                                @if($sortBy === 'total_spent')
                                    <i class="fas fa-sort-{{ $sortDir === 'asc' ? 'up' : 'down' }}"></i>
                                @endif
                            </th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                         style="width:34px;height:34px;font-size:13px;flex-shrink:0">
                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-medium">{{ $customer->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? '—' }}</td>
                            <td>{{ $customer->city ?? '—' }}</td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $customer->total_orders }}
                                </span>
                            </td>
                            <td>Rs. {{ number_format($customer->total_spent, 2) }}</td>
                            <td>
    <div class="dropdown">
        <span class="badge bg-{{ $customer->status_badge }} dropdown-toggle"
              style="cursor:pointer"
              data-bs-toggle="dropdown">
            <i class="fas fa-{{ $customer->status == 'active' ? 'user-check' : ($customer->status == 'inactive' ? 'user-clock' : 'user-slash') }} me-1"></i>
            {{ ucfirst($customer->status) }}
        </span>
        <ul class="dropdown-menu dropdown-menu-sm">
            <li><a class="dropdown-item text-success" wire:click="updateStatus({{ $customer->id }}, 'active')"><i class="fas fa-user-check me-2"></i>Active</a></li>
            <li><a class="dropdown-item text-warning" wire:click="updateStatus({{ $customer->id }}, 'inactive')"><i class="fas fa-user-clock me-2"></i>Inactive</a></li>
            <li><a class="dropdown-item text-danger" wire:click="updateStatus({{ $customer->id }}, 'blocked')"><i class="fas fa-user-slash me-2"></i>Blocked</a></li>
        </ul>
    </div>
</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button wire:click="openView({{ $customer->id }})"
                                            class="btn btn-sm btn-light" title="View">
                                        <i class="fas fa-eye text-info"></i>
                                    </button>
                                    <button wire:click="openEdit({{ $customer->id }})"
                                            class="btn btn-sm btn-light" title="Edit">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $customer->id }})"
                                            class="btn btn-sm btn-light" title="Delete">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <i class="fas fa-users fa-2x mb-2 d-block opacity-25"></i>
                                No customers found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $customers->links() }}</div>

    {{-- ============ CREATE / EDIT MODAL ============ --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-user me-2"></i>
                        {{ $editingId ? 'Edit Customer' : 'Add New Customer' }}
                    </h5>
                    <button wire:click="$set('showModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Full Name <span class="text-danger">*</span></label>
                            <input wire:model="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Ahmed Ali">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                            <input wire:model="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="ahmed@example.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Phone</label>
                            <input wire:model="phone" type="text"
                                   class="form-control"
                                   placeholder="+92 300 1234567">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">City</label>
                            <input wire:model="city" type="text"
                                   class="form-control"
                                   placeholder="Lahore">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-medium">Address</label>
                            <input wire:model="address" type="text"
                                   class="form-control"
                                   placeholder="Street, Area">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Status</label>
                            <select wire:model="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="blocked">Blocked</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showModal', false)" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button wire:click="save" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Customer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ============ VIEW MODAL ============ --}}
    @if($showViewModal && $viewingCustomer)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Details</h5>
                    <button wire:click="$set('showViewModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-2"
                             style="width:60px;height:60px;font-size:24px">
                            {{ strtoupper(substr($viewingCustomer->name, 0, 1)) }}
                        </div>
                        <h5 class="mb-0">{{ $viewingCustomer->name }}</h5>
                        <span class="badge bg-{{ $viewingCustomer->status_badge }}">
                            {{ ucfirst($viewingCustomer->status) }}
                        </span>
                    </div>
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="text-muted fw-medium" width="40%"><i class="fas fa-envelope me-2"></i>Email</td>
                            <td>{{ $viewingCustomer->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium"><i class="fas fa-phone me-2"></i>Phone</td>
                            <td>{{ $viewingCustomer->phone ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium"><i class="fas fa-city me-2"></i>City</td>
                            <td>{{ $viewingCustomer->city ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium"><i class="fas fa-map-marker-alt me-2"></i>Address</td>
                            <td>{{ $viewingCustomer->address ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium"><i class="fas fa-shopping-bag me-2"></i>Total Orders</td>
                            <td>{{ $viewingCustomer->total_orders }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium"><i class="fas fa-wallet me-2"></i>Total Spent</td>
                            <td>Rs. {{ number_format($viewingCustomer->total_spent, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium"><i class="fas fa-calendar me-2"></i>Last Order</td>
                            <td>{{ $viewingCustomer->last_order_at?->format('d M Y') ?? '—' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-medium"><i class="fas fa-clock me-2"></i>Joined</td>
                            <td>{{ $viewingCustomer->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showViewModal', false)" class="btn btn-secondary">Close</button>
                    <button wire:click="openEdit({{ $viewingCustomer->id }}); $set('showViewModal', false)"
                            class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ============ DELETE CONFIRM ============ --}}
    @if($confirmingDeleteId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3 d-block"></i>
                    <h6>Delete this customer?</h6>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button wire:click="$set('confirmingDeleteId', null)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="delete" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>