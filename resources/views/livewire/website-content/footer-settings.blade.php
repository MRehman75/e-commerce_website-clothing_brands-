<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-shoe-prints me-2 text-primary"></i> Footer Settings
        </h4>
        <button wire:click="saveSettings" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Save Settings
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-4">
        @foreach([
            'general'  => ['icon'=>'fa-cog',          'label'=>'General'],
            'contact'  => ['icon'=>'fa-phone',         'label'=>'Contact'],
            'social'   => ['icon'=>'fa-share-alt',     'label'=>'Social'],
            'newsletter'=>['icon'=>'fa-envelope',      'label'=>'Newsletter'],
            'apps'     => ['icon'=>'fa-mobile-alt',    'label'=>'App Links'],
            'payments' => ['icon'=>'fa-credit-card',   'label'=>'Payments'],
            'columns'  => ['icon'=>'fa-columns',       'label'=>'Columns & Links'],
        ] as $tab => $info)
        <li class="nav-item">
            <button wire:click="$set('activeTab','{{ $tab }}')"
                    class="nav-link {{ $activeTab === $tab ? 'active' : '' }}">
                <i class="fas {{ $info['icon'] }} me-1"></i> {{ $info['label'] }}
            </button>
        </li>
        @endforeach
    </ul>

    {{-- ── TAB: GENERAL ── --}}
    @if($activeTab === 'general')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-medium">Footer Logo</label>
                    @if($existingLogo && !$logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $existingLogo) }}"
                                 style="height:60px;object-fit:contain" class="border rounded p-1">
                        </div>
                    @endif
                    @if($logo)
                        <div class="mb-2">
                            <img src="{{ $logo->temporaryUrl() }}"
                                 style="height:60px;object-fit:contain" class="border rounded p-1">
                        </div>
                    @endif
                    <input wire:model="logo" type="file" accept="image/*" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Company Name</label>
                    <input wire:model="company_name" type="text" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Copyright Text</label>
                    <input wire:model="copyright_text" type="text" class="form-control"
                           placeholder="© 2025 MyStore. All rights reserved.">
                </div>

                {{-- CKEditor About Text --}}
                <div class="col-12">
                    <label class="form-label fw-medium">About Text</label>
                    <div wire:ignore>
                        <textarea id="footer-ckeditor"></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-check form-switch">
                        <input wire:model="show_bottom_bar" type="checkbox"
                               class="form-check-input" role="switch" id="bottomBar">
                        <label class="form-check-label" for="bottomBar">
                            Show Bottom Bar (Copyright bar)
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ── TAB: CONTACT ── --}}
    @if($activeTab === 'contact')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input wire:model="email" type="email" class="form-control"
                               placeholder="info@mystore.com">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Phone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <input wire:model="phone" type="text" class="form-control"
                               placeholder="+92 300 1234567">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-medium">Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input wire:model="address" type="text" class="form-control"
                               placeholder="123 Main St, Lahore, Pakistan">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ── TAB: SOCIAL ── --}}
    @if($activeTab === 'social')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                @foreach([
                    'facebook'  => ['icon'=>'fa-facebook',  'color'=>'#1877f2', 'label'=>'Facebook'],
                    'instagram' => ['icon'=>'fa-instagram', 'color'=>'#e4405f', 'label'=>'Instagram'],
                    'twitter'   => ['icon'=>'fa-twitter',   'color'=>'#1da1f2', 'label'=>'Twitter / X'],
                    'youtube'   => ['icon'=>'fa-youtube',   'color'=>'#ff0000', 'label'=>'YouTube'],
                    'tiktok'    => ['icon'=>'fa-tiktok',    'color'=>'#010101', 'label'=>'TikTok'],
                    'whatsapp'  => ['icon'=>'fa-whatsapp',  'color'=>'#25d366', 'label'=>'WhatsApp Number'],
                ] as $field => $info)
                <div class="col-md-6">
                    <label class="form-label fw-medium">{{ $info['label'] }}</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background:{{ $info['color'] }};color:white">
                            <i class="fab {{ $info['icon'] }}"></i>
                        </span>
                        <input wire:model="{{ $field }}" type="text" class="form-control"
                               placeholder="{{ $field === 'whatsapp' ? '+923001234567' : 'https://...' }}">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- ── TAB: NEWSLETTER ── --}}
    @if($activeTab === 'newsletter')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-check form-switch mb-3">
                        <input wire:model="show_newsletter" type="checkbox"
                               class="form-check-input" role="switch" id="showNewsletter">
                        <label class="form-check-label fw-medium" for="showNewsletter">
                            Show Newsletter Section in Footer
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Newsletter Title</label>
                    <input wire:model="newsletter_title" type="text" class="form-control"
                           placeholder="Subscribe to our Newsletter">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">Newsletter Subtitle</label>
                    <input wire:model="newsletter_subtitle" type="text" class="form-control"
                           placeholder="Get the latest deals and offers.">
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ── TAB: APP LINKS ── --}}
    @if($activeTab === 'apps')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium">
                        <i class="fab fa-google-play me-2 text-success"></i>Google Play Store
                    </label>
                    <input wire:model="playstore_link" type="url" class="form-control"
                           placeholder="https://play.google.com/store/apps/...">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-medium">
                        <i class="fab fa-apple me-2"></i>Apple App Store
                    </label>
                    <input wire:model="appstore_link" type="url" class="form-control"
                           placeholder="https://apps.apple.com/...">
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ── TAB: PAYMENTS ── --}}
    @if($activeTab === 'payments')
    <div class="card shadow-sm">
        <div class="card-body">
            <label class="form-label fw-medium mb-3">Select Payment Methods to Display</label>
            <div class="row g-3">
                @foreach($availablePayments as $key => $label)
                <div class="col-md-4 col-6">
                    <div class="form-check border rounded p-3
                        {{ in_array($key, $payment_methods) ? 'border-primary bg-primary bg-opacity-10' : '' }}">
                        <input type="checkbox"
                               class="form-check-input"
                               id="pay_{{ $key }}"
                               value="{{ $key }}"
                               wire:model="payment_methods">
                        <label class="form-check-label fw-medium" for="pay_{{ $key }}">
                            @if($key === 'visa')         <i class="fab fa-cc-visa me-2 text-primary fs-5"></i>
                            @elseif($key === 'mastercard')<i class="fab fa-cc-mastercard me-2 text-danger fs-5"></i>
                            @elseif($key === 'easypaisa') <i class="fas fa-mobile-alt me-2 text-success fs-5"></i>
                            @elseif($key === 'jazzcash')  <i class="fas fa-wallet me-2 text-warning fs-5"></i>
                            @elseif($key === 'cod')        <i class="fas fa-money-bill me-2 text-success fs-5"></i>
                            @elseif($key === 'bank')       <i class="fas fa-university me-2 text-info fs-5"></i>
                            @endif
                            {{ $label }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- ── TAB: COLUMNS & LINKS ── --}}
    @if($activeTab === 'columns')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0 fw-bold">Footer Columns</h6>
        <button wire:click="openCreateColumn" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i> Add Column
        </button>
    </div>

    @if(empty($columns))
        <div class="text-center text-muted py-5">
            <i class="fas fa-columns fa-2x d-block mb-2 opacity-25"></i>
            No columns yet. Add your first column.
        </div>
    @else
    <div class="row g-4">
        @foreach($columns as $col)
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-header d-flex justify-content-between align-items-center
                            {{ $col['is_active'] ? 'bg-primary text-white' : 'bg-secondary text-white' }}">
                    <span class="fw-bold">{{ $col['title'] }}</span>
                    <div class="d-flex gap-1">
                        <button wire:click="openEditColumn({{ $col['id'] }})"
                                class="btn btn-sm btn-light btn-sm py-0 px-1">
                            <i class="fas fa-edit text-warning"></i>
                        </button>
                        <button wire:click="toggleColumnActive({{ $col['id'] }})"
                                class="btn btn-sm btn-light py-0 px-1">
                            <i class="fas fa-{{ $col['is_active'] ? 'eye-slash' : 'eye' }}"></i>
                        </button>
                        <button wire:click="confirmDeleteColumn({{ $col['id'] }})"
                                class="btn btn-sm btn-light py-0 px-1">
                            <i class="fas fa-trash text-danger"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-2">
                    @if(empty($col['links']))
                        <p class="text-muted text-center small py-2">No links yet.</p>
                    @else
                    <ul class="list-group list-group-flush">
                        @foreach($col['links'] as $link)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-1 py-1
                                   {{ !$link['is_active'] ? 'opacity-50' : '' }}">
                            <div>
                                <span class="small fw-medium">{{ $link['label'] }}</span>
                                <br>
                                <code class="x-small text-muted" style="font-size:11px">{{ Str::limit($link['url'], 30) }}</code>
                            </div>
                            <div class="d-flex gap-1">
                                <button wire:click="openEditLink({{ $link['id'] }})"
                                        class="btn btn-sm btn-light py-0 px-1">
                                    <i class="fas fa-edit text-warning" style="font-size:11px"></i>
                                </button>
                                <button wire:click="toggleLinkActive({{ $link['id'] }})"
                                        class="btn btn-sm btn-light py-0 px-1">
                                    <i class="fas fa-{{ $link['is_active'] ? 'eye-slash' : 'eye' }}"
                                       style="font-size:11px"></i>
                                </button>
                                <button wire:click="confirmDeleteLink({{ $link['id'] }})"
                                        class="btn btn-sm btn-light py-0 px-1">
                                    <i class="fas fa-trash text-danger" style="font-size:11px"></i>
                                </button>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <div class="card-footer bg-white py-2">
                    <button wire:click="openCreateLink({{ $col['id'] }})"
                            class="btn btn-sm btn-outline-primary w-100">
                        <i class="fas fa-plus me-1"></i> Add Link
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    @endif

    {{-- ════════ COLUMN MODAL ════════ --}}
    @if($showColumnModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title">{{ $editingColumnId ? 'Edit Column' : 'Add Column' }}</h6>
                    <button wire:click="$set('showColumnModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Column Title *</label>
                        <input wire:model="columnTitle" type="text"
                               class="form-control @error('columnTitle') is-invalid @enderror"
                               placeholder="e.g. Quick Links">
                        @error('columnTitle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input wire:model="columnSortOrder" type="number" class="form-control" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showColumnModal', false)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="saveColumn" class="btn btn-primary btn-sm">Save</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════ LINK MODAL ════════ --}}
    @if($showLinkModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title">{{ $editingLinkId ? 'Edit Link' : 'Add Link' }}</h6>
                    <button wire:click="$set('showLinkModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Label *</label>
                            <input wire:model="linkLabel" type="text"
                                   class="form-control @error('linkLabel') is-invalid @enderror"
                                   placeholder="e.g. About Us">
                            @error('linkLabel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">URL *</label>
                            <input wire:model="linkUrl" type="text"
                                   class="form-control @error('linkUrl') is-invalid @enderror"
                                   placeholder="/about-us or https://...">
                            @error('linkUrl') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sort Order</label>
                            <input wire:model="linkSortOrder" type="number" class="form-control" min="0">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check form-switch mb-2">
                                <input wire:model="link_open_in_new_tab" type="checkbox"
                                       class="form-check-input" role="switch" id="newTabLink">
                                <label class="form-check-label" for="newTabLink">Open in New Tab</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showLinkModal', false)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="saveLink" class="btn btn-primary btn-sm">Save</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════ DELETE COLUMN CONFIRM ════════ --}}
    @if($confirmingDeleteColumnId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3 d-block"></i>
                    <h6>Delete this column?</h6>
                    <p class="text-muted small">Sab links bhi delete ho jayenge.</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button wire:click="$set('confirmingDeleteColumnId', null)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="deleteColumn" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════ DELETE LINK CONFIRM ════════ --}}
    @if($confirmingDeleteLinkId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3 d-block"></i>
                    <h6>Delete this link?</h6>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button wire:click="$set('confirmingDeleteLinkId', null)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="deleteLink" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== CKEditor 4 - FREE VERSION ===== --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        function initFooterCKEditor() {
            if (typeof CKEDITOR === 'undefined') {
                setTimeout(initFooterCKEditor, 300);
                return;
            }

            const el = document.getElementById('footer-ckeditor');
            if (!el) return;

            if (CKEDITOR.instances['footer-ckeditor']) {
                CKEDITOR.instances['footer-ckeditor'].destroy(true);
            }

            CKEDITOR.replace('footer-ckeditor', {
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

            CKEDITOR.instances['footer-ckeditor'].on('instanceReady', function () {
                const content = @json($about_text ?? '');
                if (content) {
                    CKEDITOR.instances['footer-ckeditor'].setData(content);
                }
            });

            CKEDITOR.instances['footer-ckeditor'].on('change', function () {
                @this.set('about_text', CKEDITOR.instances['footer-ckeditor'].getData());
            });
        }

        // Page load par init karo
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(initFooterCKEditor, 500);
        });

        // Tab switch hone par bhi check karo
        document.addEventListener('livewire:initialized', function () {
            Livewire.hook('morph.updated', function ({ component }) {
                setTimeout(function () {
                    if (document.getElementById('footer-ckeditor') && !CKEDITOR.instances['footer-ckeditor']) {
                        initFooterCKEditor();
                    }
                }, 300);
            });
        });
    </script>
</div>