<div class="profile-wrapper">
    <!-- Sidebar -->
    <aside class="main-sidebar" id="mainSidebar">
        <!-- User Panel -->
        <div class="user-panel">
            <div class="user-avatar">
                <span class="avatar-text">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </span>
            </div>
            <div class="user-info">
                <h6 class="user-name">{{ auth()->user()->name ?? 'User' }}</h6>
                <span class="user-email">{{ auth()->user()->email ?? '' }}</span>
                <span class="user-status">
                    <span class="status-dot"></span> Online
                </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="sidebar-menu">
            <ul class="nav-list">
                <li class="nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('customer.dashboard') }}" class="nav-link">
                        <i class="fas fa-th-large nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
                    <a href="{{ route('customer.orders') }}" class="nav-link">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.wishlist*') ? 'active' : '' }}">
                    <a href="{{ route('customer.wishlist') }}" class="nav-link">
                        <i class="fas fa-heart nav-icon"></i>
                        <span>Wishlist</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('customer.profile*') ? 'active' : '' }}">
                    <a href="{{ route('customer.profile') }}" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <span>Profile</span>
                        @if(request()->routeIs('customer.profile*'))
                            <span class="nav-indicator"></span>
                        @endif
                    </a>
                </li>
                <li class="nav-divider"></li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="#" class="nav-link logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <div class="profile-main">
        <!-- Header -->
        <header class="profile-header d-lg-none">
    <div class="header-left">
        <button class="sidebar-toggle" id="sidebarToggleBtn" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="header-right"></div>
