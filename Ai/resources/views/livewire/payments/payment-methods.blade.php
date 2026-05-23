<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="fas fa-wallet me-2 text-success"></i>Payment Methods</h5>
        <button class="btn btn-primary btn-sm" wire:click="openModal">
            <i class="fas fa-plus me-1"></i> Add Method
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
                <h6 class="text-muted mb-1" style="font-size:0.75rem;">Total Methods</h6>
                <h4 class="mb-0 text-dark">{{ $total }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="text-muted mb-1" style="font-size:0.75rem;">Active Methods</h6>
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
                        placeholder="Search by name..."
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
                            <th>Name</th>
                            <th>Code</th>
                            <th>Icon</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($methods as $method)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $method->name }}</strong></td>
                                <td><code>{{ $method->code }}</code></td>
                                <td>
                                    @if($method->icon)
                                        <i class="{{ $method->icon }}"></i> {{ $method->icon }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $method->sort_order }}</td>
                                <td>
                                    <span class="badge bg-{{ $method->is_active ? 'success' : 'danger' }}">
                                        {{ $method->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item small" wire:click.prevent="editMethod({{ $method->id }})"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item small" wire:click.prevent="toggleStatus({{ $method->id }})"><i class="fas fa-toggle-on me-2"></i>Toggle Status</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item small text-danger" wire:click.prevent="deleteMethod({{ $method->id }})"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-wallet fa-2x mb-2 d-block"></i>
                                    No payment methods found!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $methods->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $editId ? 'Edit Payment Method' : 'Add Payment Method' }}</h5>
                    <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name *</label>
                            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                                wire:model="name" placeholder="e.g. Credit Card">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Code *</label>
                            <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                                wire:model="code" placeholder="e.g. credit_card">
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Icon (Font Awesome)</label>
                            <input type="text" class="form-control form-control-sm"
                                wire:model="icon" placeholder="e.g. fas fa-credit-card">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" class="form-control form-control-sm" wire:model="sort_order">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select form-select-sm" wire:model="is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        {{-- CKEditor Description --}}
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <div wire:ignore>
                                <textarea id="paymethod-ckeditor"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="$set('showModal', false)">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm" wire:click="saveMethod">
                        {{ $editId ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== CKEditor 4 - FREE VERSION ===== --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        function initPayMethodCKEditor(content = '') {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(() => initPayMethodCKEditor(content), 300);
                return;
            }

            const el = document.getElementById('paymethod-ckeditor');
            if (!el) return;

            if (CKEDITOR.instances['paymethod-ckeditor']) {
                CKEDITOR.instances['paymethod-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('paymethod-ckeditor', {
                height: 150,
                versionCheck: false,
                toolbarGroups: [
                    { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                    { name: 'paragraph',   groups: ['list', 'indent', 'blocks', 'align'] },
                    { name: 'links' },
                    { name: 'colors' },
                ],
            });

            CKEDITOR.instances['paymethod-ckeditor'].on('instanceReady', function () {
                if (content) {
                    CKEDITOR.instances['paymethod-ckeditor'].setData(content);
                }
            });

            CKEDITOR.instances['paymethod-ckeditor'].on('change', function () {
                @this.set('description', CKEDITOR.instances['paymethod-ckeditor'].getData());
            });
        }

        document.addEventListener('livewire:initialized', function () {
            Livewire.on('payMethodModalOpened', function (data) {
                const content = data && data.content ? data.content : '';
                setTimeout(() => initPayMethodCKEditor(content), 300);
            });
        });
    </script>
</div>