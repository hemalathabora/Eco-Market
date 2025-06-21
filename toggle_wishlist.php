<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$product_id = intval($_POST['product_id']);

// Check if already in wishlist
$stmt = $conn->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    // Remove from wishlist
    $del = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
    $del->bind_param("ii", $user_id, $product_id);
    $del->execute();
} else {
    // Add to wishlist
    $add = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
    $add->bind_param("ii", $user_id, $product_id);
    $add->execute();
}

header("Location: products.php");
exit();
