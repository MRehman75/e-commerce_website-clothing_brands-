<x-layouts.app>
<div>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VELENZA · Men</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

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

        /* PAGE HEADER */
        .page-header {
            padding: 60px 0 40px;
            text-align: center;
            background: var(--bg-light);
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .page-header h1 {
            font-family: var(--font-heading);
            font-size: 3.2rem;
            font-weight: 300;
            letter-spacing: 0.08em;
            margin-bottom: 8px;
        }

        .page-header p {
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 300;
            color: #888;
        }

        /* SECTION SPACING */
        .section-spacer {
            padding: 80px 0;
        }

        /* CATEGORY BANNER */
        .category-banner {
            position: relative;
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 40px;
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

        /* PRODUCT CARDS */
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

        @media (max-width: 768px) {
            .section-spacer {
                padding: 50px 0;
            }

            .page-header {
                padding: 40px 0 30px;
            }

            .page-header h1 {
                font-size: 2.4rem;
            }

            .category-banner {
                height: 280px;
            }

            .category-banner .banner-overlay h2 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>

<body>

    <!-- ============================================================
    PAGE HEADER
    ============================================================ -->
    <div class="page-header">
        <div class="container">
            <h1>Men</h1>
            <p>Sharp, sophisticated style for the modern gentleman</p>
        </div>
    </div>

    <!-- ============================================================
    CATEGORY BANNER
    ============================================================ -->
    <div class="container">
        <div class="category-banner" data-aos="fade-up">
            <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?w=1200&auto=format&fit=crop&q=80"
                alt="Men Collection" />
            <div class="banner-overlay">
                <h2>Men's Collection</h2>
                <p>Premium menswear crafted for confidence and style</p>
            </div>
        </div>
    </div>

    <!-- ============================================================
    PRODUCTS GRID
    ============================================================ -->
    <section class="section-spacer" style="background:#fafafa;">
        <div class="container">
            <div class="row g-3 g-md-4">
                <!-- Product 1 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="50">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=400&auto=format&fit=crop"
                                alt="Product hover" />
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Premium Blazer</h6>
                            <span class="price">$199</span>
                        </div>
                    </div>
                </div>
                <!-- Product 2 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1554568218-0f1715e72254?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1554568218-0f1715e72254?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-modern" style="background:#111;">NEW</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Oxford Shirt</h6>
                            <span class="price">$84</span>
                        </div>
                    </div>
                </div>
                <!-- Product 3 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="150">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Wool Overcoat</h6>
                            <span class="price">$299</span>
                        </div>
                    </div>
                </div>
                <!-- Product 4 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Slim Fit Chinos</h6>
                            <span class="price">$79</span>
                        </div>
                    </div>
                </div>
                <!-- Product 5 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <span class="badge-modern">SALE</span>
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Leather Belt</h6>
                            <span class="price">$49</span><span class="old-price">$69</span>
                        </div>
                    </div>
                </div>
                <!-- Product 6 -->
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="product-card">
                        <div class="img-wrap">
                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&auto=format&fit=crop"
                                alt="Product" />
                            <img class="hover-img"
                                src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=400&auto=format&fit=crop&crop=center&v=2"
                                alt="Product hover" />
                            <div class="quick-actions"><i class="bi bi-eye"></i><i class="bi bi-heart"></i><i
                                    class="bi bi-bag-plus"></i></div>
                        </div>
                        <div class="product-info">
                            <h6>Leather Boots</h6>
                            <span class="price">$189</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
</body>

</html>
</div>
</x-layouts.app>
