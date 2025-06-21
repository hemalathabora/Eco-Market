<?php
session_start();
include 'includes/header.php';
include 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$role = $_SESSION['user']['role'];

// Handle search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = $search ? "WHERE name LIKE ?" : "";

// Fetch products
$sql = "SELECT * FROM products $searchSql ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
if ($search) {
    $like = '%' . $search . '%';
    $stmt->bind_param("s", $like);
}
$stmt->execute();
$products = $stmt->get_result();

// Fetch wishlist items for this user
$wishlist = [];
$wstmt = $conn->prepare("SELECT product_id FROM wishlist WHERE user_id = ?");
$wstmt->bind_param("i", $user_id);
$wstmt->execute();
$wres = $wstmt->get_result();
while ($row = $wres->fetch_assoc()) {
    $wishlist[] = $row['product_id'];
}
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">🌱 Our Products</h2>
        <div class="d-flex gap-2">
            <?php if ($role === 'admin'): ?>
                <a href="add_product.php" class="btn btn-success">➕ Add New Product</a>
            <?php else: ?>
                <a href="wishlist.php" class="btn btn-outline-success">💖 View My Wishlist</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Search form -->
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control" placeholder="Search products...">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </form>

    <div class="row">
        <?php while ($product = $products->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm hover-card animate__animated animate__fadeInUp">
                    <img src="uploads/<?= htmlspecialchars($product['image']) ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="text-success fw-bold">₹<?= number_format($product['price'], 2) ?></p>

                        <?php if ($role === 'admin'): ?>
                            <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                            <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                        <?php else: ?>
                            <form action="toggle_wishlist.php" method="POST" class="d-inline">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" class="btn btn-outline-<?= in_array($product['id'], $wishlist) ? 'danger' : 'secondary' ?> btn-sm">
                                    <?= in_array($product['id'], $wishlist) ? '❤️ Remove Wishlist' : '🤍 Add to Wishlist' ?>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
