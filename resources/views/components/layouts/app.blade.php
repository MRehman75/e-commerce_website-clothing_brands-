<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- ============================================================
    SEO HEAD - Dynamic Meta Tags
    ============================================================ --}}
    @include('partials.seo.head')

    {{-- ============================================================
    EXTERNAL STYLES
    ============================================================ --}}
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Font Awesome 6 (Free) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        /* ============================================================
           GLOBAL RESET & ROOTS
        ============================================================ */
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
           TOP BAR - Minimal & Elegant
        ============================================================ */
        .top-bar {
            height: 36px;
            background: var(--primary);
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.6rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        }

        .top-bar .gold-sep {
            color: var(--gold);
            margin: 0 8px;
            font-weight: 300;
            font-size: 0.5rem;
        }

        .top-bar a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: 0.2s;
            font-size: 0.6rem;
        }

        .top-bar a:hover {
            color: var(--gold);
        }

        .top-bar .social-icons i {
            font-size: 0.7rem;
            margin-left: 0.8rem;
            color: rgba(255, 255, 255, 0.3);
            transition: 0.2s;
        }

        .top-bar .social-icons i:hover {
            color: var(--gold);
        }

        .dropdown-menu {
            z-index: 2000 !important;
        }

        .auth-page {
            min-height: calc(100vh - 160px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0.75rem;
        }

        .auth-card {
            width: 100%;
            max-width: 560px;
            margin: auto;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 100px rgba(0, 0, 0, 0.12);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(20, 28, 40, 0.85));
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .auth-hero {
            position: relative;
            min-height: 120px;
            background: linear-gradient(135deg, rgba(201, 162, 39, 0.12), rgba(23, 44, 78, 0.85)),
                url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 1.25rem 1.25rem 0.9rem 1.25rem;
        }

        .auth-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(10, 22, 39, 0.75) 75%);
        }

        .auth-hero-content {
            position: relative;
            z-index: 1;
            color: #fff;
        }

        .auth-hero h2 {
            margin-bottom: 0.5rem;
            font-family: var(--font-heading);
            font-size: 2rem;
        }

        .auth-body {
            padding: 1.25rem;
        }

        .auth-card .form-control {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #fff;
            box-shadow: none;
        }

        .auth-card .form-control:focus {
            border-color: rgba(201, 162, 39, 0.9);
            box-shadow: 0 0 0 0.2rem rgba(201, 162, 39, 0.12);
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        .auth-card .form-label {
            color: rgba(255, 255, 255, 0.9);
        }

        .auth-card .btn-primary {
            background: linear-gradient(135deg, #c9a227 0%, #f9d76a 100%);
            border: none;
            color: #111;
            font-weight: 700;
        }

        .auth-card .btn-primary:hover {
            background: linear-gradient(135deg, #d4b63a 0%, #ffd76f 100%);
        }

        .auth-card .text-muted,
        .auth-card .small {
            color: rgba(255, 255, 255, 0.7);
        }

        .auth-card a {
            color: #f3d27f;
        }

        .auth-card a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .auth-footer {
            margin-top: 1rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .auth-page {
                padding: 1.5rem 0.55rem;
            }

            .auth-hero {
                min-height: 90px;
                padding: 0.9rem;
            }
        }

        /* ============================================================
           LOGO + NAVIGATION BAR - Split Layout (Logo Centered)
        ============================================================ */
        .main-header {
            position: sticky;
            top: 0;
            z-index: 1040;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            transition: background 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.02);
        }

        .main-header.navbar-scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 40px rgba(0, 0, 0, 0.04);
        }

        .main-header .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 3rem;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Left Navigation - Categories */
        .nav-left {
            display: flex;
            align-items: center;
            gap: 32px;
            flex: 1;
        }

        .nav-left a {
            font-family: var(--font-body);
            font-weight: 400;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #333;
            text-decoration: none;
            position: relative;
            transition: 0.2s;
            padding: 4px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-left a i {
            font-size: 1.6rem;
            color: var(--gold);
            opacity: 0.6;
            transition: 0.2s;
        }

        .nav-left a:hover i {
            opacity: 1;
        }

        .nav-left a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 1.5px;
            background: var(--gold);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .nav-left a:hover::after {
            transform: scaleX(1);
        }

        .nav-left a:hover {
            color: #000;
        }

        /* Center Logo */
        .header-logo {
            flex: 0 0 auto;
            padding: 0 40px;
            text-align: center;
        }

        .header-logo img {
            height: 110px;
            width: auto;
            display: block;
            object-fit: contain;
            filter: drop-shadow(0 4px 24px rgba(0, 0, 0, 0.06));
            animation: logoEntrance 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(-8px) scale(0.96);
            transition: transform 0.3s ease;
        }

        .header-logo img:hover {
            transform: scale(1.03);
        }

        @keyframes logoEntrance {
            0% {
                opacity: 0;
                transform: translateY(-15px) scale(0.94);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Right Navigation - Home, Sale, About, Contact */
        .nav-right {
            display: flex;
            align-items: center;
            gap: 32px;
            flex: 1;
            justify-content: flex-end;
        }

        .nav-right a {
            font-family: var(--font-body);
            font-weight: 400;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #333;
            text-decoration: none;
            position: relative;
            transition: 0.2s;
            padding: 4px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-right a i {
            font-size: 1.6rem;
            color: var(--gold);
            opacity: 0.6;
            transition: 0.2s;
        }

        .nav-right a:hover i {
            opacity: 1;
        }

        .nav-right a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 1.5px;
            background: var(--gold);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .nav-right a:hover::after {
            transform: scaleX(1);
        }

        .nav-right a:hover {
            color: #000;
        }

        .nav-right .icon-link {
            font-size: 1rem;
            color: #333;
            text-decoration: none;
            transition: 0.2s;
            position: relative;
            padding: 4px 0;
            gap: 0;
        }

        .nav-right .icon-link i {
            font-size: 1.8rem;
            color: #333;
            opacity: 1;
        }

        .nav-right .icon-link:hover {
            color: var(--gold);
        }

        .nav-right .icon-link:hover i {
            color: var(--gold);
        }

        .nav-right .icon-link {
            position: relative;
            text-decoration: none;
            color: #333;
        }

        .bag-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #C9A227;
            color: #fff;
            font-size: 9px;
            font-weight: 600;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            animation: popIn 0.3s ease;
        }

        @keyframes popIn {
            0% {
                transform: scale(0);
            }

            80% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .nav-divider {
            color: #ddd;
            font-weight: 300;
            font-size: 1.2rem;
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #333;
            cursor: pointer;
            padding: 4px;
        }

        .mobile-toggle:hover {
            color: var(--gold);
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            flex-direction: column;
            padding: 16px 2rem 24px;
            background: #fff;
            border-top: 1px solid rgba(0, 0, 0, 0.04);
        }

        .mobile-menu a {
            font-family: var(--font-body);
            font-weight: 400;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #333;
            text-decoration: none;
            padding: 10px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mobile-menu a i {
            color: var(--gold);
            width: 20px;
        }

        .mobile-menu a:hover {
            color: var(--gold);
        }

        .mobile-menu .mobile-icons {
            display: flex;
            gap: 24px;
            padding-top: 12px;
        }

        .mobile-menu .mobile-icons a {
            border: none;
            font-size: 1.1rem;
            padding: 4px 0;
        }

        .mobile-menu .mobile-icons a i {
            font-size: 1.2rem;
            width: auto;
        }

        /* ============================================================
           PROFILE AVATAR
        ============================================================ */
        .profile-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #C9A227, #f9d76a);
            color: #0a0a0a;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 16px rgba(201, 162, 39, 0.3);
        }

        .profile-avatar-small {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #C9A227, #f9d76a);
            color: #0a0a0a;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        .dropdown-item:hover {
            background: #f8f9fa;
        }

        .dropdown-item i {
            color: #C9A227;
        }

        @media (max-width: 1200px) {
            .main-header .header-inner {
                padding: 12px 2rem;
            }

            .nav-left {
                gap: 24px;
            }

            .nav-right {
                gap: 24px;
            }

            .header-logo {
                padding: 0 24px;
            }

            .header-logo img {
                height: 65px;
            }
        }

        @media (max-width: 992px) {
            .nav-left a:not(.keep-desktop) {
                display: none;
            }

            .nav-right a:not(.icon-link) {
                display: none;
            }

            .mobile-toggle {
                display: block;
            }

            .mobile-menu.open {
                display: flex;
            }

            .header-logo img {
                height: 55px;
            }

            .main-header .header-inner {
                padding: 10px 1.2rem;
            }

            .header-logo {
                padding: 0 16px;
            }
        }

        @media (max-width: 576px) {
            .header-logo img {
                height: 44px;
            }

            .main-header .header-inner {
                padding: 8px 1rem;
            }

            .nav-right .icon-link i {
                font-size: 1rem;
            }

            .nav-right {
                gap: 16px;
            }

            .header-logo {
                padding: 0 10px;
            }
        }

        .customer-sidebar {
            background: #111;
            color: white;
            padding: 25px;
            border-radius: 12px;
        }

        .sidebar-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a,
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 15px;
            color: #ddd;
            text-decoration: none;
            border-radius: 8px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active,
        .logout-btn:hover {
            background: #fff;
            color: #111;
        }

        /* ============================================================
           HERO SLIDER - Clean & Cinematic
        ============================================================ */
        .hero-slider {
            height: 85vh;
            min-height: 600px;
            position: relative;
            overflow: hidden;
        }

        .hero-slider .carousel-item {
            height: 85vh;
            min-height: 600px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-slider .carousel-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.1) 60%);
        }

        .hero-slider .carousel-item .hero-content {
            position: absolute;
            top: 50%;
            left: 8%;
            transform: translateY(-50%);
            z-index: 10;
            color: #fff;
            max-width: 580px;
        }

        .hero-slider .carousel-item .hero-content .hero-label {
            font-size: 0.6rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(4px);
            display: inline-block;
            padding: 0.3rem 1.2rem;
            border-radius: 40px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            margin-bottom: 1.2rem;
        }

        .hero-slider .carousel-item .hero-content h1 {
            font-size: clamp(2.8rem, 8vw, 4.8rem);
            font-weight: 700;
            line-height: 1.05;
            letter-spacing: -0.02em;
            text-shadow: 0 4px 40px rgba(0, 0, 0, 0.15);
        }

        .hero-slider .carousel-item .hero-content p {
            font-size: 1rem;
            font-weight: 300;
            max-width: 420px;
            opacity: 0.85;
            margin: 1.2rem 0 2rem;
            letter-spacing: 0.02em;
            line-height: 1.7;
        }

        .btn-hero {
            background: #fff;
            color: #111;
            border: none;
            padding: 0.7rem 2.4rem;
            border-radius: 60px;
            font-weight: 500;
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            transition: 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 0 6px 28px rgba(0, 0, 0, 0.06);
            margin-right: 0.8rem;
        }

        .btn-hero:hover {
            background: var(--gold);
            color: #fff;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 40px rgba(201, 162, 39, 0.15);
        }

        .btn-hero-outline {
            background: transparent;
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            color: #fff;
            backdrop-filter: blur(4px);
        }

        .btn-hero-outline:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: #fff;
            color: #fff;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            padding: 18px;
            background-size: 40%;
            backdrop-filter: blur(4px);
            transition: 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .carousel-control-prev-icon:hover,
        .carousel-control-next-icon:hover {
            background-color: var(--gold);
            border-color: var(--gold);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 12;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.55rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.3rem;
            animation: floatDown 2.4s ease-in-out infinite;
        }

        .scroll-indicator i {
            font-size: 1rem;
        }

        @keyframes floatDown {
            0% {
                transform: translateX(-50%) translateY(0);
                opacity: 0.3;
            }

            50% {
                transform: translateX(-50%) translateY(8px);
                opacity: 0.8;
            }

            100% {
                transform: translateX(-50%) translateY(0);
                opacity: 0.3;
            }
        }

        /* ============================================================
           SECTION SPACING
        ============================================================ */
        .section-spacer {
            padding: 80px 0;
        }

        .section-spacer-sm {
            padding: 50px 0;
        }

        .section-title {
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        .section-sub {
            font-size: 0.6rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 0.3rem;
        }

        /* ============================================================
           CATEGORIES - Clean Magazine Style
        ============================================================ */
        .category-card {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            height: 280px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.02);
            transition: 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .category-card:hover img {
            transform: scale(1.05);
        }

        .category-card:hover {
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.05);
        }

        .category-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.35) 0%, transparent 60%);
            display: flex;
            align-items: flex-end;
            padding: 1.8rem;
        }

        .category-overlay h5 {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .category-card {
                height: 200px;
            }
        }

        /* ============================================================
           PRODUCT CARDS - Clean & Premium
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

        /* ============================================================
           PROMO - Clean Campaign
        ============================================================ */
        .promo-campaign {
            background: url('https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=1200&auto=format&fit=crop&q=80') center 40% / cover no-repeat;
            padding: 80px 0;
            position: relative;
            border-radius: 20px;
            margin: 10px 0;
        }

        .promo-campaign::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.15) 70%);
            border-radius: 20px;
        }

        .promo-campaign * {
            position: relative;
            z-index: 2;
        }

        .promo-campaign .countdown {
            font-size: 2.4rem;
            font-weight: 300;
            letter-spacing: 0.1em;
            color: var(--gold);
        }

        /* ============================================================
           FEATURES - Clean Cards
        ============================================================ */
        .feature-card {
            background: #fff;
            border: 1px solid #f0f0f0;
            border-radius: 20px;
            padding: 2rem 1rem;
            text-align: center;
            transition: 0.4s;
            height: 100%;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.01);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.03);
            border-color: rgba(201, 162, 39, 0.15);
        }

        .feature-card i {
            font-size: 2.2rem;
            color: var(--gold);
        }

        .feature-card h6 {
            margin-top: 0.8rem;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* ============================================================
           TESTIMONIALS
        ============================================================ */
        .testimonial-card {
            background: #fff;
            border-radius: 20px;
            padding: 1.8rem 1.8rem 2rem;
            box-shadow: 0 4px 28px rgba(0, 0, 0, 0.01);
            border: 1px solid #f2f2f2;
            transition: 0.3s;
            height: 100%;
        }

        .testimonial-card:hover {
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.02);
        }

        .testimonial-card .quote {
            font-size: 2.8rem;
            line-height: 0.6;
            color: var(--gold);
            opacity: 0.2;
        }

        .testimonial-card .stars i {
            color: var(--gold);
            font-size: 0.8rem;
            margin-right: 2px;
        }

        /* ============================================================
           NEWSLETTER
        ============================================================ */
        .newsletter-premium {
            background: var(--beige);
            border-radius: 20px;
            padding: 60px 30px;
            background-image: url('https://images.unsplash.com/photo-1523381210434-271e8be1f52b?w=800&auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .newsletter-premium::before {
            content: '';
            inset: 0;
            position: absolute;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(4px);
            border-radius: 20px;
        }

        .newsletter-premium * {
            position: relative;
            z-index: 2;
        }

        .newsletter-premium input {
            border: 1px solid #ddd;
            border-radius: 60px;
            padding: 0.7rem 1.4rem;
            background: rgba(255, 255, 255, 0.8);
        }

        .newsletter-premium input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.06);
            background: #fff;
        }

        .btn-gold {
            background: var(--gold);
            border: none;
            padding: 0.7rem 2rem;
            border-radius: 60px;
            font-weight: 500;
            color: #fff;
            transition: 0.25s;
            font-size: 0.8rem;
            letter-spacing: 0.08em;
        }

        .btn-gold:hover {
            background: #b8911f;
            color: #fff;
            transform: scale(1.02);
        }

        /* ============================================================
           FOOTER
        ============================================================ */
        .footer-lux {
            background: var(--primary);
            color: rgba(255, 255, 255, 0.5);
            padding: 50px 0 25px;
        }

        .footer-lux h5 {
            color: #fff;
            font-weight: 400;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            letter-spacing: 0.08em;
        }

        .footer-lux a {
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            transition: 0.2s;
            font-size: 0.8rem;
        }

        .footer-lux a:hover {
            color: var(--gold);
        }

        .footer-lux .social-circle {
            display: inline-block;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.06);
            text-align: center;
            line-height: 36px;
            color: rgba(255, 255, 255, 0.3);
            transition: 0.2s;
            margin-right: 6px;
        }

        .footer-lux .social-circle:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media (max-width: 768px) {
            .hero-slider {
                height: 70vh;
                min-height: 450px;
            }

            .hero-slider .carousel-item {
                height: 70vh;
                min-height: 450px;
            }

            .hero-slider .carousel-item .hero-content {
                left: 5%;
                right: 5%;
                max-width: 100%;
            }

            .hero-slider .carousel-item .hero-content p {
                max-width: 100%;
            }

            .section-spacer {
                padding: 50px 0;
            }

            .promo-campaign {
                padding: 50px 0;
            }

            .top-bar .d-none {
                display: none !important;
            }
        }

        @media (max-width: 576px) {
            .hero-slider .carousel-item .hero-content h1 {
                font-size: 2rem;
            }

            .btn-hero {
                padding: 0.5rem 1.4rem;
                font-size: 0.6rem;
            }

            .hero-slider {
                height: 60vh;
                min-height: 380px;
            }

            .hero-slider .carousel-item {
                height: 60vh;
                min-height: 380px;
            }
        }
    </style>

    @livewireStyles
    @stack('styles')
