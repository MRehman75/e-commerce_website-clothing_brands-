<div>
    {{-- Header --}}
    <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 text-white"><i class="fas fa-users me-2"></i>All Users</h4>
                <small class="text-white-50">Manage system users</small>
            </div>
            <button wire:click="openCreate" class="btn btn-light btn-sm">
                <i class="fas fa-user-plus me-1"></i> Add User
            </button>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Total Users</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['total'] }}</h3>
                    </div>
                    <i class="fas fa-users fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #f46b45 0%, #eea849 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">Admins</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['admins'] }}</h3>
                    </div>
                    <i class="fas fa-user-shield fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 text-white p-3" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-1" style="font-size:0.75rem;">New (7 days)</h6>
                        <h3 class="mb-0 fw-bold">{{ $stats['recent'] }}</h3>
                    </div>
                    <i class="fas fa-user-plus fa-2x text-white-50"></i>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Filters --}}
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" wire:model.live.debounce.300ms="search"
                           class="form-control form-control-sm" placeholder="Search by name or email...">
                </div>
                <div class="col-md-3">
                    <select wire:model.live="filterRole" class="form-select form-select-sm">
                        <option value="">All Roles</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select wire:model.live="perPage" class="form-select form-select-sm">
                        <option value="10">10 / page</option>
                        <option value="25">25 / page</option>
                        <option value="50">50 / page</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:0.82rem;">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center"
                                         style="width:32px;height:32px;font-size:12px;font-weight:600;background:linear-gradient(135deg,#667eea,#764ba2);flex-shrink:0;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-medium">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button wire:click="openEdit({{ $user->id }})"
                                            class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $user->id }})"
                                            class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-users fa-2x mb-2 d-block"></i>
                                No users found!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">{{ $users->links() }}</div>
        </div>
    </div>

    {{-- Create/Edit Modal --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-user me-2"></i>
                        {{ $editingId ? 'Edit User' : 'Add New User' }}
                    </h5>
                    <button wire:click="$set('showModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Name *</label>
                        <input wire:model="name" type="text"
                               class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Email *</label>
                        <input wire:model="email" type="email"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @if(!$editingId)
                    <div class="mb-3">
                        <label class="form-label fw-medium">Password *</label>
                        <input wire:model="password" type="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label fw-medium">Role</label>
                        <select wire:model="role_id" class="form-select">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showModal', false)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="save" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Delete Confirm --}}
    @if($confirmingDeleteId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3 d-block"></i>
                    <h6>Delete this user?</h6>
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