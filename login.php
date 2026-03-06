<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and trim input (sanitize only for output)
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // For demonstration, check against session values set in register.php
    if (isset($_SESSION["username"]) && isset($_SESSION["email"]) && isset($_SESSION["password"])) {
        // Simple condition check (in real projects, check against database and use password hashing)
        if ($username === $_SESSION["username"] && $password === $_SESSION["password"]) {
            // Login successful - redirect to dashboard
            $_SESSION["logged_in"] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "No registered user found! Please register first. <a href='register.php'>Register</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
        <h1>Login to E-comm</h1>
        <p>Access your account and start shopping the best deals!</p>
    </div>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <button type="submit">Login</button>
            <button type="button" onclick="window.location.href='index.php'">Cancel</button>
        </form>
        <div style="margin-top:24px;text-align:center;">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
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