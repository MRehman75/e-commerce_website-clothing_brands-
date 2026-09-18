<x-layouts.app>
<div>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VELENZA · Collections</title>

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

        /* COLLECTION CARDS */
        .collection-card {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            height: 400px;
            transition: 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
        }

        .collection-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .collection-card:hover img {
            transform: scale(1.05);
        }

        .collection-card .collection-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.1) 60%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding: 2.5rem;
            color: #fff;
            text-align: center;
        }

        .collection-card .collection-overlay h3 {
            font-family: var(--font-heading);
            font-size: 2rem;
            font-weight: 300;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }

        .collection-card .collection-overlay p {
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 300;
            opacity: 0.7;
        }

        .collection-card .collection-overlay .shop-link {
            font-family: var(--font-body);
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            text-decoration: none;
            margin-top: 12px;
            padding: 8px 24px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 40px;
            transition: 0.3s;
        }

        .collection-card .collection-overlay .shop-link:hover {
            background: var(--gold);
            color: #fff;
            border-color: var(--gold);
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

            .collection-card {
                height: 300px;
            }

            .collection-card .collection-overlay h3 {
                font-size: 1.6rem;
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
            <h1>Collections</h1>
            <p>Explore our curated seasonal collections</p>
        </div>
    </div>

    <!-- ============================================================
    COLLECTIONS GRID
    ============================================================ -->
    <section class="section-spacer">
        <div class="container">
            <div class="row g-4">
                <!-- Collection 1 -->
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="50">
                    <div class="collection-card">
                        <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800&auto=format&fit=crop&q=80"
                            alt="Summer Collection" />
                        <div class="collection-overlay">
                            <h3>Summer 2026</h3>
                            <p>Light, breathable fabrics for the warm season</p>
                            <a href="#" class="shop-link">Explore</a>
                        </div>
                    </div>
                </div>
                <!-- Collection 2 -->
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="collection-card">
                        <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=800&auto=format&fit=crop&q=80"
                            alt="Autumn Collection" />
                        <div class="collection-overlay">
                            <h3>Autumn 2026</h3>
                            <p>Rich textures and warm earth tones</p>
                            <a href="#" class="shop-link">Explore</a>
                        </div>
                    </div>
                </div>
                <!-- Collection 3 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="collection-card" style="height:350px;">
                        <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=600&auto=format&fit=crop&q=80"
                            alt="Luxury Edit" />
                        <div class="collection-overlay">
                            <h3>Luxury Edit</h3>
                            <p>Premium pieces for the discerning</p>
                            <a href="#" class="shop-link">Explore</a>
                        </div>
                    </div>
                </div>
                <!-- Collection 4 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="collection-card" style="height:350px;">
                        <img src="https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=600&auto=format&fit=crop&q=80"
                            alt="Essentials" />
                        <div class="collection-overlay">
                            <h3>Essentials</h3>
                            <p>Timeless wardrobe staples</p>
                            <a href="#" class="shop-link">Explore</a>
                        </div>
                    </div>
                </div>
                <!-- Collection 5 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="collection-card" style="height:350px;">
                        <img src="https://images.unsplash.com/photo-1548036328-c9fa89d128fa?w=600&auto=format&fit=crop&q=80"
                            alt="Accessories" />
                        <div class="collection-overlay">
                            <h3>Accessories</h3>
                            <p>Complete your look with the perfect accents</p>
                            <a href="#" class="shop-link">Explore</a>
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