</header>

        <!-- Content -->
        <div class="profile-content">
            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title">My Profile</h2>
                    <p class="text-muted small">Manage your personal information</p>
                </div>
            </div>

            <!-- ============================================================
            MESSAGES
            ============================================================ -->
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($successMessage)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ $successMessage }}
                    <button type="button" class="btn-close" wire:click="$set('successMessage', '')"></button>
                </div>
            @endif

            @if($errorMessage)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errorMessage }}
                    <button type="button" class="btn-close" wire:click="$set('errorMessage', '')"></button>
                </div>
            @endif

            <!-- ============================================================
            PROFILE FORM
            ============================================================ -->
            <div class="row g-4">
                <!-- Profile Image -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-center">
                            <div class="profile-image-wrapper">
                                @if($profile_image)
                                    <img src="{{ asset('storage/' . $profile_image) }}" 
                                         alt="Profile Image" 
                                         class="profile-image">
                                @else
                                    <div class="profile-image-placeholder">
                                        <span class="placeholder-text">
                                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                                        </span>
                                    </div>
                                @endif
                                <div class="profile-image-overlay">
                                    <label for="profile_image_upload" class="upload-btn">
                                        <i class="fas fa-camera"></i>
                                        <span>Change Photo</span>
                                    </label>
                                    <input type="file" 
                                           id="profile_image_upload" 
                                           wire:model="new_profile_image" 
                                           accept="image/*"
                                           class="d-none">
                                </div>
                            </div>
                            @if($profile_image)
                                <button wire:click="removeProfileImage" 
                                        class="btn btn-sm btn-outline-danger mt-3"
                                        wire:confirm="Remove profile image?">
                                    <i class="fas fa-trash-alt me-1"></i> Remove Photo
                                </button>
                            @endif
                            @error('new_profile_image')
                                <small class="text-danger d-block mt-2">{{ $message }}</small>
                            @enderror
                            @if($new_profile_image)
                                <small class="text-success d-block mt-2">New image selected</small>
                            @endif
                            <div class="mt-3">
                                <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                                <div class="mt-2">
                                    <span class="badge bg-success">Verified Account</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Form -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                <i class="fas fa-user-edit text-gold me-2"></i>Personal Information
                            </h5>

                            <form wire:submit.prevent="updateProfile">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Full Name</label>
                                        <input type="text" 
                                               wire:model="name" 
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Enter your full name">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Email Address</label>
                                        <input type="email" 
                                               wire:model="email" 
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="Enter your email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Phone Number</label>
                                        <input type="text" 
                                               wire:model="phone" 
                                               class="form-control @error('phone') is-invalid @enderror"
                                               placeholder="Enter your phone number">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Member Since</label>
                                        <input type="text" 
                                               value="{{ auth()->user()->created_at->format('F d, Y') }}" 
                                               class="form-control" 
                                               disabled>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-semibold">Bio</label>
                                        <textarea wire:model="bio" 
                                                  class="form-control @error('bio') is-invalid @enderror"
                                                  rows="3"
                                                  placeholder="Tell us a little about yourself"></textarea>
                                        @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">
                                            <span id="bioCount">{{ strlen($bio ?? '') }}</span> / 500 characters
                                        </small>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-gold" wire:loading.attr="disabled">
                                        <span wire:loading.remove>
                                            <i class="fas fa-save me-1"></i> Save Changes
                                        </span>
                                        <span wire:loading>
                                            <i class="fas fa-spinner fa-spin me-1"></i> Saving...
                                        </span>
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-lock text-gold me-2"></i>Security
                                </h5>
                                <button wire:click="togglePasswordForm" class="btn btn-sm btn-outline-dark">
                                    <i class="fas fa-{{ $showPasswordForm ? 'eye-slash' : 'eye' }} me-1"></i>
                                    {{ $showPasswordForm ? 'Hide Password Form' : 'Change Password' }}
                                </button>
                            </div>

                            @if($showPasswordForm)
                                <form wire:submit.prevent="updatePassword">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">Current Password</label>
                                            <input type="password" 
                                                   wire:model="current_password" 
                                                   class="form-control @error('current_password') is-invalid @enderror"
                                                   placeholder="Enter current password">
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">New Password</label>
                                            <input type="password" 
                                                   wire:model="new_password" 
                                                   class="form-control @error('new_password') is-invalid @enderror"
                                                   placeholder="Enter new password">
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="password-strength mt-1">
                                                <div class="strength-bar">
                                                    <div class="strength-fill" 
                                                         style="width: {{ $this->getPasswordStrength() }}%; 
                                                                background: {{ $this->getPasswordStrengthColor() }};">
                                                    </div>
                                                </div>
                                                <small class="text-muted">
                                                    @if($new_password)
                                                        Strength: {{ $this->getPasswordStrengthText() }}
                                                    @endif
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">Confirm New Password</label>
                                            <input type="password" 
                                                   wire:model="new_password_confirmation" 
                                                   class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                   placeholder="Confirm new password">
                                            @error('new_password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="password-strength mt-1">
                                            <div class="strength-bar">
                                               <div class="strength-fill" 
                                                   style="width: {{ $this->getPasswordStrength() }}%; 
                                                        background: {{ $this->getPasswordStrengthColor() }};">
                                               </div>
                                            </div>
                                            <small class="text-muted">
                                           @if($new_password)
                                                Strength: {{ $this->getPasswordStrengthText() }}
                                           @endif
                                           </small>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-gold" wire:loading.attr="disabled">
                                            <span wire:loading.remove>
                                                <i class="fas fa-key me-1"></i> Update Password
                                            </span>
                                            <span wire:loading>
                                                <i class="fas fa-spinner fa-spin me-1"></i> Updating...
                                            </span>
                                        </button>
                                        <button type="button" wire:click="togglePasswordForm" class="btn btn-outline-secondary">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center py-3">
                                    <i class="fas fa-shield-alt fa-2x text-muted mb-2 d-block"></i>
                                    <p class="text-muted mb-0">Your password was last changed {{ auth()->user()->updated_at->diffForHumans() }}</p>
                                    <button wire:click="togglePasswordForm" class="btn btn-outline-dark btn-sm mt-2">
                                        Change Password
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
STYLES
============================================================ -->
<style>
    /* ============================================================
    PROFILE WRAPPER
    ============================================================ */
    .profile-wrapper {
        display: flex;
        min-height: calc(100vh - 36px);
        background: #f5f6fa;
    }

    /* ============================================================
    SIDEBAR (Same as other pages)
    ============================================================ */
    .profile-wrapper .main-sidebar {
        position: sticky;
        top: 0;
        left: 0;
        width: 270px;
        height: 100vh;
        background: #0a0a0a;
        color: rgba(255,255,255,0.7);
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        z-index: 100;
        border-right: 1px solid rgba(255,255,255,0.04);
        flex-shrink: 0;
        transition: all 0.3s ease;
    }
    .profile-wrapper .main-sidebar::-webkit-scrollbar {
        width: 4px;
    }
    .profile-wrapper .main-sidebar::-webkit-scrollbar-track {
        background: #0a0a0a;
    }
    .profile-wrapper .main-sidebar::-webkit-scrollbar-thumb {
        background: rgba(201,162,39,0.3);
        border-radius: 4px;
    }

    .profile-wrapper .user-panel {
        padding: 24px 20px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }
    .profile-wrapper .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #C9A227, #f9d76a);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(201,162,39,0.25);
    }
    .profile-wrapper .avatar-text {
        color: #0a0a0a;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .profile-wrapper .user-name {
        color: #fff;
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.2;
        font-family: 'Poppins', sans-serif;
    }
    .profile-wrapper .user-email {
        color: rgba(255,255,255,0.5);
        font-size: 0.7rem;
        display: block;
        margin-top: 1px;
    }
    .profile-wrapper .user-status {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.4);
        font-size: 0.6rem;
        margin-top: 2px;
    }
    .profile-wrapper .status-dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #28a745;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
    }

    .profile-wrapper .sidebar-menu {
        flex: 1;
        padding: 12px 0 20px;
        overflow-y: auto;
    }
    .profile-wrapper .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .profile-wrapper .nav-item {
        margin: 2px 0;
    }
    .profile-wrapper .nav-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 20px;
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        transition: all 0.25s ease;
        border-left: 3px solid transparent;
        position: relative;
        font-size: 0.85rem;
        font-weight: 400;
        border-radius: 0 8px 8px 0;
        margin: 0 8px;
    }
    .profile-wrapper .nav-link:hover {
        color: #fff;
        background: rgba(255,255,255,0.04);
        border-left-color: rgba(201,162,39,0.4);
    }
    .profile-wrapper .nav-item.active .nav-link {
        color: #fff;
        background: rgba(201,162,39,0.08);
        border-left-color: #C9A227;
    }
    .profile-wrapper .nav-item.active .nav-link .nav-icon {
        color: #C9A227;
    }
    .profile-wrapper .nav-icon {
        font-size: 1.1rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        color: rgba(255,255,255,0.35);
        transition: color 0.25s ease;
    }
    .profile-wrapper .nav-item.active .nav-icon {
        color: #C9A227;
    }
    .profile-wrapper .nav-link:hover .nav-icon {
        color: #C9A227;
    }
    .profile-wrapper .nav-badge {
        margin-left: auto;
        background: #C9A227;
        color: #0a0a0a;
        font-size: 0.6rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        min-width: 20px;
        text-align: center;
    }
    .profile-wrapper .nav-indicator {
        margin-left: auto;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #C9A227;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    .profile-wrapper .nav-divider {
        height: 1px;
        background: rgba(255,255,255,0.04);
        margin: 12px 20px;
    }
    .profile-wrapper .logout-link {
        color: rgba(255,255,255,0.4) !important;
        margin-top: 4px;
    }
    .profile-wrapper .logout-link:hover {
        color: #dc3545 !important;
    }
    .profile-wrapper .logout-link:hover .nav-icon {
        color: #dc3545 !important;
    }

    .profile-wrapper .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
    }
    .profile-wrapper .sidebar-overlay.active {
        display: block;
    }

    @media (max-width: 992px) {
        .profile-wrapper .main-sidebar {
            position: fixed;
            left: -100%;
            width: 280px;
            height: 100vh;
            transition: left 0.3s ease;
            box-shadow: 0 0 40px rgba(0,0,0,0.3);
            z-index: 1050;
        }
        .profile-wrapper .main-sidebar.open {
            left: 0;
        }
    }

    /* ============================================================
    PROFILE MAIN
    ============================================================ */
    .profile-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
        background: #f5f6fa;
    }

    /* ============================================================
    PROFILE HEADER
    ============================================================ */
    .profile-header {
        background: #fff;
        padding: 12px 24px;
        border-bottom: 1px solid rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
        position: sticky;
        top: 0;
        z-index: 50;
        min-height: 60px;
    }
    .profile-header .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .profile-header .sidebar-toggle {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: #333;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 8px;
        transition: background 0.2s;
        display: none;
    }
    .profile-header .sidebar-toggle:hover {
        background: #f0f0f0;
    }
    .profile-header .header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    /* ============================================================
    PROFILE CONTENT
    ============================================================ */
    .profile-content {
        flex: 1;
        padding: 24px;
        overflow-y: auto;
    }

    /* ============================================================
    PAGE TITLE
    ============================================================ */
    .page-title {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        color: #0a0a0a;
        margin-bottom: 0;
    }
    .text-gold {
        color: #C9A227;
    }

    /* ============================================================
    PROFILE IMAGE
    ============================================================ */
    .profile-image-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #C9A227;
        box-shadow: 0 8px 30px rgba(201,162,39,0.15);
        cursor: pointer;
    }
    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .placeholder-text {
        font-size: 3rem;
        font-weight: 700;
        color: #C9A227;
        font-family: 'Playfair Display', serif;
    }
    .profile-image-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 50%;
    }
    .profile-image-wrapper:hover .profile-image-overlay {
        opacity: 1;
    }
    .upload-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #fff;
        cursor: pointer;
        font-size: 0.75rem;
        gap: 4px;
    }
    .upload-btn i {
        font-size: 1.5rem;
    }
    .upload-btn:hover {
        color: #C9A227;
    }

    /* ============================================================
    FORM
    ============================================================ */
    .form-control {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #C9A227;
        box-shadow: 0 0 0 3px rgba(201,162,39,0.06);
    }
    .form-control:disabled {
        background: #f8f9fa;
        color: #6c757d;
    }

    /* ============================================================
    PASSWORD STRENGTH
    ============================================================ */
    .password-strength {
        margin-top: 4px;
    }
    .strength-bar {
        height: 4px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 2px;
    }
    .strength-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    /* ============================================================
    BUTTONS
    ============================================================ */
    .btn-gold {
        background: #C9A227;
        color: #fff;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-gold:hover {
        background: #b8911f;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(201,162,39,0.25);
    }

    /* ============================================================
    RESPONSIVE
    ============================================================ */
    @media (max-width: 992px) {
        .profile-header .sidebar-toggle {
            display: block;
        }
        .profile-header {
            padding: 10px 16px;
            min-height: 50px;
        }
        .profile-content {
            padding: 16px;
        }
        .profile-image-wrapper {
            width: 120px;
            height: 120px;
        }
        .placeholder-text {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .profile-content {
            padding: 12px;
        }
        .profile-image-wrapper {
            width: 100px;
            height: 100px;
        }
        .placeholder-text {
            font-size: 2rem;
        }
        .profile-wrapper .user-avatar {
            width: 40px;
            height: 40px;
        }
        .profile-wrapper .avatar-text {
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .profile-image-wrapper {
            width: 80px;
            height: 80px;
        }
        .placeholder-text {
            font-size: 1.5rem;
        }
        .page-title {
            font-size: 1.2rem;
        }
        .form-control {
            font-size: 0.8rem;
            padding: 8px 12px;
        }
    }
</style>

<!-- ============================================================
PASSWORD STRENGTH HELPER METHODS (Add to Component)
============================================================ -->
@php
    // These methods are added to the component
    // They are included here for reference
@endphp

<!-- Sidebar Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggleBtn');
        const sidebar = document.querySelector('.profile-wrapper .main-sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                sidebar.classList.toggle('open');
                if (overlay) {
                    overlay.classList.toggle('active');
                }
                document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                if (sidebar) sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // Bio character counter
    document.addEventListener('livewire:init', function() {
        Livewire.on('profileUpdated', () => {
            // Handle any post-update actions
        });
    });
</script>