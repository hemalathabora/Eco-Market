<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'config.php';
include 'includes/header.php';

// Fetch product count
$productCount = 0;
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $productCount = $row['total'];
}
?>

<style>
    .dashboard-container {
        padding: 60px 20px;
        background-color: #f0f4f8;
        min-height: 100vh;
    }

    .dashboard-heading {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 50px;
    }

    .dashboard-card,
    .product-count-box {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        padding: 30px;
        border: none;
    }

    .product-count-box {
        background: linear-gradient(135deg, #00b894, #55efc4);
        color: white;
        text-align: center;
        margin-bottom: 40px;
    }

    .product-count-box:hover,
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .dashboard-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .dashboard-title {
        font-weight: 600;
        font-size: 1.25rem;
    }

    .product-count-number {
        font-size: 3rem;
        font-weight: bold;
        margin: 10px 0;
    }

    .btn {
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .logout-btn {
        margin-top: 50px;
        font-size: 1rem;
        padding: 10px 30px;
        border-radius: 30px;
    }

    @media (max-width: 768px) {
        .dashboard-heading {
            font-size: 2rem;
        }

        .dashboard-card,
        .product-count-box {
            padding: 20px;
        }
    }
</style>

<div class="container dashboard-container">
    <h2 class="text-center dashboard-heading">👨‍💼 Admin Dashboard</h2>

    <!-- Total Products (Vertical) -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="product-count-box shadow">
                <div class="dashboard-icon">📊</div>
                <div class="dashboard-title">Total Products</div>
                <div class="product-count-number"><?= $productCount ?></div>
                <p>Eco-friendly items listed</p>
            </div>
        </div>
    </div>

    <!-- Manage and Add Product (Side-by-side) -->
    <div class="row g-4 justify-content-center">
        <!-- Manage Products -->
        <div class="col-md-5">
            <div class="card dashboard-card text-center shadow bg-white">
                <div class="dashboard-icon">📦</div>
                <div class="dashboard-title">Manage Products</div>
                <p class="text-muted">Add, edit, or delete products</p>
                <a href="products.php" class="btn btn-outline-primary mt-2 w-100">View Products</a>
            </div>
        </div>

        <!-- Add Product -->
        <div class="col-md-5">
            <div class="card dashboard-card text-center shadow bg-white">
                <div class="dashboard-icon">➕</div>
                <div class="dashboard-title">Add Product</div>
                <p class="text-muted">Add new eco-friendly products</p>
                <a href="add_product.php" class="btn btn-outline-success mt-2 w-100">Add Product</a>
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="text-center">
        <a href="logout.php" class="btn btn-danger logout-btn mt-5">Logout</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
