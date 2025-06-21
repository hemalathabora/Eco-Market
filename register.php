<?php
session_start();
require 'config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $role = $_POST['role'] ?? 'user';

    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    if (!in_array($role, ['admin', 'user'])) {
        $errors[] = 'Invalid role selected.';
    }

    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $errors[] = "Email already registered.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hashed, $role);

            if ($stmt->execute()) {
                $_SESSION['user'] = [
                    'id' => $conn->insert_id,
                    'name' => $name,
                    'email' => $email,
                    'role' => $role
                ];

                header("Location: " . ($role === 'admin' ? "index.php" : "index.php"));
                exit;
            } else {
                $errors[] = "Something went wrong. Try again.";
            }
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<style>
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f4f8;
    }

    .auth-card {
        max-width: 500px;
        width: 100%;
        padding: 40px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .auth-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .auth-card h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-select,
    .form-control {
        transition: box-shadow 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-success {
        font-weight: 600;
        transition: all 0.2s ease-in-out;
    }

    .btn-success:hover {
        transform: scale(1.03);
    }
</style>

<div class="auth-container">
    <form method="POST" class="auth-card">
        <h2>Register</h2>

        <?php foreach ($errors as $e): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>

        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>

        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="mb-3">
            <input type="password" name="confirm" class="form-control" placeholder="Confirm Password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Register As:</label>
            <select name="role" class="form-select" required>
                <option value="user" selected>User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button class="btn btn-success w-100">Register</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
