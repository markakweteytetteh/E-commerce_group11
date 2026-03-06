<?php
//Start session for tracking user login state.
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce website</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <a href="index.php"><img src="https://img.icons8.com/ios-filled/50/000000/shopping-cart.png"
                    alt="E-comm Logo" style="height:40px;vertical-align:middle;"> <span
                    style="font-size:1.5em;font-weight:bold;vertical-align:middle;">E-comm</span></a>
        </div>
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="#">Shop</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>
    <!-- Banner -->
    <div class="banner" style="background:#f5f5f5;padding:20px;text-align:center;margin-bottom:20px;">
        <h1>Welcome to E-comm!</h1>
        <p>Your one-stop shop for everything you need. Sign up or login to start shopping!</p>
    </div>
    <!-- Main Content -->
    <div class="container" style="max-width:600px;">
        <h2>Welcome to E-comm</h2>
        <?php if (isset($_GET['logout']) && $_GET['logout'] == 1): ?>
            <p style="color:blue;">You have been logged out.</p>
        <?php endif; ?>
        <div style="text-align:center;margin:24px 0;">
            <a href="login.php" class="btn" style="margin-right:16px;">Login</a>
            <a href="register.php" class="btn">Register</a>
        </div>
    </div>
    <!-- Featured Products Section -->
    <div class="featured-products" style="max-width:900px;margin:40px auto 0 auto;padding:20px 0;">
        <h2 style="text-align:center;">Featured Products</h2>
        <div style="display:flex;justify-content:space-around;flex-wrap:wrap;gap:30px;">
            <div
                style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;padding:15px;width:200px;text-align:center;">
                <img src="https://img.icons8.com/color/96/000000/shoes.png" alt="Product 1"
                    style="width:80px;height:80px;">
                <h3>Trendy Sneakers</h3>
                <p style="color:#27ae60;font-weight:bold;">$49.99</p>
            </div>
            <div
                style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;padding:15px;width:200px;text-align:center;">
                <img src="https://img.icons8.com/color/96/000000/t-shirt.png" alt="Product 2"
                    style="width:80px;height:80px;">
                <h3>Classic T-Shirt</h3>
                <p style="color:#27ae60;font-weight:bold;">$19.99</p>
            </div>
            <div
                style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;padding:15px;width:200px;text-align:center;">
                <img src="https://img.icons8.com/color/96/000000/backpack.png" alt="Product 3"
                    style="width:80px;height:80px;">
                <h3>Urban Backpack</h3>
                <p style="color:#27ae60;font-weight:bold;">$34.99</p>
            </div>
        </div>
    </div>
    <!-- Why Choose Us Section -->
    <div class="why-choose-us" style="background:#f9f9f9;padding:30px 0;margin-top:40px;">
        <h2 style="text-align:center;">Why Choose E-comm?</h2>
        <div style="display:flex;justify-content:center;gap:60px;margin-top:20px;flex-wrap:wrap;">
            <div style="text-align:center;width:200px;">
                <img src="https://img.icons8.com/fluency/48/000000/delivery.png" alt="Fast Delivery">
                <h4>Fast Delivery</h4>
                <p>Get your products delivered quickly and safely.</p>
            </div>
            <div style="text-align:center;width:200px;">
                <img src="https://img.icons8.com/fluency/48/000000/discount.png" alt="Best Prices">
                <h4>Best Prices</h4>
                <p>Enjoy amazing deals and discounts every day.</p>
            </div>
            <div style="text-align:center;width:200px;">
                <img src="https://img.icons8.com/fluency/48/000000/customer-support.png" alt="Support">
                <h4>24/7 Support</h4>
                <p>Our team is here to help you anytime.</p>
            </div>
        </div>
    </div>
    <!-- Testimonials Section -->
    <div class="testimonials" style="max-width:900px;margin:40px auto 0 auto;padding:20px 0;">
        <h2 style="text-align:center;">What Our Customers Say</h2>
        <div style="display:flex;justify-content:space-around;flex-wrap:wrap;gap:30px;">
            <div style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;padding:15px;width:250px;">
                <p>"Great shopping experience! Fast delivery and quality products."</p>
                <p style="font-weight:bold;">- Sarah K.</p>
            </div>
            <div style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;padding:15px;width:250px;">
                <p>"Customer support was super helpful. Highly recommend!"</p>
                <p style="font-weight:bold;">- Mike D.</p>
            </div>
            <div style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #eee;padding:15px;width:250px;">
                <p>"Amazing deals and discounts. I love shopping here!"</p>
                <p style="font-weight:bold;">- Priya S.</p>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer" style="background:#222;color:#fff;text-align:center;padding:15px 0;margin-top:40px;">
        &copy; <?php echo date('Y'); ?> E-comm. All rights reserved.
    </footer>
</body>

</html>