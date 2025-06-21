<?php
session_start();
include 'includes/header.php';
include 'config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $image = $_FILES['image'];
    $imageName = $product['image'];

    if ($image['name']) {
        $imageName = uniqid() . '_' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], 'uploads/' . $imageName);
    }

    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id=?");
    $stmt->bind_param("ssdsi", $name, $description, $price, $imageName, $id);
    $stmt->execute();
    header("Location: products.php");
    exit();
}
?>

<div class="container my-5">
    <h2 class="text-warning mb-4">✏️ Edit Product</h2>

    <form method="POST" enctype="multipart/form-data" class="shadow-sm p-4 bg-light rounded">
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (₹)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Image</label><br>
            <img src="uploads/<?= $product['image'] ?>" width="150" class="mb-2"><br>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Update Product</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
