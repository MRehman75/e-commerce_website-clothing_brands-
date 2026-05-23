<div>
    {{-- ── Header ── --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-credit-card me-2 text-primary"></i> Payment Gateways
        </h4>
        <button wire:click="openCreate" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Gateway
        </button>
    </div>

    {{-- ── Flash Message ── --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ── Filters ── --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body py-2">
            <div class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input wire:model.live.debounce.300ms="search"
                               type="text" class="form-control"
                               placeholder="Search gateway name or slug...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="filterStatus" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <span class="badge bg-secondary">
                        {{ $this->gateways->count() }} gateway(s)
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Gateway Cards ── --}}
    @if($this->gateways->isEmpty())
        <div class="text-center text-muted py-5">
            <i class="fas fa-credit-card fa-3x d-block mb-3 opacity-25"></i>
            <p>No payment gateways found.</p>
            <button wire:click="openCreate" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Add First Gateway
            </button>
        </div>
    @else
    <div class="row g-4">
        @foreach($this->gateways as $gw)
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100 border-0"
                 style="border-left: 4px solid {{ $gw->is_active ? '#198754' : '#6c757d' }} !important;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3" style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;background:#f8f9fa;border-radius:10px;overflow:hidden;">
                            @if($gw->logo)
                                <img src="{{ asset('storage/'.$gw->logo) }}"
                                     style="max-width:44px;max-height:44px;object-fit:contain">
                            @else
                                @php
                                    $iconMap = [
                                        'jazzcash'     => ['icon'=>'fa-wallet',     'color'=>'text-warning'],
                                        'easypaisa'    => ['icon'=>'fa-mobile-alt', 'color'=>'text-success'],
                                        'stripe'       => ['icon'=>'fa-stripe-s',   'color'=>'text-primary'],
                                        'paypal'       => ['icon'=>'fa-paypal',      'color'=>'text-info'],
                                        'cod'          => ['icon'=>'fa-money-bill',  'color'=>'text-success'],
                                        'bank_transfer'=> ['icon'=>'fa-university', 'color'=>'text-secondary'],
                                    ];
                                    $ic = $iconMap[$gw->slug] ?? ['icon'=>'fa-credit-card','color'=>'text-muted'];
                                @endphp
                                <i class="fas {{ $ic['icon'] }} {{ $ic['color'] }} fs-4"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">{{ $gw->name }}</h6>
                            <code class="text-muted" style="font-size:11px">{{ $gw->slug }}</code>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input type="checkbox" class="form-check-input" role="switch"
                                   {{ $gw->is_active ? 'checked' : '' }}
                                   wire:click="toggleActive({{ $gw->id }})"
                                   style="cursor:pointer">
                        </div>
                    </div>
                    @if($gw->description)
                        <p class="text-muted small mb-2">{{ Str::limit(strip_tags($gw->description), 80) }}</p>
                    @endif
                    <div class="d-flex gap-2 flex-wrap mb-3">
                        <span class="badge {{ $gw->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $gw->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <span class="badge {{ $gw->mode === 'live' ? 'bg-primary' : 'bg-warning text-dark' }}">
                            {{ strtoupper($gw->mode) }} Mode
                        </span>
                        @if($gw->merchant_id)
                            <span class="badge bg-light text-dark border">
                                <i class="fas fa-id-card me-1"></i> Merchant ID Set
                            </span>
                        @endif
                        @if($gw->api_key)
                            <span class="badge bg-light text-dark border">
                                <i class="fas fa-key me-1"></i> API Key Set
                            </span>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <button wire:click="openEdit({{ $gw->id }})"
                                class="btn btn-sm btn-outline-warning flex-grow-1">
                            <i class="fas fa-edit me-1"></i> Edit
                        </button>
                        <button wire:click="confirmDelete({{ $gw->id }})"
                                class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-transparent py-1 text-end">
                    <small class="text-muted">Sort: {{ $gw->sort_order }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- ADD / EDIT MODAL --}}
    @if($showModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.55);z-index:1055">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-credit-card me-2"></i>
                        {{ $editingId ? 'Edit Gateway' : 'Add Gateway' }}
                    </h5>
                    <button wire:click="$set('showModal',false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Gateway Name <span class="text-danger">*</span></label>
                            <input wire:model.live="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="e.g. JazzCash">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Slug <span class="text-danger">*</span></label>
                            <input wire:model="slug" type="text"
                                   class="form-control @error('slug') is-invalid @enderror"
                                   placeholder="jazzcash">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text">Auto-generated from name. Lowercase, underscores only.</div>
                        </div>

                        {{-- CKEditor Description --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">CKEditor</label>
                            <div wire:ignore>
                                <textarea id="gateway-ckeditor"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium">Logo</label>
                            @if($existingLogo && !$logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$existingLogo) }}"
                                         style="height:50px;object-fit:contain" class="border rounded p-1">
                                </div>
                            @endif
                            @if($logo)
                                <div class="mb-2">
                                    <img src="{{ $logo->temporaryUrl() }}"
                                         style="height:50px;object-fit:contain" class="border rounded p-1">
                                </div>
                            @endif
                            <input wire:model="logo" type="file" accept="image/*" class="form-control">
                            @error('logo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <hr class="my-1">

                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="fas fa-id-card me-1 text-muted"></i> Merchant ID
                            </label>
                            <input wire:model="merchant_id" type="text" class="form-control"
                                   placeholder="Your Merchant ID">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="fas fa-link me-1 text-muted"></i> Webhook URL
                            </label>
                            <input wire:model="webhook_url" type="url" class="form-control"
                                   placeholder="https://yoursite.com/webhook/...">
                            @error('webhook_url') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="fas fa-key me-1 text-muted"></i> API Key
                            </label>
                            <input wire:model="api_key" type="text" class="form-control"
                                   placeholder="pk_live_xxxxxxxx">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">
                                <i class="fas fa-lock me-1 text-muted"></i> API Secret
                            </label>
                            <input wire:model="api_secret" type="password" class="form-control"
                                   placeholder="sk_live_xxxxxxxx">
                        </div>

                        <hr class="my-1">

                        <div class="col-md-4">
                            <label class="form-label fw-medium">Mode</label>
                            <select wire:model="mode" class="form-select">
                                <option value="test">Test Mode</option>
                                <option value="live">Live Mode</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Sort Order</label>
                            <input wire:model="sort_order" type="number" class="form-control" min="0">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-check form-switch mb-2">
                                <input wire:model="is_active" type="checkbox"
                                       class="form-check-input" role="switch" id="gwActive">
                                <label class="form-check-label fw-medium" for="gwActive">Active / Enable</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-medium mb-0">
                                    <i class="fas fa-sliders-h me-1 text-muted"></i> Extra Fields
                                    <small class="text-muted fw-normal">(optional key-value pairs)</small>
                                </label>
                                <button type="button" wire:click="addExtraField"
                                        class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-plus me-1"></i> Add Field
                                </button>
                            </div>
                            @foreach($extraFields as $i => $row)
                            <div class="row g-2 mb-2">
                                <div class="col-5">
                                    <input wire:model="extraFields.{{ $i }}.key"
                                           type="text" class="form-control form-control-sm"
                                           placeholder="Key (e.g. store_id)">
                                </div>
                                <div class="col-6">
                                    <input wire:model="extraFields.{{ $i }}.value"
                                           type="text" class="form-control form-control-sm"
                                           placeholder="Value">
                                </div>
                                <div class="col-1">
                                    <button type="button" wire:click="removeExtraField({{ $i }})"
                                            class="btn btn-sm btn-outline-danger w-100">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                            @if(empty($extraFields))
                                <p class="text-muted small mb-0">No extra fields added.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showModal',false)" class="btn btn-secondary">Cancel</button>
                    <button wire:click="save" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        {{ $editingId ? 'Update Gateway' : 'Save Gateway' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- DELETE CONFIRM --}}
    @if($confirmingDeleteId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.55);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x d-block mb-3"></i>
                    <h6>Delete this gateway?</h6>
                    <p class="text-muted small mb-0">
                        Yeh action undo nahi ho sakti.<br>
                        Logo aur credentials bhi delete ho jayenge.
                    </p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button wire:click="$set('confirmingDeleteId', null)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="delete" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== CKEditor 4 - FREE VERSION ===== --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        function initGatewayCKEditor(content = '') {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(() => initGatewayCKEditor(content), 300);
                return;
            }

            const el = document.getElementById('gateway-ckeditor');
            if (!el) return;

            if (CKEDITOR.instances['gateway-ckeditor']) {
                CKEDITOR.instances['gateway-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('gateway-ckeditor', {
                height: 200,
                versionCheck: false,
                toolbarGroups: [
                    { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                    { name: 'paragraph',   groups: ['list', 'indent', 'blocks', 'align'] },
                    { name: 'links' },
                    { name: 'styles' },
                    { name: 'colors' },
                ],
            });

            CKEDITOR.instances['gateway-ckeditor'].on('instanceReady', function () {
                if (content) {
                    CKEDITOR.instances['gateway-ckeditor'].setData(content);
                }
            });

            CKEDITOR.instances['gateway-ckeditor'].on('change', function () {
                @this.set('description', CKEDITOR.instances['gateway-ckeditor'].getData());
            });
        }

        document.addEventListener('livewire:initialized', function () {
            Livewire.on('gatewayModalOpened', function (data) {
                const content = data && data.content ? data.content : '';
                setTimeout(() => initGatewayCKEditor(content), 300);
            });
        });
    </script>
</div>