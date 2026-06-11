<div>
    {{-- Header --}}
    <div class="card border-0 text-white p-3 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 text-white"><i class="fas fa-user-plus me-2"></i>Add New User</h4>
                <small class="text-white-50">Naya user create karein</small>
            </div>
            <a href="{{ route('admin.users.all') }}" wire:navigate class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @if($success)
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>User successfully ban gaya!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-user me-2 text-primary"></i>User Information</h6>
                </div>
                <div class="card-body">
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
                            <label class="form-label fw-medium">Password <span class="text-danger">*</span></label>
                            <input wire:model="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Min 8 characters">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Confirm Password <span class="text-danger">*</span></label>
                            <input wire:model="password_confirmation" type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   placeholder="Repeat password">
                            @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Role</label>
                            <select wire:model="role_id" class="form-select">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button wire:click="save" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Save User
                        </button>
                        <a href="{{ route('admin.users.all') }}" wire:navigate class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>