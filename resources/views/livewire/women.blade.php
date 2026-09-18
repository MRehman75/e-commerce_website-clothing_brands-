<div>
    <!-- ============================================================
    PAGE HEADER - With Background Image
    ============================================================ -->
    <!-- <div class="page-header">
        <div class="container">
            <h1>Women</h1>
            <p>Elegant, timeless pieces for the modern woman</p>
        </div>
    </div> -->

    <!-- ============================================================
    CATEGORY BANNER
    ============================================================ -->
    <div class="container">
        <div class="category-banner" data-aos="fade-up">
            <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=1200&auto=format&fit=crop&q=80"
                alt="Women Collection" />
            <div class="banner-overlay">
                <h2>Women's Collection</h2>
                <p>Discover our curated selection of premium women's fashion</p>
            </div>
        </div>
    </div>

    <!-- ============================================================
    CATEGORY WISE PRODUCTS
    ============================================================ -->
    @foreach($categories as $category)
        <section class="section-spacer" style="{{ $loop->first ? 'padding-top:20px;' : 'padding-top:40px;' }} background:{{ $loop->iteration % 2 == 0 ? '#fafafa;' : '#ffffff;' }}">
            <div class="container">

                <!-- Category Header -->
                <div class="category-header d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="category-title">{{ $category->name }}</h2>
                        <p class="category-subtitle">Explore our {{ $category->name }} collection</p>
                    </div>
                    <a href="{{ route('category.show', $category->slug) }}" class="view-all-btn">
                        View All <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <!-- Products Grid -->
                <div class="row g-3 g-md-4">
                    @if(isset($categoryProducts[$category->id]) && $categoryProducts[$category->id]->count() > 0)
                        @foreach($categoryProducts[$category->id] as $product)
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

                                        @if($product->badge)
                                            <span class="badge-modern">{{ $product->badge }}</span>
                                        @endif

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
                                        <small class="text-muted d-block" style="font-size:0.6rem; text-transform:uppercase; letter-spacing:0.05em; margin-top:4px;">
                                            {{ $product->category->name ?? 'Uncategorized' }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-4">
                            <p class="text-muted">No products available in this category.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach

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

        h1, h2, h3, h4, h5, .heading-font {
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
            background: linear-gradient(135deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.15) 100%),
                        url('https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=1600&auto=format&fit=crop&q=80');
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
           CATEGORY BANNER
        ============================================================ */
        .category-banner {
            position: relative;
            height: 350px;
            border-radius: 20px;
            overflow: hidden;
            margin: 20px 0 40px;
        }

        .category-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .category-banner .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.1) 60%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .category-banner .banner-overlay h2 {
            font-family: var(--font-heading);
            font-size: 3rem;
            font-weight: 300;
            letter-spacing: 0.08em;
            margin-bottom: 12px;
        }

        .category-banner .banner-overlay p {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 300;
            max-width: 500px;
            opacity: 0.8;
        }

        /* ============================================================
           CATEGORY HEADER
        ============================================================ */
        .category-title {
            font-family: var(--font-heading);
            font-size: 1.8rem;
            font-weight: 300;
            letter-spacing: 0.04em;
            margin-bottom: 2px;
            color: var(--primary);
        }

        .category-subtitle {
            font-family: var(--font-body);
            font-size: 0.8rem;
            font-weight: 300;
            color: #999;
        }

        .view-all-btn {
            font-family: var(--font-body);
            font-size: 0.7rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #666;
            text-decoration: none;
            padding: 6px 18px;
            border: 1px solid #e5e5e5;
            border-radius: 40px;
            transition: 0.3s;
        }

        .view-all-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
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

            .category-banner {
                height: 220px;
            }

            .category-banner .banner-overlay h2 {
                font-size: 2rem;
            }

            .category-title {
                font-size: 1.4rem;
            }

            .view-all-btn {
                font-size: 0.6rem;
                padding: 4px 14px;
            }
        }

        @media (max-width: 576px) {
            .category-banner {
                height: 180px;
                margin: 10px 0 20px;
            }

            .category-banner .banner-overlay h2 {
                font-size: 1.6rem;
            }

            .category-banner .banner-overlay p {
                font-size: 0.85rem;
            }

            .category-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
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