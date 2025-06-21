<?php
session_start();
include 'includes/header.php';
include 'config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $image = $_FILES['image'];

    if (!$name || !$description || !$price || !$image['name']) {
        $errors[] = "All fields are required.";
    } else {
        $imageName = uniqid() . '_' . basename($image['name']);
        $target = 'uploads/' . $imageName;

        if (move_uploaded_file($image['tmp_name'], $target)) {
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, image, created_at) VALUES (?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssds", $name, $description, $price, $imageName);
            $stmt->execute();
            header("Location: products.php");
            exit();
        } else {
            $errors[] = "Image upload failed.";
        }
    }
}
?>

<div class="container my-5">
    <h2 class="text-success mb-4">➕ Add New Product</h2>

    <?php if ($errors): ?>
        <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="shadow-sm p-4 bg-light rounded">
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (₹)</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button class="btn btn-success">Add Product</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
