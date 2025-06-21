<?php
// wishlist.php - shows user's wishlist
session_start();
include 'includes/header.php';
require 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$stmt = $conn->prepare("SELECT p.* FROM wishlist w JOIN products p ON w.product_id = p.id WHERE w.user_id = ? ORDER BY w.created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$products = $stmt->get_result();
?>
<div class="container my-5">
    <h2 class="text-success mb-4">❤️ My Wishlist</h2>
    <div class="row">
        <?php while ($product = $products->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="uploads/<?= htmlspecialchars($product['image']) ?>" class="card-img-top">
                    <div class="card-body">
                        <h5><?= htmlspecialchars($product['name']) ?></h5>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                        <p class="text-success">&#8377;<?= number_format($product['price'], 2) ?></p>
                        <form action="toggle_wishlist.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button class="btn btn-danger btn-sm">Remove from Wishlist</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
