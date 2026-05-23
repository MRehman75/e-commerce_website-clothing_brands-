<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background: #1e293b;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover {
            background: #334155;
            color: #fff;
        }

        .card-box {
            border-radius: 12px;
            padding: 20px;
            color: white;
        }

        .bg1 { background: #0ea5e9; }
        .bg2 { background: #22c55e; }
        .bg3 { background: #f97316; }
        .bg4 { background: #a855f7; }
    </style>

</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar">
            <h4 class="mb-4">Admin Panel</h4>

            <a href="/admin/dashboard">🏠 Dashboard</a>
            <a href="/admin/users">👤 Users</a>
            <a href="/admin/products">📦 Products</a>
            <a href="/admin/orders">🛒 Orders</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>