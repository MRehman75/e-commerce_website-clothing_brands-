<div>
    <!-- ============================================================
    PAGE HEADER - With Background Image
    ============================================================ -->
    <div class="page-header">
        <div class="container">
            <h1>New Arrivals</h1>
            <p>Discover the latest additions to our collection</p>
        </div>
    </div>

    <!-- ============================================================
    PRODUCTS GRID
    ============================================================ -->
    <section class="section-spacer" style="background:#fafafa;">
        <div class="container">
            @if(isset($products) && $products->count() > 0)
                <div class="row g-3 g-md-4">
                    @foreach($products as $product)
                    <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                        <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none color-inherit">
                            <div class="product-card">
                                <div class="img-wrap">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" />
                                    @else
                                        <img src="https://via.placeholder.com/400x500/FAFAFA/999?text=No+Image" alt="{{ $product->name }}" />
                                    @endif

                                    @if($product->gallery && is_array($product->gallery) && count($product->gallery) > 0)
                                        <img class="hover-img" src="{{ asset('storage/'.$product->gallery[0]) }}" alt="{{ $product->name }}" />
                                    @endif

                                    <span class="badge-modern">NEW</span>

                                    @if($product->compare_price && $product->price < $product->compare_price)
                                        @php
                                            $discount = round((($product->compare_price - $product->price) / $product->compare_price) * 100);
                                        @endphp
                                        <span class="badge-modern" style="background:#dc3545; left:70px;">-{{ $discount }}%</span>
                                    @endif

                                    <div class="quick-actions">
                                        <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <i class="bi bi-heart"></i>
                                        <i class="bi bi-bag-plus"></i>
                                    </div>
                                </div>

                                <div class="product-info">
                                    <h6>{{ $product->name }}</h6>
                                    <div>
                                        <span class="price">${{ number_format($product->price, 2) }}</span>
                                        @if($product->compare_price)
                                            <span class="old-price">${{ number_format($product->compare_price, 2) }}</span>
                                        @endif
                                    </div>
                                    @if($product->category)
                                        <small class="text-muted d-block" style="font-size:0.6rem; text-transform:uppercase; letter-spacing:0.05em; margin-top:4px;">
                                            {{ $product->category->name }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                    <h5>No New Arrivals</h5>
                    <p class="text-muted">Check back soon for new products!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ============================================================
    STYLES
    ============================================================ -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0a0a0a;
            --gold: #C9A227;
            --beige: #F5F1EB;
            --bg-light: #FAFAFA;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-body);
            color: #1a1a1a;
            background: #fff;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        .heading-font {
            font-family: var(--font-heading);
            font-weight: 600;
            letter-spacing: 0.01em;
        }

        .gold {
            color: var(--gold);
        }

        /* ============================================================
           PAGE HEADER - With Background Image
        ============================================================ */
        .page-header {
            padding: 80px 0;
            text-align: center;
            position: relative;
            background: linear-gradient(135deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.2) 100%),
                        url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600&auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .page-header h1 {
            font-family: var(--font-heading);
            font-size: 3.2rem;
            font-weight: 300;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
            color: #fff;
            text-shadow: 0 4px 30px rgba(0,0,0,0.2);
        }

        .page-header p {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 300;
            color: rgba(255,255,255,0.85);
        }

        /* ============================================================
           SECTION SPACING
        ============================================================ */
        .section-spacer {
            padding: 80px 0;
        }

        /* ============================================================
           PRODUCT CARDS
        ============================================================ */
        .product-card {
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            transition: 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.02);
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 56px rgba(0, 0, 0, 0.04);
        }

        .product-card .img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1/1.2;
        }

        .product-card .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card:hover .img-wrap img {
            transform: scale(1.02);
        }

        .product-card .img-wrap .hover-img {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .product-card:hover .img-wrap .hover-img {
            opacity: 1;
        }

        .product-card .product-info {
            padding: 1rem 0.8rem 1.2rem;
        }

        .product-card .product-info h6 {
            font-weight: 400;
            font-size: 0.85rem;
            margin-bottom: 0.1rem;
        }

        .product-card .product-info .price {
            font-weight: 500;
            color: #111;
            font-size: 0.85rem;
        }

        .product-card .product-info .old-price {
            color: #bbb;
            text-decoration: line-through;
            font-size: 0.75rem;
            margin-left: 0.4rem;
        }

        .badge-modern {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--gold);
            color: #fff;
            font-size: 0.5rem;
            letter-spacing: 0.1em;
            padding: 0.2rem 0.8rem;
            border-radius: 40px;
            font-weight: 500;
            z-index: 5;
        }

        .quick-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 0.8rem;
            background: linear-gradient(0deg, rgba(255, 255, 255, 0.92) 0%, transparent 100%);
            transform: translateY(100%);
            transition: 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: flex;
            justify-content: center;
            gap: 0.6rem;
            opacity: 0;
            z-index: 6;
        }

        .product-card:hover .quick-actions {
            transform: translateY(0);
            opacity: 1;
        }

        .quick-actions i {
            background: #fff;
            padding: 0.4rem 0.6rem;
            border-radius: 60px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            font-size: 0.8rem;
            color: #333;
            transition: 0.2s;
            cursor: pointer;
        }

        .quick-actions i:hover {
            background: var(--gold);
            color: #fff;
        }

        .text-decoration-none {
            text-decoration: none !important;
        }

        .color-inherit {
            color: inherit !important;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 768px) {
            .section-spacer {
                padding: 50px 0;
            }

            .page-header {
                padding: 50px 0 30px;
            }

            .page-header h1 {
                font-size: 2.4rem;
            }
        }
    </style>

    <!-- ============================================================
    SCRIPTS
    ============================================================ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true,
            easing: 'ease-out-cubic'
        });
    </script>
</div>