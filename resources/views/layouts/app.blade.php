<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Velenza') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('velenza_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('velenza_logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top, rgba(201,162,39,0.18) 0%, transparent 35%),
                        linear-gradient(135deg, #04070f 0%, #121d33 55%, #1b324f 100%);
            color: #f5f5f5;
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
        }

        .auth-card {
            width: 100%;
            max-width: 520px;
            border-radius: 28px;
            overflow: hidden;
            background: rgba(15, 25, 45, 0.95);
            box-shadow: 0 40px 120px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .auth-hero {
            position: relative;
            min-height: 220px;
            background: linear-gradient(135deg, rgba(201,162,39,0.24), rgba(23, 44, 78, 0.95)),
                        url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 2rem;
        }

        .auth-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(10, 22, 39, 0.78) 75%);
        }

        .auth-hero-content {
            position: relative;
            z-index: 1;
            color: #fff;
        }

        .auth-hero h2 {
            margin-bottom: 0.5rem;
            font-size: clamp(2rem, 2.5vw, 2.6rem);
            font-family: 'Playfair Display', serif;
            line-height: 1.05;
        }

        .auth-hero p {
            color: rgba(255, 255, 255, 0.82);
            max-width: 20rem;
        }

        .auth-body {
            padding: 2rem;
        }

        .auth-card .form-control {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff;
            box-shadow: none;
        }

        .auth-card .form-control:focus {
            border-color: rgba(201,162,39,0.9);
            box-shadow: 0 0 0 0.2rem rgba(201,162,39,0.18);
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
        }

        .auth-card .form-label {
            color: #e8e8e8;
        }

        .auth-card .btn-primary {
            background: linear-gradient(135deg, #c9a227 0%, #f9d76a 100%);
            border: none;
            color: #111;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .auth-card .btn-primary:hover {
            background: linear-gradient(135deg, #d4b63a 0%, #ffd76f 100%);
        }

        .auth-card .text-muted,
        .auth-card .small {
            color: rgba(255, 255, 255, 0.65);
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
    </style>

    @livewireStyles
    @stack('styles')
</head>
<body>
    <main class="min-vh-100 py-5">
        {{ $slot }}
    </main>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