</head>

<body>

    <!-- ============================================================
    TOP BAR
    ============================================================ -->
    <div class="top-bar">
        <div class="container-fluid d-flex justify-content-between align-items-center px-3 px-md-4">
            <div class="d-none d-md-block">
                <span class="gold-sep">✦</span> Free Shipping <span class="gold-sep">|</span> Complimentary Returns
            </div>
            <div class="d-none d-lg-block">
                <span class="gold-sep">—</span> Summer Collection 2026 <span class="gold-sep">—</span>
            </div>
            <div class="d-flex align-items-center">
                @guest
                <a href="{{ route('customer.login') }}" class="text-white text-decoration-none" style="font-size:0.6rem; letter-spacing:0.12em; text-transform:uppercase;">
                    <i class="bi bi-person me-1"></i> Login
                </a>
                @else
                <a href="#" class="d-flex align-items-center text-white text-decoration-none" style="font-size:0.6rem; letter-spacing:0.12em; text-transform:uppercase;">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ auth()->user()->name ?? 'Profile' }}
                </a>
                <form id="customer-logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endguest
                <span class="gold-sep">|</span>
                <a href="#"><i class="bi bi-heart"></i></a>
                <span class="gold-sep">|</span>
                <a href="#"><i class="bi bi-box"></i></a>
                <span class="social-icons ms-2">
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-facebook"></i>
                    <i class="bi bi-pinterest"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- ============================================================
    MAIN HEADER - Logo + Split Navigation
    ============================================================ -->
    <header class="main-header" id="mainHeader">

        <div class="header-inner">
            <!-- Left Navigation - Categories -->
            <nav class="nav-left">
                @php
                $navCategories = App\Models\Category::where('status', 1)
                ->whereIn('name', ['Luxury', 'Embroidered', 'Lawn', 'New Arrivals'])
                ->orderBy('name')
                ->get();
                @endphp

                @foreach($navCategories as $category)
                <a href="{{ route('category.show', $category->slug) }}" class="keep-desktop">
                    @if($category->name == 'New Arrivals')
                    <i class="fas fa-star"></i>
                    @elseif($category->name == 'Luxury')
                    <i class="fas fa-gem"></i>
                    @elseif($category->name == 'Embroidered')
                    <i class="fas fa-tshirt"></i>
                    @elseif($category->name == 'Lawn')
                    <i class="fas fa-leaf"></i>
                    @else
                    <i class="fas fa-tag"></i>
                    @endif
                    {{ $category->name }}
                </a>
                @endforeach

                <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle Menu">
                    <i class="bi bi-list"></i>
                </button>
            </nav>

            <!-- Center Logo -->
            <div class="header-logo">
                <img src="{{ asset('velenza_logo.png') }}" alt="VELENZA">
            </div>

            <!-- Right Navigation - Home, Sale, About, Contact -->
            <nav class="nav-right">
                <a href="{{ route('home') }}" class="keep-desktop"><i class="fas fa-home"></i> Home</a>
                <a href="{{ route('category.show', 'sale') }}" class="keep-desktop"><i class="fas fa-tags"></i> Sale</a>
                <a href="{{ route('about') }}" class="keep-desktop"><i class="fas fa-info-circle"></i> About</a>
                <a href="{{ route('contact') }}" class="keep-desktop"><i class="fas fa-envelope"></i> Contact</a>
                <span class="nav-divider keep-desktop">|</span>

                <!-- Cart -->
                @livewire('cart-count')

                <!-- ============================================================
                PROFILE ICON WITH DROPDOWN
                ============================================================ -->
                @auth
                <div class="dropdown">
                    <a href="#" class="icon-link dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="display:flex; align-items:center; gap:6px;">
                        <span class="profile-avatar">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown" style="min-width: 180px; padding: 8px 0; border-radius: 12px; box-shadow: 0 12px 40px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.04);">
                        <li style="padding: 8px 16px 4px 16px; border-bottom: 1px solid rgba(0,0,0,0.04);">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <span class="profile-avatar-small">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                                </span>
                                <div>
                                    <div style="font-weight:600; font-size:0.85rem; color:#0a0a0a;">{{ auth()->user()->name }}</div>
                                    <div style="font-size:0.7rem; color:#6c757d;">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider" style="margin:4px 0;">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('customer.profile') }}" style="padding:8px 16px; font-size:0.85rem; color:#333;">
                                <i class="fas fa-user me-2" style="color:#C9A227; width:18px;"></i> Profile
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}" style="padding:8px 16px; font-size:0.85rem; color:#333;">
                                <i class="fas fa-th-large me-2" style="color:#C9A227; width:18px;"></i> Dashboard
                            </a></li>
                        <li>
                            <hr class="dropdown-divider" style="margin:4px 0;">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();" style="padding:8px 16px; font-size:0.85rem; color:#dc3545;">
                                <i class="fas fa-sign-out-alt me-2" style="color:#dc3545; width:18px;"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <form id="header-logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <a href="{{ route('customer.login') }}" class="icon-link" style="display:flex; align-items:center; gap:6px;">
                    <i class="fas fa-user-circle" style="font-size:1.8rem;"></i>
                </a>
                @endauth
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>

            @php
            $mobileCategories = App\Models\Category::where('status', 1)
            ->whereIn('name', ['Luxury', 'Embroidered', 'Lawn', 'New Arrivals', 'Sale'])
            ->orderBy('name')
            ->get();
            @endphp

            @foreach($mobileCategories as $category)
            <a href="{{ route('category.show', $category->slug) }}">
                <i class="fas fa-tag"></i> {{ $category->name }}
            </a>
            @endforeach

            <a href="{{ route('about') }}"><i class="fas fa-info-circle"></i> About</a>
            <a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a>
            <div class="mobile-icons">
                <a href="{{ route('cart') }}"><i class="fas fa-shopping-bag"></i></a>
            </div>
        </div>
    </header>

    {{ $slot }}

    <!-- ============================================================
    FOOTER
    ============================================================ -->
    <footer class="footer-lux">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>VELENZA</h5>
                    <p class="small" style="max-width:280px;">Timeless fashion for the modern Pakistani — where heritage
                        meets contemporary luxury.</p>
                    <div class="social-links">
                        @php
                        $socialLinks = \App\Models\SocialLink::active()->get();
                        @endphp
                        @forelse($socialLinks ?? [] as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                            class="social-circle" aria-label="{{ $link->label ?? $link->platform }}">
                            <i class="{{ $link->icon_class }}"></i>
                        </a>
                        @empty
                        <!-- fallback (optional) -->
                        @endforelse
                    </div>
                </div>
                <div class="col-md-2">
                    <h5>Quick Links</h5>
                    <a href="{{ route('new-arrivals') }}">New Arrivals</a><br />
                    <a href="{{ route('sale') }}">Sale</a><br />
                    <a href="{{ route('collections') }}">Collections</a>
                </div>
                <div class="col-md-2">
                    <h5>Support</h5>
                    <a href="{{ route('contact') }}">Contact</a><br />
                    <a href="#">Track Order</a><br />
                    <a href="#">Returns</a>
                </div>
                <div class="col-md-2">
                    <h5>Our Policies</h5>
                    <a href="/privacy">Privacy & Policies</a><br />
                    <a href="/terms">Terms & Conditions</a><br />
                    <a href="/vision-mission">Vision & Mission</a><br />
                    <a href="/f-a-q"> FAQ</a>
                </div>

                <div class="col-md-2">
                    <h5>Store</h5>
                    <a href="#">Lahore</a><br />
                    <a href="#">Karachi</a><br />
                    <a href="#">Islamabad</a>
                </div>
            </div>
            <div class="border-top border-secondary border-opacity-25 mt-4 pt-3 text-center small">© 2026 VELENZA. All
                rights reserved.</div>
        </div>
    </footer>

    @livewireScripts

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

        // Scroll effect for header
        const header = document.getElementById('mainHeader');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                header.classList.add('navbar-scrolled');
            } else {
                header.classList.remove('navbar-scrolled');
            }
        });

        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
            const icon = mobileToggle.querySelector('i');
            if (mobileMenu.classList.contains('open')) {
                icon.className = 'bi bi-x-lg';
            } else {
                icon.className = 'bi bi-list';
            }
        });

        // Close mobile menu on link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('open');
                mobileToggle.querySelector('i').className = 'bi bi-list';
            });
        });

        document.addEventListener('livewire:init', function() {
            Livewire.on('cartUpdated', () => {
                // Update cart count in header
                fetch('/api/cart-count')
                    .then(response => response.json())
                    .then(data => {
                        const cartBadges = document.querySelectorAll('.bag-count, .cart-count');
                        cartBadges.forEach(badge => {
                            if (data.count > 0) {
                                badge.textContent = data.count;
                                badge.style.display = 'inline';
                            } else {
                                badge.style.display = 'none';
                            }
                        });
                    })
                    .catch(() => {
                        // If API fails, just show the count from session
                        const cartItems = @json(session('cart', []));
                        const count = Object.values(cartItems).reduce((sum, item) => sum + item.quantity, 0);
                        document.querySelectorAll('.bag-count, .cart-count').forEach(badge => {
                            if (count > 0) {
                                badge.textContent = count;
                                badge.style.display = 'inline';
                            } else {
                                badge.style.display = 'none';
                            }
                        });
                    });
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:init', function() {
            // Handle modal open
            Livewire.on('modal-opened', function() {
                document.body.classList.add('modal-open');
            });

            // Handle modal close
            Livewire.on('modal-closed', function() {
                document.body.classList.remove('modal-open');
            });

            // Handle shake animation
            Livewire.on('shake-field', function(data) {
                const field = data.field;
                const input = document.querySelector(`[wire\\:model="${field}"]`);
                if (input) {
                    input.classList.add('shake');
                    setTimeout(() => {
                        input.classList.remove('shake');
                    }, 700);
                }
            });
        });

        // Clean up when modal is removed
        document.addEventListener('livewire:update', function() {
            const modal = document.querySelector('.modal-overlay');
            if (!modal) {
                document.body.classList.remove('modal-open');
            }
        });
    </script>
</body>

</html>