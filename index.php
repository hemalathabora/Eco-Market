<?php
session_start();
include 'includes/header.php';
?>

<style>
body {
    background: linear-gradient(120deg, #e0f7fa 0%, #e8f5e9 100%);
    min-height: 100vh;
    font-family: 'Segoe UI', Arial, sans-serif;
}
.hero-section {
    background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
    border-radius: 1.5rem;
    box-shadow: 0 8px 32px 0 rgba(34, 139, 87, 0.2);
    color: #fff;
    padding: 4rem 2rem 3rem 2rem;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}
.hero-section::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(46, 139, 87, 0.45);
    border-radius: 1.5rem;
    z-index: 1;
}
.hero-content {
    position: relative;
    z-index: 2;
}
.hero-title {
    font-size: 3rem;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 1rem;
    text-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.hero-subtitle {
    font-size: 1.5rem;
    font-weight: 400;
    margin-bottom: 2rem;
    text-shadow: 0 1px 4px rgba(0,0,0,0.10);
}
.cta-btn {
    background: #fff;
    color: #2e8b57;
    border: none;
    font-weight: 600;
    padding: 0.75rem 2.5rem;
    border-radius: 2rem;
    font-size: 1.2rem;
    box-shadow: 0 2px 8px rgba(34,139,87,0.10);
    transition: background 0.2s, color 0.2s;
}
.cta-btn:hover {
    background: #2e8b57;
    color: #fff;
}
.card {
    border: none;
    border-radius: 1.25rem;
    box-shadow: 0 4px 24px 0 rgba(34, 139, 87, 0.10);
    transition: transform 0.2s, box-shadow 0.2s;
}
.card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 8px 32px 0 rgba(34, 139, 87, 0.18);
}
.card-title {
    color: #2e8b57;
    font-weight: 700;
}
.list-group-item {
    background: transparent;
    border: none;
    font-size: 1.1rem;
    color: #333;
}
.contact-info p {
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}
@media (max-width: 768px) {
    .hero-title { font-size: 2rem; }
    .hero-section { padding: 2rem 1rem; }
}
</style>

<div class="container my-5">
    <div class="hero-section animate__animated animate__fadeInDown">
        <div class="hero-content text-center">
            <h1 class="hero-title">🌿 Welcome to Eco Market 🌿</h1>
            <p class="hero-subtitle">Your trusted platform for sustainable and eco-friendly products. Shop green, live clean!</p>
            <a href="products.php" class="cta-btn">Shop Now</a>
        </div>
    </div>
    <?php if (isset($_SESSION['user'])): ?>
        <div class="alert alert-success text-center animate__animated animate__fadeInUp">
            You are logged in as <strong><?= htmlspecialchars($_SESSION['user']['email']) ?></strong>.
        </div>
    <?php endif; ?>
</div>

<div class="container">
    <!-- Section 1: About -->
    <div class="card shadow-lg mb-4 animate__animated animate__fadeInUp hover-card">
        <div class="card-body">
            <h3 class="card-title mb-3">♻️ About Eco Market</h3>
            <p class="card-text">
                Eco Market is your go-to platform for sustainable and eco-friendly products. Our goal is to build a greener planet by promoting environmentally conscious shopping. Whether you're a customer or an eco-business, join us in making a difference.
            </p>
        </div>
    </div>

    <!-- Section 2: Features -->
    <div class="card shadow-lg mb-4 animate__animated animate__fadeInUp hover-card">
        <div class="card-body">
            <h3 class="card-title mb-3">🛍️ Key Features</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">🔐 Secure Login & Registration</li>
                <li class="list-group-item">🛒 Add/Edit/Delete Products (Admin Only)</li>
                <li class="list-group-item">🔍 Product Listings with Search & Pagination</li>
                <li class="list-group-item">📱 Modern, Responsive, and Mobile-Friendly UI</li>
            </ul>
        </div>
    </div>

    <!-- Section 3: Contact -->
    <div class="card shadow-lg mb-5 animate__animated animate__fadeInUp hover-card">
        <div class="card-body contact-info">
            <h3 class="card-title mb-3">📞 Contact Us</h3>
            <p><strong>Email:</strong> support@ecomarket.com</p>
            <p><strong>Phone:</strong> +91-8247089250</p>
            <p><strong>Address:</strong> Green Street, Planet Earth 🌍</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
