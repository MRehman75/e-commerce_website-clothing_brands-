<x-layouts.app>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="mb-3">My Profile</h2>
                        <p class="text-muted">Manage your account details and logout when you are finished.</p>

                        <div class="mb-4">
                            <h5>Name</h5>
                            <p>{{ auth()->user()->name }}</p>
                        </div>
                        <div class="mb-4">
                            <h5>Email</h5>
                            <p>{{ auth()->user()->email }}</p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('products') }}" class="btn btn-outline-dark">Continue Shopping</a>
                            <form method="POST" action="{{ route('customer.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
