<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eco Market</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        .hover-card {
            transition: transform 0.3s ease-in-out;
        }

        .hover-card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .nav-link:hover {
            color: #28a745 !important;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
        }

        body {
            background: #f8f9fa;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">🌿 EcoMarket</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>

                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning fw-bold" href="admin_dashboard.php">⚙️ Admin Dashboard</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="wishlist.php">❤️ My Wishlist</a>
                    </li>

                    <li class="nav-item">
                        <span class="nav-link">Hi, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-outline-danger btn-sm ms-2">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="login.php" class="btn btn-outline-primary btn-sm me-2">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php" class="btn btn-outline-success btn-sm">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Page content starts -->
<div class="container mt-4">
