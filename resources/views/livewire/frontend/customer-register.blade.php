{{-- resources/views/livewire/frontend/customer-register.blade.php --}}
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-hero">
            <div class="auth-hero-content">
                <span class="d-inline-flex align-items-center justify-content-center badge rounded-pill bg-warning text-dark mb-2" style="font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase;">Customer Register</span>
                <h2 class="mb-1">Welcome</h2>
                <p>Register to access your shopping cart, saved items, and checkout quickly.</p>
            </div>
        </div>

        <div class="auth-body">
            <div class="mb-2">
                <label class="form-label fw-semibold">
                    <i class="fas fa-user me-1 text-warning"></i>Full Name
                </label>
                <input type="text"
                       wire:model="name"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="enter your name here..."
                       autofocus>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">
                    <i class="fas fa-envelope me-1 text-warning"></i>Email Address
                </label>
                <input type="email"
                       wire:model="email"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="enter your email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label fw-semibold">
                    <i class="fas fa-lock me-1 text-warning"></i>Password
                </label>
                <input type="password"
                       wire:model="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder=" enter password ">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="fas fa-lock me-1 text-warning"></i>Confirm Password
                </label>
                <input type="password"
                       wire:model="password_confirmation"
                       class="form-control"
                       placeholder="confirm your password">
            </div>

            <button wire:click="register"
                    wire:loading.attr="disabled"
                    class="btn btn-primary w-100 py-2 fw-semibold">
                <span wire:loading.remove>
                    <i class="fas fa-user-plus me-2"></i>Register
                </span>
                <span wire:loading>
                    <i class="fas fa-spinner fa-spin me-2"></i>Registering...
                </span>
            </button>

            <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.16)">

            <p class="text-center mb-0 small">
                Already Have An Account?
                <a href="{{ route('customer.login') }}" wire:navigate class="fw-semibold">
                    Login
                </a>
            </p>

            <div class="auth-footer">
                <a href="{{ route('products') }}" wire:navigate class="text-muted small">
                    <i class="fas fa-arrow-left me-1"></i>continue shopping
                </a>
            </div>
        </div>
    </div>
</div>
