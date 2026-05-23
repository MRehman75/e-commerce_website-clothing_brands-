<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-bars me-2 text-primary"></i> Menu Manager
        </h4>
        <button wire:click="openCreateMenu" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> New Menu
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- ── LEFT: Menu List ── --}}
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-header fw-bold bg-light">
                    <i class="fas fa-list me-2"></i> Menus
                </div>
                <div class="list-group list-group-flush">
                    @forelse($menus as $menu)
                    <div class="list-group-item list-group-item-action p-2
                                {{ $activeMenuId == $menu->id ? 'active' : '' }}"
                         style="cursor:pointer"
                         wire:click="$set('activeMenuId', {{ $menu->id }})">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium {{ $activeMenuId == $menu->id ? 'text-white' : '' }}">
                                    {{ $menu->name }}
                                </div>
                                <small class="{{ $activeMenuId == $menu->id ? 'text-white-50' : 'text-muted' }}">
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $menu->location }}
                                    &nbsp;·&nbsp;{{ $menu->items_count }} items
                                </small>
                            </div>
                            <div class="d-flex gap-1" wire:click.stop>
                                <button wire:click="openEditMenu({{ $menu->id }})"
                                        class="btn btn-sm {{ $activeMenuId == $menu->id ? 'btn-light' : 'btn-outline-warning' }} py-0 px-1">
                                    <i class="fas fa-edit" style="font-size:11px"></i>
                                </button>
                                <button wire:click="confirmDeleteMenu({{ $menu->id }})"
                                        class="btn btn-sm {{ $activeMenuId == $menu->id ? 'btn-light' : 'btn-outline-danger' }} py-0 px-1">
                                    <i class="fas fa-trash" style="font-size:11px"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="list-group-item text-center text-muted py-4">
                        <i class="fas fa-bars fa-2x d-block mb-2 opacity-25"></i>
                        No menus yet.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ── RIGHT: Menu Items ── --}}
        <div class="col-md-9">
            @if($activeMenu)
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <div>
                        <span class="fw-bold">{{ $activeMenu->name }}</span>
                        <span class="badge bg-primary ms-2">{{ $activeMenu->location }}</span>
                    </div>
                    <button wire:click="openCreateItem({{ $activeMenu->id }})"
                            class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Add Item
                    </button>
                </div>
                <div class="card-body p-3">

                    @if($activeMenu->rootItems->isEmpty())
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-stream fa-2x d-block mb-2 opacity-25"></i>
                            No items yet. Add your first menu item.
                        </div>
                    @else

                    {{-- Items Tree --}}
                    <div class="menu-tree">
                        @foreach($activeMenu->rootItems as $item)

                        {{-- ── Parent Item ── --}}
                        <div class="menu-item-row mb-2">
                            <div class="d-flex align-items-center gap-2 p-2 rounded border
                                        {{ !$item->is_active ? 'bg-light opacity-75' : 'bg-white' }}">

                                {{-- Drag Handle / Order --}}
                                <div class="d-flex flex-column gap-0">
                                    <button wire:click="moveUp({{ $item->id }})"
                                            class="btn btn-sm border-0 p-0 lh-1 text-muted">
                                        <i class="fas fa-caret-up"></i>
                                    </button>
                                    <button wire:click="moveDown({{ $item->id }})"
                                            class="btn btn-sm border-0 p-0 lh-1 text-muted">
                                        <i class="fas fa-caret-down"></i>
                                    </button>
                                </div>

                                {{-- Icon --}}
                                @if($item->icon)
                                    <i class="{{ $item->icon }} text-muted" style="width:18px"></i>
                                @else
                                    <i class="fas fa-minus text-muted opacity-25" style="width:18px"></i>
                                @endif

                                {{-- Label + URL --}}
                                <div class="flex-grow-1">
                                    <span class="fw-semibold">{{ $item->label }}</span>
                                    @if($item->children->count())
                                        <span class="badge bg-info ms-1 small">
                                            {{ $item->children->count() }} sub
                                        </span>
                                    @endif
                                    @if($item->url)
                                        <br><code class="small text-muted">{{ Str::limit($item->url, 50) }}</code>
                                    @endif
                                </div>

                                {{-- Status --}}
                                <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }} small">
                                    {{ $item->is_active ? 'Active' : 'Off' }}
                                </span>

                                {{-- Actions --}}
                                <div class="d-flex gap-1">
                                    <button wire:click="openCreateItem({{ $activeMenu->id }}, {{ $item->id }})"
                                            class="btn btn-sm btn-outline-info py-0 px-2"
                                            title="Add Child">
                                        <i class="fas fa-level-down-alt" style="font-size:11px"></i>
                                    </button>
                                    <button wire:click="toggleItemActive({{ $item->id }})"
                                            class="btn btn-sm btn-outline-{{ $item->is_active ? 'warning' : 'success' }} py-0 px-2">
                                        <i class="fas fa-{{ $item->is_active ? 'eye-slash' : 'eye' }}"
                                           style="font-size:11px"></i>
                                    </button>
                                    <button wire:click="openEditItem({{ $item->id }})"
                                            class="btn btn-sm btn-warning py-0 px-2">
                                        <i class="fas fa-edit" style="font-size:11px"></i>
                                    </button>
                                    <button wire:click="confirmDeleteItem({{ $item->id }})"
                                            class="btn btn-sm btn-danger py-0 px-2">
                                        <i class="fas fa-trash" style="font-size:11px"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- ── Children ── --}}
                            @if($item->children->count())
                            <div class="ms-4 mt-1 border-start border-2 border-info ps-3">
                                @foreach($item->children as $child)
                                <div class="d-flex align-items-center gap-2 p-2 rounded border mb-1
                                            {{ !$child->is_active ? 'bg-light opacity-75' : 'bg-white' }}">

                                    <div class="d-flex flex-column gap-0">
                                        <button wire:click="moveUp({{ $child->id }})"
                                                class="btn btn-sm border-0 p-0 lh-1 text-muted">
                                            <i class="fas fa-caret-up"></i>
                                        </button>
                                        <button wire:click="moveDown({{ $child->id }})"
                                                class="btn btn-sm border-0 p-0 lh-1 text-muted">
                                            <i class="fas fa-caret-down"></i>
                                        </button>
                                    </div>

                                    <i class="fas fa-level-up-alt fa-rotate-90 text-info opacity-50"
                                       style="width:18px;font-size:12px"></i>

                                    @if($child->icon)
                                        <i class="{{ $child->icon }} text-muted" style="width:18px"></i>
                                    @endif

                                    <div class="flex-grow-1">
                                        <span class="fw-medium">{{ $child->label }}</span>
                                        @if($child->url)
                                            <br><code class="small text-muted">{{ Str::limit($child->url, 45) }}</code>
                                        @endif
                                    </div>

                                    <span class="badge bg-{{ $child->is_active ? 'success' : 'secondary' }} small">
                                        {{ $child->is_active ? 'Active' : 'Off' }}
                                    </span>

                                    <div class="d-flex gap-1">
                                        <button wire:click="toggleItemActive({{ $child->id }})"
                                                class="btn btn-sm btn-outline-{{ $child->is_active ? 'warning' : 'success' }} py-0 px-2">
                                            <i class="fas fa-{{ $child->is_active ? 'eye-slash' : 'eye' }}"
                                               style="font-size:11px"></i>
                                        </button>
                                        <button wire:click="openEditItem({{ $child->id }})"
                                                class="btn btn-sm btn-warning py-0 px-2">
                                            <i class="fas fa-edit" style="font-size:11px"></i>
                                        </button>
                                        <button wire:click="confirmDeleteItem({{ $child->id }})"
                                                class="btn btn-sm btn-danger py-0 px-2">
                                            <i class="fas fa-trash" style="font-size:11px"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
            @else
            <div class="card shadow-sm">
                <div class="card-body text-center text-muted py-5">
                    <i class="fas fa-hand-point-left fa-2x d-block mb-2 opacity-25"></i>
                    Left side se menu select karo ya naya banao.
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- ════════ MENU MODAL ════════ --}}
    @if($showMenuModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title">
                        {{ $editingMenuId ? 'Edit Menu' : 'Create Menu' }}
                    </h6>
                    <button wire:click="$set('showMenuModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Menu Name *</label>
                        <input wire:model="menuName" type="text"
                               class="form-control @error('menuName') is-invalid @enderror"
                               placeholder="e.g. Header Menu">
                        @error('menuName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Location *</label>
                        <input wire:model="menuLocation" type="text"
                               class="form-control @error('menuLocation') is-invalid @enderror"
                               placeholder="e.g. header, footer, mobile">
                        <div class="form-text">Lowercase, no spaces. e.g. header</div>
                        @error('menuLocation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showMenuModal', false)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="saveMenu" class="btn btn-primary btn-sm">Save</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════ ITEM MODAL ════════ --}}
    @if($showItemModal)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title">
                        <i class="fas fa-link me-2"></i>
                        {{ $editingItemId ? 'Edit Item' : ($itemParentId ? 'Add Sub Item' : 'Add Menu Item') }}
                    </h6>
                    <button wire:click="$set('showItemModal', false)" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Parent --}}
                        <div class="col-12">
                            <label class="form-label fw-medium">Parent Item</label>
                            <select wire:model="itemParentId" class="form-select">
                                <option value="">— Top Level (No Parent) —</option>
                                @foreach($parentItems as $parent)
                                    @if($editingItemId != $parent->id)
                                    <option value="{{ $parent->id }}">{{ $parent->label }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        {{-- Label --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Label *</label>
                            <input wire:model="itemLabel" type="text"
                                   class="form-control @error('itemLabel') is-invalid @enderror"
                                   placeholder="e.g. Home">
                            @error('itemLabel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- URL --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">URL</label>
                            <input wire:model="itemUrl" type="text" class="form-control"
                                   placeholder="/ or /products or https://...">
                        </div>

                        {{-- Icon --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Icon
                                <small class="text-muted">(FontAwesome class)</small>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="{{ $itemIcon ?: 'fas fa-icons' }}"></i>
                                </span>
                                <input wire:model.live="itemIcon" type="text" class="form-control"
                                       placeholder="fas fa-home">
                            </div>
                        </div>

                        {{-- Sort --}}
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Sort Order</label>
                            <input wire:model="itemSortOrder" type="number"
                                   class="form-control" min="0">
                        </div>

                        {{-- Options --}}
                        <div class="col-12 d-flex gap-4">
                            <div class="form-check form-switch">
                                <input wire:model="itemNewTab" type="checkbox"
                                       class="form-check-input" role="switch" id="itemNewTab">
                                <label class="form-check-label" for="itemNewTab">New Tab</label>
                            </div>
                            <div class="form-check form-switch">
                                <input wire:model="itemActive" type="checkbox"
                                       class="form-check-input" role="switch" id="itemActive">
                                <label class="form-check-label" for="itemActive">Active</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showItemModal', false)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="saveItem" class="btn btn-primary btn-sm">
                        <i class="fas fa-save me-1"></i> Save Item
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════ DELETE MENU CONFIRM ════════ --}}
    @if($confirmingDeleteMenuId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3 d-block"></i>
                    <h6>Delete this menu?</h6>
                    <p class="text-muted small">Sare items bhi delete ho jayenge.</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button wire:click="$set('confirmingDeleteMenuId', null)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="deleteMenu" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ════════ DELETE ITEM CONFIRM ════════ --}}
    @if($confirmingDeleteItemId)
    <div class="modal show d-block" style="background:rgba(0,0,0,.5);z-index:1055">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3 d-block"></i>
                    <h6>Delete this item?</h6>
                    <p class="text-muted small">Children bhi delete ho jayenge.</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button wire:click="$set('confirmingDeleteItemId', null)" class="btn btn-secondary btn-sm">Cancel</button>
                    <button wire:click="deleteItem" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>