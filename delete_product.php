<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = intval($_GET['id']);

// Delete image
$stmt = $conn->prepare("SELECT image FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
if ($product && file_exists('uploads/' . $product['image'])) {
    unlink('uploads/' . $product['image']);
}

// Delete from DB
$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: products.php");
exit();
?>
