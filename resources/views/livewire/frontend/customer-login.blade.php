{{-- resources/views/livewire/frontend/customer-login.blade.php --}}
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-hero">
            <div class="auth-hero-content">
                <span class="d-inline-flex align-items-center justify-content-center badge rounded-pill bg-warning text-dark mb-3" style="font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase;">Customer Login</span>
                <h2>Welcome Back</h2>
                <p>Login to access your shopping cart, saved items, and checkout quickly.</p>
            </div>
        </div>

        <div class="auth-body">
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="fas fa-envelope me-1 text-warning"></i>Email Address
                </label>
                <input type="email"
                       wire:model="email"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="email@gmail.com"
                       autofocus>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">
                    <i class="fas fa-lock me-1 text-warning"></i>Password
                </label>
                <input type="password"
                       wire:model="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="enter password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" wire:model="remember"
                           class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">
                        Remember Me
                    </label>
                </div>
            </div>

            <button wire:click="login"
                    wire:loading.attr="disabled"
                    class="btn btn-primary w-100 py-2 fw-semibold">
                <span wire:loading.remove>
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </span>
                <span wire:loading>
                    <i class="fas fa-spinner fa-spin me-2"></i>Logging in... 
                </span>
            </button>

            <hr class="my-4" style="border-color: rgba(255,255,255,0.1)">

            <p class="text-center mb-0 small">
                Not Have An Account?
                <a href="{{ route('customer.register') }}" wire:navigate class="fw-semibold">
                    Register
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
