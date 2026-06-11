<div>
    {{-- Header --}}
    <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 text-white"><i class="fas fa-shield-alt me-2"></i>Roles & Permissions</h4>
                <small class="text-white-50">Manage roles and permissions</small>
            </div>
            <div class="d-flex gap-2">
                <button wire:click="openCreateRole" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Add Role
                </button>
                <button wire:click="openCreatePerm" class="btn btn-light btn-sm">
                    <i class="fas fa-key me-1"></i> Add Permission
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row g-4">
        {{-- Roles --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="fas fa-user-tag me-2 text-primary"></i>Roles</h6>
                    <span class="badge bg-primary">{{ $roles->count() }}</span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0" style="font-size:0.82rem;">
                        <thead class="table-dark">
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr>
                                <td>
                                    <strong>{{ $role->name }}</strong><br>
                                    <small class="text-muted">{{ $role->slug }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $role->permissions_count }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button wire:click="openEditRole({{ $role->id }})"
                                                class="btn btn-sm btn-warning text-white" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $role->id }})"
                                                class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">No roles found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Permissions --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="fas fa-key me-2 text-warning"></i>Permissions</h6>
                    <span class="badge bg-warning">{{ $permissions->flatten()->count() }}</span>
                </div>
                <div class="card-body">
                    @foreach($permissions as $module => $perms)
                    <div class="mb-3">
                        <h6 class="text-muted small fw-bold text-uppercase mb-2">
                            <i class="fas fa-folder me-1"></i>{{ $module }}
                        </h6>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($perms as $perm)
                            <span class="badge bg-light text-dark border">
                                <i class="fas fa-lock me-1 text-warning"></i>{{ $perm->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Role Modal --}}
    @if($showRoleModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-user-tag me-2"></i>
                        {{ $editingRoleId ? 'Edit Role' : 'Add New Role' }}
                    </h5>
                    <button wire:click="$set('showRoleModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Role Name *</label>
                            <input wire:model="roleName" type="text"
                                   class="form-control @error('roleName') is-invalid @enderror"
                                   placeholder="e.g. Admin">
                            @error('roleName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Slug *</label>
                            <input wire:model="roleSlug" type="text"
                                   class="form-control @error('roleSlug') is-invalid @enderror"
                                   placeholder="e.g. admin">
                            @error('roleSlug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-medium">Description</label>
                            <input wire:model="roleDescription" type="text" class="form-control">
                        </div>
                    </div>

                    <label class="form-label fw-medium">Permissions</label>
                    @foreach($permissions as $module => $perms)
                    <div class="mb-3">
                        <h6 class="text-muted small fw-bold text-uppercase">{{ $module }}</h6>
                        <div class="row g-2">
                            @foreach($perms as $perm)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           wire:model="selectedPermissions"
                                           value="{{ $perm->id }}"
                                           id="perm_{{ $perm->id }}">
                                    <label class="form-check-label small" for="perm_{{ $perm->id }}">
                                        {{ $perm->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showRoleModal', false)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="saveRole" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Role
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Permission Modal --}}
    @if($showPermModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title"><i class="fas fa-key me-2"></i>Add Permission</h5>
                    <button wire:click="$set('showPermModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Permission Name *</label>
                        <input wire:model="permName" type="text"
                               class="form-control @error('permName') is-invalid @enderror"
                               placeholder="e.g. View Orders">
                        @error('permName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Slug *</label>
                        <input wire:model="permSlug" type="text"
                               class="form-control @error('permSlug') is-invalid @enderror"
                               placeholder="e.g. view-orders">
                        @error('permSlug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Module *</label>
                        <input wire:model="permModule" type="text"
                               class="form-control @error('permModule') is-invalid @enderror"
                               placeholder="e.g. Orders">
                        @error('permModule') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Description</label>
                        <input wire:model="permDescription" type="text" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showPermModal', false)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="savePerm" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i> Save Permission
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
                    <h6>Delete this role?</h6>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0"><button wire:click="deleteRole" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                    <button wire:click="$set('confirmingDeleteId', null)" class="btn btn-secondary btn-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>