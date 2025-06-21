<?php
session_start();
require 'config.php';
include 'includes/header.php';

// Fetch products from database
$result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>

<div class="container my-5">
    <h2 class="text-center mb-4">🛍️ Browse Eco-Friendly Products</h2>

    <div class="row g-4">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                            <p class="text-success fw-bold">₹<?= number_format($product['price'], 2) ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">No products available right now.</div>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center mt-5">
        <a href="index.php" class="btn btn-outline-secondary">Back to Home</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
